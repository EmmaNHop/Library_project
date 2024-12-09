<?php
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

try {
    // Create a PDO connection
    $pdo = new PDO($dsn, $user, $pass, $opt);

    // Retrieve user input from POST
    $username = $_POST['username'] ?? '';
    $emailOrPhone = $_POST['emailOrPhone'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    phone_number = $_POST['phone_number'] ?? '';
    
    // Input validation
    if (empty($username) || empty($emailOrPhone) || empty($password)) {
        die("All fields are required.");
    }

    // Determine if input is email or phone
    if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL)) {
        $email = $emailOrPhone;
        $phone_number = null;
    } elseif (preg_match('/^\+?[0-9]{10,15}$/', $emailOrPhone)) {
        $email = null;
        $phone_number = $emailOrPhone;
    } else {
        die("Invalid email or phone number format.");
    }

    // Insert user data into the database
    $profile_picture = null; // Placeholder for now
    $query = $pdo->prepare(
        'INSERT INTO user (user_name, email, phone_number, password, profile_picture) 
         VALUES (?, ?, ?, ?, ?)'
    );
    $query->execute([$username, $email, $phone_number, $password, $profile_picture]);

    echo "Registration successful!";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
