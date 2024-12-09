var requests, OpenLibrary;
(function () {
    'use strict';

    $.support.cors = true    

    requests = {
        get: function(url, callback) {
            $.get(url, function(results) {
            }).done(function(data) {
                if (callback) { callback(data); }
            });
        },

        post: function(url, data, callback) {
            $.post(url, data, function(results) {
            }).done(function(data) {
                if (callback) { callback(data); }
            });
        },

        put: function(url, data, callback) {
            $.put(url, data, function(results) {
            }).done(function(data) {
                if (callback) { callback(data); }
            });
        },
    };

    OpenLibrary = {
        search: function(query, callback) {
            // Search by title only (query parameter 'q' is the title search)
            var searchUrl = "https://openlibrary.org/search.json?q=" + query;

            requests.get(searchUrl, function(response) {
                // Filter books that have fulltext available
                var filteredResults = response.docs.filter(function(book) {
                    return book.has_fulltext;  // Only include books with full text
                });

                callback(filteredResults);  // Pass the filtered results to the callback function
            });
        },
    };

    var debounce = function (func, threshold, execAsap) {
        var timeout;
        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            };

            if (timeout) {
                clearTimeout(timeout);
            } else if (execAsap) {
                func.apply(obj, args);
            }
            timeout = setTimeout(delayed, threshold || 100);
        };
    };

    // Helper function to send book data to the server
    function storeBookInSessionAndRedirect(bookData, redirectUrl) {
        fetch('store_book_session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(bookData),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log('Book data saved successfully!');
                // Redirect to the target page after saving the session
                window.location.href = redirectUrl;
            } else {
                console.error('Failed to save book data.');
            }
        })
        .catch((error) => console.error('Error:', error));
    }

    // Combined keyup event handler for searching
    $(document).keyup('#booksearch', debounce(function(event) {
        var query = $('#booksearch input').val();
        if (query.trim() === "") {
            $('.bookmatch').empty();  // Clear results if search input is empty
            return;
        }
        
        $('.bookmatch').empty();
        $('.bookmatch').addClass('loader');  // Show the loader when the search starts

        
        
        OpenLibrary.search(query, function(results) {
            $('.bookmatch').removeClass('loader');  // Remove the loader once the results are fetched

            if (results.length > 0) {
                results.forEach(function(match) {
                    var coverUrl = match.cover_i ? 'https://covers.openlibrary.org/b/id/' + match.cover_i + '-L.jpg' : '';
                    var author = match.author_name ? match.author_name.join(", ") : 'Unknown author';
                    var firstPublishYear = match.first_publish_year || 'No publication year available';
                    var bookId = match.key;

                    // Fetch additional details for description
                    


                    var description = match.description ? 'https://openlibrary.org'+ match.description + '.json' : 'No description available'; 

                     // Create the book data object
                     var bookData = {
                        id: bookId,
                        title: match.title,
                        author: author,
                        cover_url: coverUrl,
                        first_publish_year: firstPublishYear,
                        description: description,
                    };

                    // Build the HTML for each book
                    var bookHtml = `
                        
                        
                        <?php $user = $_SESSION['user']['username']; // Get user data from session
                        ?>
                        <div class="book-item">
                            <a href="#" class="book-link" data-book='${JSON.stringify(bookData)}' data-redirect="book.php?id=${bookId}">
                                ${coverUrl ? `<img src="${coverUrl}" alt="${match.title} cover" />` : ''}
                                <h3>${match.title}</h3>
                                <p>${author}</p>
                            </a>
                            <form class="book-form-have-read" action="add_book.php" method="POST" style="display: none;">
                                <input type="hidden" name="title" value="${match.title}">
                                <input type="hidden" name="author" value="${author}">
                                <input type="hidden" name="cover_url" value="${coverUrl}">
                                <input type="hidden" name="publish_year" value="${firstPublishYear}">
                                <input type="hidden" name="description" value="${description}">
                                <input type="hidden" name="id" value="${match.key}">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($user); ?>"> <!-- Dynamically insert the username -->
                                <input type="hidden" name="list" value="have_read"> <!-- For "Have Read" -->
                            </form>
                             <button type="submit" class="btn btn-outline-secondary have-read" style="margin-left: 5px;">
                                    <i class="bi bi-book-fill"></i>
                                </button>
                            <form class="book-form-have-read" action="add_book.php" method="POST" style="display: none;">
                                <input type="hidden" name="title" value="${match.title}">
                                <input type="hidden" name="author" value="${author}">
                                <input type="hidden" name="cover_url" value="${coverUrl}">
                                <input type="hidden" name="publish_year" value="${firstPublishYear}">
                                <input type="hidden" name="description" value="${description}">
                                <input type="hidden" name="id" value="${match.key}">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($user); ?>"> <!-- Dynamically insert the username -->
                                <input type="hidden" name="list" value="want_to_read"> <!-- For "Want to Read" -->
                            </form>
                            <button type="submit" class="btn btn-outline-secondary want-to-read">
                                    <i class="bi bi-book"></i>
                            </button>
                        </div>
                    `;
                    $('.bookmatch').append(bookHtml);
                });

                // Attach click handler to dynamically added links
                $('.book-link').on('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    // Get the book data from the `data-book` attribute
                    var bookData = $(this).data('book');
                    var redirectUrl = $(this).data('redirect');

                    // Send the book data to the server
                    storeBookInSessionAndRedirect(bookData, redirectUrl);
                });

                $('.have-read').on('click', function(event) {
                    event.preventDefault();
                    var form = $(this).closest('.book-item').find('.book-form-have-read');
                    
                    form.submit(); 
                });

                $('.want-to-read').on('click', function(event) {
                    event.preventDefault();
                    var form = $(this).closest('.book-item').find('.book-form-want-to-read');
                    
                    form.submit(); 
                });
            } else {
                $('.bookmatch').append('<p>No results found or no full text available</p>');
            }
        });
    }, 1000, false));

}());

// $('.add-to-book-db').on('click', function() {
    // var form = $(this).closest('.book-item').find('.book-form');
    // form.submit();  // Submit the hidden form when the button is clicked
