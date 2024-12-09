<?php 

include_once('header.php'); 

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

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    error_log("Login script started");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve user input
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $message = "All fields are required.";
        }

        error_log("Username: $username");

        // Fetch user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        echo("User fetch result: " . print_r($user, true));

        if ($user) {
            $db_password = $user['password'];
            if ($password == $db_password) {
                // Store user info in session
                $_SESSION['user'] = [
                    'username' => $username,
                    'email' => $user['email'],
                    'profile_picture' => $user['profile_picture'] ?? null
                ];

                $message = date("Y/m/d") . "\t" . date("h:i:sa") . "\tLogin successful!\n";
                error_log($message, 3, "admin/login_logs.log");

                // Redirect to settings page
                header("Location: search.php");
                exit;
            } else {
                $message = "Incorrect password.";
                error_log($message, 3, "admin/login_logs.log");
            }
        } else {
            $message = "Username not found.";
            error_log($message, 3, "admin/login_logs.log");
        }
    }
} catch (PDOException $e) {
    $message = date("Y/m/d") . "\t" . date("h:i:sa") . "\t Database error: " . $e->getMessage() . "\n";
    error_log($message, 3, "admin/login_logs.log");
}

?>




<div class="settings">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <div class="my-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="signIn.php" role="tab" aria-controls="contact" aria-selected="false">Sign-In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="register.php" role="tab" aria-controls="contact" aria-selected="false">Sign-Up</a>
                    </li>
                </ul>
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Sign In</h1>
                    <!-- Updated form to send data to sql_query.php -->
                    <form id="login-form" method="POST" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                            <div class="invalid-feedback">Please enter your username.</div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-block">Sign In</button>
                    </form>
                </div>            
            </div>
            <hr class="grey-line">
        </div>     
    </div>
</div>
<?php include_once('footer.php'); ?>
