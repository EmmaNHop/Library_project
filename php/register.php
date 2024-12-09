<?php 
include_once('header.php'); 

// Database configuration
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$message = '';

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        
        // Input validation
        if (empty($username) || empty($email) || empty($password)) {
            $message = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } else {
            $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $hash_password = filter_var($password, FILTER_SANITIZE_STRING);

            $query = $pdo->prepare(
                'INSERT INTO users (user_name, email, password, profile_picture) 
                 VALUES (?, ?,  ?, ?)'
            );

            $profile_picture = NULL; // Or set a default value if applicable
            $query->execute([$username, $email, $hash_password, $profile_picture]);

            // Log registration success
            $logMessage = date("Y/m/d") . "\t" . date("h:i:sa") . "\tRegistration successful!\n";
            error_log($logMessage, 3, "admin/registration_logs.log");

            // Store user info in session
            $_SESSION['user'] = [
                'username' => $username,
                'email' => $email,
                'password' => $hash_password,
                'profile_picture' => $profile_picture
            ];
            // Redirect to settings page
            header("Location: settings_acct.php");
            exit;
        }
    }
} catch (PDOException $e) {
    $errorMessage = date("Y/m/d") . "\t" . date("h:i:sa") . "\t Database error: " . $e->getMessage() . "\n";
    error_log($errorMessage, 3, "admin/registration_logs.log");
}           
?>



<div class="settings">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <div class="my-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="signIn.php" role="tab" aria-controls="contact" aria-selected="false">Sign-In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="register.php" role="tab" aria-controls="contact" aria-selected="false">Sign-Up</a>
                    </li>
                </ul>
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Sign Up</h1>
                    <form id="signup-form" class="needs-validation" novalidate method="post" action="">
                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="username" 
                                name="username" 
                                placeholder="Enter username" 
                                required>
                            <div class="invalid-feedback">Please enter a username.</div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                placeholder="Enter email" 
                                required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
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
                                name="confirmPassword" 
                                placeholder="Re-enter password" 
                                required>
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>
                        <!-- Password Mismatch Alert -->
                        <div class="alert alert-danger d-none" id="password-error" role="alert">
                            Passwords do not match!
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-outline-success btn-block">Sign Up</button>
                    </form>
                    <?php if ($message): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
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

                                    // Check form validity
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
