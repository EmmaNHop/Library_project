        <?php include_once('header.php'); ?>
        
        <?php include_once('popup.php'); ?>
        <div class="settings">
        
            <div class="row justify-content-center">        
                <div class="col-10 col-lg-6 col-xl-5  mr-0">
                    <h2 class="h3 mb-4 page-title ">Friends</h2>
                    <div class="my-4">
                        <hr class="white-line">

                        <?php 
                    // Example friends array (in real use, fetch from the database)
                    $friends = [
                        ["id" => 1, "name" => "John Doe", "profile_pic" => "john.jpg"],
                        ["id" => 2, "name" => "Sarah Miller", "profile_pic" => "sarah.jpg"],
                        ["id" => 3, "name" => "Emily Johnson", "profile_pic" => "emily.jpg"],
                        ["id" => 4, "name" => "Alex Smith", "profile_pic" => "alex.jpg"]
                    ];

                    // Loop through friends
                    foreach ($friends as $friend) {
                    ?>
                        <div class="friend-item d-flex align-items-center mb-4 p-3 bg-dark rounded">
                            <!-- Profile Picture -->
                            <img src="images/<?php echo $friend['profile_pic']; ?>" alt="<?php echo $friend['name']; ?>" class="rounded-circle me-3" width="50" height="50">
                            
                            <!-- Friend Info -->
                            <div class="flex-grow-1">
                                <h5 class="mb-1"><?php echo $friend['name']; ?></h5>
                                
                            </div>
                            
                            <!-- Message Button -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal<?php echo $friend['id']; ?>">Message</button>
                        </div>

                        <!-- Message Modal -->
                        <div class="modal fade" id="messageModal<?php echo $friend['id']; ?>" tabindex="-1" aria-labelledby="messageModalLabel<?php echo $friend['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="messageModalLabel<?php echo $friend['id']; ?>">Send a message to <?php echo $friend['name']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="send_message.php" method="POST">
                                            <div class="mb-3">
                                                <label for="messageText<?php echo $friend['id']; ?>" class="form-label">Message</label>
                                                <textarea name="message" id="messageText<?php echo $friend['id']; ?>" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <input type="hidden" name="friend_id" value="<?php echo $friend['id']; ?>">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <hr class="grey-line">   
                </div>
                <div class="col-9 col-lg-3 col-xl-2 ml-0 bg-dark text-white p-3 rounded shadow-sm">
                    <h5 class="text-center">Friends Activity</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark text-white">php content latest book review or read</li>
                        <li class="list-group-item bg-dark text-white">php content latest book review or read</li>
                        <li class="list-group-item bg-dark text-white">php content latest book review or read</li>
                        <li class="list-group-item bg-dark text-white">php content latest book review or read</li>
                    </ul>
                </div>

            </div>         
        </div>
    
                        
                   
        <?php include_once('footer.php'); ?>