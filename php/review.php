<?php
include_once('header.php');
include ('popup.php');

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
    $sql = "SELECT * FROM review";
    $stmt = $pdo->query($sql); // Use query method to get results



} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

?>

<div class="settings">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <h2 class="h3 mb-4 page-title ">Settings</h2>
            <div class="my-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab"   href="settings_acct.php" role="tab" aria-controls="contact"    aria-selected="false">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="settings_notif.php" role="tab" aria-controls="contact"    aria-selected="false">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="review.php" role="tab" aria-controls="contact"    aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="row align-items-center">
                <div class="col d-flex flex-column justify-content-center">

                    
                

                    <?php if ($stmt->rowCount() > 0): ?> <!-- Use rowCount() to check if there are rows -->
                        <table class="table" style="color:white">
                            <tbody>
                               
                                <?php while($row = $stmt->fetch()): ?> <!-- Use fetch() to get data row by row -->
                                    <tr>
                                    
                                        <td>
                                        <?php echo htmlspecialchars($row['id']); ?>
                                        </td>
                                        <td><?php 
                                    // Display rating as stars
                                    for ($i = 0; $i < $row['rating']; $i++) {
                                        echo '★';
                                    }
                                    for ($i = $row['rating']; $i < 5; $i++) {
                                        echo '☆';
                                    }
                                    ?></td>
                                        <td><?php echo htmlspecialchars($row['written_review']); ?></td>
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

            

        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
