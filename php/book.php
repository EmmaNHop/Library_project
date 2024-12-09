<?php

include 'header.php';

echo '<div class="settings">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">';

if (isset($_SESSION['book'])) {
    $book = $_SESSION['book'];

    // Get the bookId from the URL
    if (isset($_GET['id'])) {
        $bookId = $_GET['id']; // e.g., "/works/OL82563W"

        // Build the API URL
        $apiUrl = "https://openlibrary.org" . $bookId . ".json";

        // Fetch the book details from the Open Library API
        $response = file_get_contents($apiUrl);

        if ($response !== false) {
            // Decode the JSON response into an associative array
            $bookData = json_decode($response, true);

            // Extract title, author, description, and cover
            $title = $bookData['title'] ?? 'Title not available';
            $description = $bookData['description'] ?? 'No description available';
            $author = $bookData['authors'][0]['name'] ?? 'Author not available';

            if (is_array($description)) {
                $description = $description['value'] ?? 'No description available';
            }
             // Trim the description if it contains "----------" and remove everything below it
             if (is_string($description) && strpos($description, '----------') !== false) {
                $description = substr($description, 0, strpos($description, '----------')); // Get the part before "----------"
            }

            if (is_array($description)) { // Description can be an object or string
                $description = $description['value'] ?? 'No description available';
            }
            $coverId = $bookData['covers'][0] ?? null;
            $coverUrl = $coverId ? "https://covers.openlibrary.org/b/id/$coverId-L.jpg" : '';


            echo '<div class="row align-items-left">';
            // Book cover on the left with styled container
            echo '<div class="col-md-2 text-center">';
            echo '<div style="border: 4px solid rgba(65, 65, 65);; background-color: rgba(95, 95, 95, 0.75);; border-radius: 10px; padding: 10px;">';
            echo '<img src="' . htmlspecialchars($coverUrl) . '" alt="Book Cover" class="img-fluid" style="border-radius: 8px;">';
            echo '</div>';
            echo '</div>';

            // Title and author on the right
            echo '<div class="col-md-8">';
            echo '<h2>' . htmlspecialchars($title) . '</h2>';
            echo '<p>' . htmlspecialchars($author) . '</p>';
            echo '<p>' .  nl2br(htmlspecialchars($description)) . '</p>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>Failed to fetch book details. Please try again later.</p>';
        }
    } else {
        echo '<p>No book selected. Please go back to the search and choose a book.</p>';
    }
}

echo '          </div>
            </div>
        </div>
    </div>';

include 'footer.php';
?>
