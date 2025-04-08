

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';
require_once 'aunthenticate.php';
requireLogin();
require_once 'function.php';


$sql = "SELECT * FROM novels ORDER BY title";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Novels</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>


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


    <div class="container">
        <div class="discovery">
            <h2>Browse All Novels</h2>
            <p>Explore our complete collection of novels across various genres.</p>

            <div class="book-grid">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($novel = mysqli_fetch_assoc($result)) {
                        ?>
                        
                    <div class="book-card">
                        <img src="images/<?php echo ($novel['image']);?>" alt="">
                        <p class="author">author: <?php echo ($novel['author_id']);?></p>
                        <h3 class="title"> <?php echo ($novel['title']);?> </h3>
                        <p class="price">price:<?php echo ($novel['price']);?>$</p>
                    </div>

                        <?php
                    }
                } else {
                    echo "<p>No novels available at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>