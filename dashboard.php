

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';
require_once 'aunthenticate.php';
require_once 'function.php';


$sql = "SELECT * FROM authors ORDER BY id";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">E-novel</div>

        <nav class="navbar">
            <div class="navmenu">
                <a href="dashboard.php">DASHBOARD</a>
                <a href="display.php">MY NOVELS</a>
                <a href="addnovel.php">ADD NOVEL</a>
                <a href="#icome">INCOME</a>
                <a href="#profile">MY PROFILE</a>
                <a href="login.php">LOGOUT</a>
            </div>

        </nav>
    </div>
    <!-- <div class="nav"> -->
        <!-- <h1>START YOUR JOURNEY AS AN AUTHOR WITH E-NOVEL</h1> -->
    <!-- </div> -->

    <div class="container">
        <div class="discovery">
            <h2>Our featued authors </h2>
            <p>Explore all authors in E-novel that you can learn from .</p>

            <div class="book-grid">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($author = mysqli_fetch_assoc($result)) {
                        ?>
                        
                    <div class="book-card">
                        <!-- <img src="images/<?php echo ($author['image']);?>" alt=""> -->
                        <p class="author"> <?php echo ($author['author_name']);?></p>
                        <!-- <h3 class="brief"> <?php echo ($author['title']);?> </h3> -->
                        
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