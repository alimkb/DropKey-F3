<?php

require 'core/base.php';

$f3 = \Base::instance();
session_start();
$db = new \DB\SQL('sqlite:data/database.db');

// Define your base domain
$baseDomain = 'https://passkey.fxparamount.trade';

// Route to generate CAPTCHA image
$f3->route('GET /captcha', function() {
    header('Content-Type: image/png');

    // Generate random string for CAPTCHA
    $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
    $_SESSION['captcha'] = $code;

    // Create image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);
    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);

    // Add the text to the image
    //imagettftext($image, 20, 0, 10, 30, $textColor, 'assets/fonts/captchafont.otf', $code);
    imagestring($image, 5, 10, 10, $code, $textColor);
    // Output the image as PNG
    imagepng($image);
    imagedestroy($image);
});

$f3->route('GET /', function($f3) {
    echo \Template::instance()->render('index.html');
});

$f3->route('POST /encrypt', function($f3) use($db, $baseDomain) {
    $passphrase = $f3->get('POST.passphrase');
    $captcha = $f3->get('POST.captcha');

    // Validate CAPTCHA
    if ($captcha !== $_SESSION['captcha']) {
        echo json_encode(['status' => 'error', 'message' => 'CAPTCHA verification failed.']);
        return;
    }

    // Clear CAPTCHA after use
    unset($_SESSION['captcha']);

    if ($passphrase) {
        $encrypted = base64_encode($passphrase); // Simple encryption, replace with a more secure method
        $url_token = bin2hex(random_bytes(16));
        
        $db->exec('INSERT INTO messages (url_token, encrypted_message) VALUES (?, ?)', [$url_token, $encrypted]);
        
        // Construct the full URL using the base domain
        $fullUrl = $baseDomain . '/' . $url_token;
        
        echo json_encode([
            'status' => 'success',
            'url' => $fullUrl
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Passphrase cannot be empty']);
    }
});

$f3->route('GET /@token', function($f3, $params) use($db) {
    $token = $params['token'];
    $result = $db->exec('SELECT encrypted_message FROM messages WHERE url_token = ?', [$token]);

    if ($result) {
        $message = base64_decode($result[0]['encrypted_message']); // Decrypt the message

        // Delete the message after it has been viewed
        $db->exec('DELETE FROM messages WHERE url_token = ?', [$token]);

        // Pass the decrypted message to the template
        $f3->set('passphrase', $message);
        echo \Template::instance()->render('passphrase.html');
    } else {
        // Render the error page if the message is not found or already viewed
        echo \Template::instance()->render('error.html');
    }
});

$f3->run();
