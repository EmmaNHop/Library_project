<?php
    session_start();

?>

<!doctype html>
<html class="no-js" lang="">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Slackey&family=Roboto:wght@100;300;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../css/settings_style.css"/>
        <link rel="stylesheet" type="text/css" href="../css/colors.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/api.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="nav-link ml-4" href="../php/search.php" role="button" ><h2  style="margin:0;"><i class="bi bi-book-half"></i></h2></a>
                <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent"     aria-controls="navbarSupportedContent" aria-expanded="false"    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse"     id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Lists</button>
                              <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="read_list.php"><i class="bi bi-book-fill"></i>&nbsp Read</a></li>
                                <li><a class="dropdown-item" href="want_list.php"><i class="bi bi-book" style="margin-right: 5px;"></i>&nbsp Want to Read</a></li>
                                <li><a class="dropdown-item" href="create_list.php"><i class="bi bi-plus-lg"></i>&nbsp New List</a></li>
                              </ul>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="friends.php">Friends</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="book_club.php">Book Club </a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input name="query" class="form-control mr-sm-2" type="search"     placeholder="Search for a book title" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0"  type="submit">Search</button>
                    </form>
                    
                    <a class="nav-link mr-4" href="../php/settings_acct.php" role="button" ><h2  style="margin:0;"><i class="bi bi-person-circle" ></i></h3></a>
                    

                </div>
            </nav>
        </header>
        