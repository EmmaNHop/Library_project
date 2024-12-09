<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $friend_id = $_POST['friend_id'];
    $message = $_POST['message'];

    // Save the message to the database (example query)
    // $db->query("INSERT INTO messages (friend_id, message) VALUES ('$friend_id', '$message')");

    // Redirect back with a success message
    header('Location: friends.php?success=1');
    exit;
}
?>