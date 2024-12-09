<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If no user is logged in, redirect to the login page
    header("Location: signIn.php");
    exit;
}

// Ensure that a user is being deleted
if (!isset($_GET['user_name']) || empty($_GET['user_name'])) {
    die("No user specified.");
}

$user = $_SESSION['user'];

// Database connection details
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Prepare the delete query
    $stmt = $pdo->prepare('DELETE FROM users WHERE user_name = ?');

    // Execute the query with the user_name parameter
    $stmt->execute([$username]);

    // Check if a row was affected (i.e., user was deleted)
    if ($stmt->rowCount() > 0) {
        echo "User $username has been successfully deleted.";
        // Redirect to a confirmation page or back to settings

        // Destroy the session to log out the user
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        
        header("Location: signIn.php");
        exit;
    } else {
        echo "No user found with the username $username.";
    }

} catch (PDOException $e) {
    // Handle database connection or query errors
    echo "Error: " . $e->getMessage();
}

?>

