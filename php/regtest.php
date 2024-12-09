
<?php include_once('header.php'); ?>
<style>
.form-control {
            background-color: rgba(40, 40, 40, 0.5);;
            color: rgba(55, 55, 55, 0.25);;
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
<div class="settings">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <h2 class="h3 mb-4 page-title ">Settings</h2>
            <div class="my-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab"   href="settings_acct.php" role="tab" aria-controls="contact"    aria-selected="false">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="settings_notif.php" role="tab" aria-controls="contact"    aria-selected="false">Notifications</a>
                    </li>
                </ul>
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
            </div>
            <hr class="grey-line">
        </div>
    </div>

</div>
<?php include_once('footer.php'); ?>