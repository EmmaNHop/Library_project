
<?php include_once('header.php'); 


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

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user'])) {
    // If no user data in session, redirect to login page or show an error
    header("Location: signIn.php");
    exit;
} 
try {
    $pdo = new PDO('mysql:host=localhost;dbname=library', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exception handling for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

$user = $_SESSION['user']; // Get user data from session


$stmt = $pdo->prepare('SELECT * FROM users WHERE user_name = ?');
$stmt->execute([$user['username']]);
$db_user = $stmt->fetch();

// Set default values if fields are null or empty
$phone_number = !empty($db_user['phone_number']) ? $db_user['phone_number'] : ' ';
$profile_picture = !empty($db_user['profile_picture']) ? $db_user['profile_picture'] : 'https://static.vecteezy.com/system/resources/thumbnails/010/260/479/small_2x/default-avatar-profile-icon-of-social-media-user-in-clipart-style-vector.jpg';
$bio = !empty($db_user['bio']) ? $db_user['bio'] : 'No bio available';



// Handle the update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $field = $_POST['field'];
    $new_value = $_POST['new_value'];

    // Prepare an update query based on the field to be updated
    $updateQuery = '';
    switch ($field) {
        case 'User Name':
            $updateQuery = 'UPDATE users SET user_name = ? WHERE user_name = ?';
            break;
        case 'Email':
            $updateQuery = 'UPDATE users SET email = ? WHERE user_name = ?';
            break;
        case 'Phone Number':
            $updateQuery = 'UPDATE users SET phone_number = ? WHERE user_name = ?';
            break;
        case 'Password':
            
            $updateQuery = 'UPDATE users SET password = ? WHERE user_name = ?';
            break;
        case 'Profile Picture':
            $updateQuery = 'UPDATE users SET profile_picture = ? WHERE user_name = ?';
            break;
        case 'Bio':
            $updateQuery = 'UPDATE users SET bio = ? WHERE user_name = ?';
            break;
    }

    if ($updateQuery) {
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$new_value, $user['username']]);
        
        if ($field === 'User Name') {
            $_SESSION['user']['username'] = $new_value; // Update session username
        }

        // Redirect or reload to reflect changes
        header('Location: settings_acct.php');
        exit;
    }
}


?>


<div class="settings">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <h2 class="h3 mb-4 page-title ">Settings</h2>
            <div class="my-4">
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab"   href="settings_acct.php" role="tab" aria-controls="contact"    aria-selected="false">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="settings_notif.php" role="tab" aria-controls="contact"    aria-selected="false">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="review.php" role="tab" aria-controls="contact"    aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="row">
                    <div class = "col">
                        <h5 class="mb-0 mt-5">Account Settings</h5>
                        <p>Customize your profile</p>
                        <button type="button" class="btn btn-custom-success">&nbsp</button>
                        <button type="button" class="btn btn-custom-primary">&nbsp</button>
                        <button type="button" class="btn btn-custom-danger">&nbsp</button>
                        <button type="button" class="btn btn-custom-warning">&nbsp</button>
                    </div>
                    <div class="col-4 col-md-2 col-lg-2">
                        <img src="<?php echo htmlspecialchars($profile_picture); ?>" class="rounded-circle mx-auto d-block img-fluid">

                    </div>
                </div>
                
                
                <hr class="my-4" />
                <strong class="mb-0">User Information</strong>
                
                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col d-flex flex-column justify-content-center">
                                <strong class="mb-0">Username</strong>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($db_user['user_name']); ?></p>
                                <p class="text-muted mb-0"> </p>
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('User Name', '<?php echo htmlspecialchars($db_user['user_name']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>                    
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Email</strong><text class="text-muted ml-3 mb-0">(Private)</text>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($db_user['email']); ?></p>
                                
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('Email', '<?php echo htmlspecialchars($db_user['email']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Phone Number</strong><text class="text-muted ml-3 mb-0">(Private)</text>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($db_user['phone_number']); ?></p>
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('Phone Number', '<?php echo htmlspecialchars($db_user['phone_number']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Password</strong>
                                <p class="text-muted mb-0">************</p>
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('Password', '<?php echo htmlspecialchars($db_user['password']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>

                        </div>
                    </div>
                    
                </div>

                <hr class="my-4" />
                <strong class="mb-0">Profile Information</strong>

                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Profile Picture</strong>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($db_user['profile_picture']); ?></p>
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('Profile Picture', '<?php echo htmlspecialchars($db_user['profile_picture']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>

                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Bio</strong>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($db_user['bio']); ?></p>
                            </div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openPopup('Bio', '<?php echo htmlspecialchars($db_user['bio']); ?>')">
                                <i class="bi bi-pencil-square"></i>&nbsp Edit
                            </button>

                        </div>
                    </div>
                </div>

                <hr class="my-4" />
                <strong class="mb-0">Admin</strong>
                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col d-flex flex-column justify-content-center">
                                <strong class="mb-0">Logout</strong>
                            </div>
                            <!-- Logout button wrapped in a form -->
                            <form action="logout.php" method="POST">
                                <button type="submit" class="btn btn-dark" style="color:rgb(255, 86, 86);">
                                    <i class="bi bi-x-octagon"></i>&nbsp Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col d-flex flex-column justify-content-center">
                                <strong class="mb-0">Delete Account</strong>
                                <p class="mb-0 " style="color:rgb(255, 86, 86);">This action is permanent</p>
                            </div>
                            <form action="delete.php" method="POST">
                            <input type="hidden" name="user_name" value="<?php echo $username; ?>" />
                            <button type="button" class="btn btn-dark" style="color:rgb(255, 86, 86);">
                                <i class="bi bi-x-octagon"></i>&nbsp Delete
                            </button>
                            
                            </form>
                            

                            
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="grey-line">
        </div>

    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit <span id="fieldName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="field" id="hiddenField" />
                        <div class="mb-3">
                            <label for="editFieldInput" class="form-label"></label>
                            <input type="text" class="form-control" name="new_value" id="editFieldInput" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openPopup(field, currentValue) {
    // Set the modal title to indicate which field is being edited
        document.getElementById('fieldName').textContent = field;
        document.getElementById('hiddenField').value = field;
        document.getElementById('editFieldInput').value = currentValue;
}
</script>

</div>

<?php include_once('footer.php'); ?>