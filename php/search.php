
        <!-- add in function to limit amount of books displayed as well as language and edit size of books to fit screen better -->
<?php include_once('header.php'); 

?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8 col-xl-10 mx-auto">
        <div class="my-4">
            <div class = "main">
                <div class="search-spacer">
                    <h1 class="page-title">Search for a book title</h1>
                    <form id="booksearch">
                        <input name="query" type="text" placeholder="Search for a book title">
                    </form>
                </div>
                <div class="bookmatch">
                </div>
            </div>
        </div>
        <hr class="grey-line">
    </div>
</div>

<?php include_once('footer.php'); ?>