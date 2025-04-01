<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>novel</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <?php
    include 'connect.php';
    require_once 'aunthenticate.php';
    require_once 'function.php';
    $novels = getNovels();

    ?>
    
        <nav class="navbar">
           <div class="logo">E-novel</div>

            <div class="navmenu">
                <a href="index.php">HOME</a>
                <a href="browse.php">BROWSE</a>
                <a href="#contact">ABOUT</a>
                <a href="login.php">LOGIN</a>
            </div>

            <div class="search-box">
                <input type="search" class="search" placeholder="Search...">
                <i class="bi bi-search"></i>
            </div>
        </nav>

        <div class="header">
            <div class="main-header">
                <h1>Dive into endless stories</h1>
                <h2>Explore now!</h2>
                <p>Unlock a world of imagination, read, discover, and transform</p>
                <a href="browse.php" class="btn">start reading</a>
            </div>
        </div>
    

    <!-- browse section -->


        <div class="discovery">
            <h2> Discover your next novel</h2>
            <p>Discover the best books from a wide range of genres.</p>

            <div class="book-grid">

                <?php

                if($novels !== null){
                    
                foreach($novels as $novel){
                    ?>


                <div class="book-card">
                    <img src="images/<?php echo ($novel['image']);?>" alt="">
                    <p class="author">author: <?php echo ($novel['author_id']);?></p>
                    <h3 class="title"> <?php echo ($novel['title']);?> </h3>
                    <p class="price">price:<?php echo ($novel['price']);?>$</p>
                </div>

                        <?php
                        }
                    }else{
                        echo "No novels added yet";
                    }
                    ?>

            </div>
       </div>
    
</body>
</html>