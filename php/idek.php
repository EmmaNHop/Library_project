<?php
// Include database connection
$host = "localhost";  // Change as needed
$username = "root";   // Change as needed
$password = "";       // Change as needed
$database = "books_db"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to save the book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $coverUrl = $_POST['cover_url'];

    // Prepare and execute the query to insert book data into the database
    $stmt = $conn->prepare("INSERT INTO books (book_id, title, author, cover_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $bookId, $title, $author, $coverUrl);

    if ($stmt->execute()) {
        $successMessage = "Book saved successfully!";
    } else {
        $errorMessage = "Error saving book.";
    }

    $stmt->close();
}
$conn->close();
?>

<?php include 'header.php'; ?>

<div class="book-item">
    <?php
    // Example book data (replace with dynamic data as needed)
    $bookId = "OL27448W"; // Replace with dynamic book ID
    $title = "Sample Book Title";
    $author = "Sample Author";
    $coverUrl = "https://covers.openlibrary.org/b/id/12345-L.jpg"; // Replace with dynamic cover URL
    ?>

    <form method="POST" action="">
        <?php if (!empty($coverUrl)) { ?>
            <img src="<?php echo htmlspecialchars($coverUrl); ?>" alt="<?php echo htmlspecialchars($title); ?> cover" />
        <?php } ?>
        <h3><?php echo htmlspecialchars($title); ?></h3>
        <p><?php echo htmlspecialchars($author); ?></p>
        
        <!-- Hidden inputs to pass book data to the server -->
        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($bookId); ?>">
        <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
        <input type="hidden" name="author" value="<?php echo htmlspecialchars($author); ?>">
        <input type="hidden" name="cover_url" value="<?php echo htmlspecialchars($coverUrl); ?>">

        <button type="submit" class="btn btn-outline-secondary">Save to Database</button>
    </form>

    <?php if (isset($successMessage)) { ?>
        <p class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></p>
    <?php } elseif (isset($errorMessage)) { ?>
        <p class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
