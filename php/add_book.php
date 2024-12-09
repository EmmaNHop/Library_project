<?php
// Database connection
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

session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    error_log("Username: " . $_SESSION['user']['username'], 3, "debug.log");
} else {
    error_log("Username is not set in the session.\n", 3, "debug.log");
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $cover_url = $_POST['cover_url'] ?? '';
        $first_publish_year = $_POST['first_publish_year'] ?? '';
        $description = $_POST['description'] ?? '';
        $id = $_POST['id'] ?? '';
        $list = $_POST['list'] ?? '';

        

        // Input validation
        if (empty($title) || empty($id) || empty($list) || empty($username)) {
            $message = "An error occurred. Please try again.";
            error_log("Validation Error: $message\n", 3, "debug.log");

        } else {

            $query = $pdo->prepare(
                "INSERT INTO books (title, author, cover_url, publish_year, description, id) 
                    VALUES (?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE 
                                        title = VALUES(title), 
                                        author = VALUES(author), 
                                        cover_url = VALUES(cover_url), 
                                        publish_year = VALUES(publish_year), 
                                        description = VALUES(description)"
            );
            try {
                $query->execute([$title, $author, $cover_url, $first_publish_year, $description, $id]);
                error_log("Books table updated: $title ($id)\n", 3, "debug.log");
            } catch (PDOException $e) {
                error_log("Books Table Error: " . $e->getMessage() . "\n", 3, "debug.log");
            }



            // Log registration success
            $logMessage = date("Y/m/d") . "\t" . date("h:i:sa") . "\tBook added successfully!\t {$title}\n";
            error_log($logMessage, 3, "admin/book_logs.log");

            
            echo json_encode(['success' => true, 'message' => 'Book added successfully!']);
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
