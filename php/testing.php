<?php include 'header.php'; ?>

<?php
// Define the book ID (this could be dynamic based on user input or a GET parameter)
$bookId = '/works/OL27448W'; // Replace this with the desired Open Library Work ID

// API URL to fetch book details
$apiUrl = "https://openlibrary.org/search.json?q=";

// Fetch the book data from Open Library API
$response = file_get_contents($apiUrl);

if ($response !== false) {
    // Decode the JSON response into an associative array
    $bookData = json_decode($response, true);

    // Extract the desired details
    $title = isset($bookData['title']) ? $bookData['title'] : 'Title not available';
    $author = isset($bookData['authors'][0]['author']['key']) 
        ? getAuthorName($bookData['authors'][0]['author']['key']) 
        : 'Author not available';
    $coverUrl = isset($bookData['covers'][0]) 
        ? "https://covers.openlibrary.org/b/id/" . $bookData['covers'][0] . "-L.jpg" 
        : '';
} else {
    // Handle error if the API call fails
    $title = 'Title not available';
    $author = 'Author not available';
    $coverUrl = '';
}

// Helper function to fetch author name
function getAuthorName($authorKey) {
    $authorApiUrl = "https://openlibrary.org/search.json?q=$authorKey";
    $authorResponse = file_get_contents($authorApiUrl);
    if ($authorResponse !== false) {
        $authorData = json_decode($authorResponse, true);
        return isset($authorData['name']) ? $authorData['name'] : 'Unknown author';
    }
    return 'Unknown author';
}
?>

<div class="book-item">
    <?php if (!empty($coverUrl)) { ?>
        <img src="<?php echo htmlspecialchars($coverUrl); ?>" alt="<?php echo htmlspecialchars($title); ?> cover" />
    <?php } ?>
    <h3><?php echo htmlspecialchars($title); ?></h3>
    <p><?php echo htmlspecialchars($author); ?></p>
    <button type="button" class="btn btn-outline-secondary" style="margin-left: 5px;">
        <i class="bi bi-book-fill"></i>
    </button>
    <button type="button" class="btn btn-outline-secondary">
        <i class="bi bi-book" style="margin-right: 5px;"></i>
    </button>
</div>

<?php include 'footer.php'; ?>
