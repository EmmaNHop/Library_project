<!-- save notification settings as binary string? 0 not checked, 1 if checked? reduces database usages just write if statement to parse string if fist == 1 checked == true... -->


<?php include_once('header.php'); ?>

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
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="settings_notif.php" role="tab" aria-controls="contact"    aria-selected="false">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="contact-tab" data-toggle="tab" href="review.php" role="tab" aria-controls="contact"    aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <h5 class="mb-0 mt-5" >Notifications Settings</h5>
                <p>Select the notifications you want to receive</p>
                <hr class="my-4" />
                <strong class="mb-0">Activity</strong>
                
                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col d-flex flex-column justify-content-center">
                                <strong class="mb-0">Friend Request</strong>
                                <p class="text-muted mb-0">Recieve a notification when someone wants to connect</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Friend Updates</strong>
                                <p class="text-muted mb-0">Recieve a notification when a friend reads and review a book</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Messages</strong>
                                <p class="text-muted mb-0">Recieve a notification when someone messages you</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    
                    
                </div>
                <hr class="my-4" />
                <strong class="mb-0">System</strong>
                
                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Updates</strong>
                                <p class="text-muted mb-0">Recieve email notifications about new features and updates</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <strong class="mb-0">Account Changes</strong>
                                <p class="text-muted mb-0">Recieve email notifications about account changes</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <strong class="mb-0">Security</strong>
                
                <div class="list-group mb-5 shadow">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col d-flex flex-column justify-content-center">
                                <strong class="mb-0">Device Sign-in</strong>
                                <p class="text-muted mb-0">Recieve email notifications about new device sign-in</p>
                            </div>
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once('footer.php'); ?>