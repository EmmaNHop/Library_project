<?php
include_once('header.php');

// Database connection settings
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

// Create a connection
try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Query to select all data from the 'books' table
    $sql = "SELECT * FROM books";
    $stmt = $pdo->query($sql); // Use query method to get results

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Handle review submission (if POST request is received)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];

    // Insert review into the database
    try {
        $sql = "INSERT INTO reviews (book_id, rating, description) VALUES (:book_id, :rating, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':book_id' => $book_id,
            ':rating' => $rating,
            ':description' => $description
        ]);
        echo "<script>alert('Review submitted successfully!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<div class="list">
    <div class="row justify-content-center">
        <div class="col-10 col-lg-6 col-xl-5 mx-auto">
            <h2 class="h3 mb-4 page-title ">Read List</h2>
            <div class="list-group mb-5 shadow">
                <div class="list-group-item">
                <div class="row align-items-center">
                <div class="col d-flex flex-column justify-content-center">

                    <?php if ($stmt->rowCount() > 0): ?> <!-- Use rowCount() to check if there are rows -->
                        <table class="table" style="color:white">
                            <tbody>
                                <?php while($row = $stmt->fetch()): ?> <!-- Use fetch() to get data row by row -->
                                    <tr>
                                        <td>
                                            <?php if ($row['cover_url']): ?>
                                                <img src="<?php echo htmlspecialchars($row['cover_url']); ?>" alt="Cover image" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                                <p>No image available</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                                        <td>
                                            <!-- Button to trigger modal -->
                                            
                                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#reviewModal" onclick="openPopup('<?php echo $row['id']; ?>')">
                                                Review
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No books found.</p>
                    <?php endif; ?>

                </div>
            </div>         
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Rate this Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="book_id" id="book_id">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-control" name="rating" id="rating" required>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>

<script>
    // Set the book ID in the modal when the "Review" button is clicked
    $('#reviewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var bookId = button.data('book-id'); // Extract book ID from data attribute
        var modal = $(this);
        modal.find('#book_id').val(bookId);
    });
</script>
