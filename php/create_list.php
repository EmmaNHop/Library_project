    <?php include_once('header.php'); ?>
    <?php include_once('popup.php'); ?>
    <div class="settings">
        <div class="row justify-content-center">        

            <div class="col-10 col-lg-6 col-xl-5 mx-auto">
                <h2 class="h3 mb-4 page-title ">Create New List</h2>
                <div class="my-4">
                    <hr class="white-line">
                    <div class = "create">
                        <form>
                            <div class="mb-3">
                                <label for="listName" class="form-label">List Name</label>
                                <input type="text" class="form-control" id="listName">
                            </div>
                            <div class="mb-3">
                                <label for="listDescription" class="form-label">Description</label>
                                <textarea type="text" class="form-control" id="listDescription"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
                <hr class="grey-line">

            </div>         
        </div>
    </div>
    <?php include_once('footer.php'); ?>