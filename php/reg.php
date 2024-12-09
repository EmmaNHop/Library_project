<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Roboto:wght@100;300;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <style>
        /* Dark Mode Styles */

        .form-control {
            background-color: #1e1e1e;
            color: #ffffff;
            border: 1px solid #555;
        }

        .form-control:focus {
            background-color: #1e1e1e;
            color: #ffffff;
            border-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }

        .alert {
            background-color: #222;
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }

        .text-muted {
            color: #aaaaaa !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="font-family: 'Fredoka One', sans-serif;">Sign Up</h1>
        <form id="signup-form" class="needs-validation" novalidate>
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    placeholder="Enter username" 
                    required>
                <div class="invalid-feedback">Please enter a username.</div>
            </div>
            <!-- Email or Phone -->
            <div class="form-group">
                <label for="emailOrPhone">Email or Phone Number</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="emailOrPhone" 
                    placeholder="Enter email or phone number" 
                    required>
                <div class="invalid-feedback">Please enter an email or phone number.</div>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    placeholder="Enter password" 
                    required>
                <div class="invalid-feedback">Please enter a password.</div>
            </div>
            <!-- Confirm Password -->
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="confirmPassword" 
                    placeholder="Re-enter password" 
                    required>
                <div class="invalid-feedback">Please confirm your password.</div>
            </div>
            <!-- Password Mismatch Alert -->
            <div class="alert alert-danger d-none" id="password-error" role="alert">
                Passwords do not match!
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
    </div>

    <script>
        // Enable Bootstrap validation styles
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        const password = document.getElementById('password').value;
                        const confirmPassword = document.getElementById('confirmPassword').value;
                        const passwordError = document.getElementById('password-error');
                        
                        // Check if passwords match
                        if (password !== confirmPassword) {
                            passwordError.classList.remove('d-none');
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            passwordError.classList.add('d-none');
                        }

                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
