<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Sharing</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .container {
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        textarea {
            resize: none;
        }
        .result-container {
            max-width: 600px;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <h1 class="mb-4">Share Your Passphrase Securely</h1>
        <!-- Use novalidate to disable browser's default validation -->
        <form id="passphraseForm" class="needs-validation" novalidate>
            <div class="form-group">
                <textarea id="passphrase" class="form-control mb-3" rows="4" placeholder="Enter your passphrase..." required></textarea>
                <div class="invalid-feedback">
                    Please enter a passphrase.
                </div>
            </div>

            <!-- Display CAPTCHA image -->
            <div class="form-group">
                <img src="/captcha" alt="CAPTCHA" class="mb-3">
                <input type="text" id="captcha" class="form-control mb-3" placeholder="Enter CAPTCHA" required>
                <div class="invalid-feedback">
                    Please enter the CAPTCHA code.
                </div>
            </div>

            <button id="encryptButton" class="btn btn-primary btn-block" type="submit">Encrypt and Get Link</button>
        </form>
    </div>

    <!-- Result Container -->
    <div id="result-container" class="result-container d-none">
        <h3>Show the Result</h3>
        <p id="result" class="mt-3"></p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Handle form submission via JavaScript
        document.getElementById('passphraseForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var passphrase = document.getElementById('passphrase').value;
            var captcha = document.getElementById('captcha').value;

            if (this.checkValidity()) { // Proceed only if the form is valid
                fetch('/encrypt', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'passphrase=' + encodeURIComponent(passphrase) + '&captcha=' + encodeURIComponent(captcha)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('result').innerHTML = '<a href="' + data.url + '">' + data.url + '</a>';
                        document.getElementById('result-container').classList.remove('d-none');
                    } else {
                        document.getElementById('result').innerText = data.message;
                        document.getElementById('result-container').classList.remove('d-none');
                    }
                });
            }
        });
    </script>
</body>
</html>
