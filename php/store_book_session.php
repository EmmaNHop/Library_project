<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    $bookData = json_decode($data, true);

    if (!empty($bookData)) {
        $_SESSION['book'] = $bookData;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    }
    exit;
}
?>
