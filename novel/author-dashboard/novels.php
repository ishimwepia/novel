<?php

include 'connect.php';
$sql = "SELECT * FROM novels ORDER BY title";
$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>author dashboard</title>
    <link rel="stylesheet" href="novels.css">
</head>
<body>
        <!-- header -->
    <header class="header">
        <div class="container header-container">
            <h1 class="header-title">E-novel Author Dashboard</h1>
            <div class="user-info">
                <div class="user-avatar">C</div>
                <span class="user-role">Author User</span>
            </div>
        </div>
    </header>

        <!-- navigation -->
    <div class="container"> 
        <nav class="navbar">
            <div class="navmenu">
                <a href="author-dashboard.php" class="nav-link">Overview</a>
                <a href="novels.html" class="nav-link active">My Novels</a>
                <a href="#" class="nav-link">Earning</a>
                <a href="#" class="nav-link">Analytics</a>
                <a href="#" class="nav-link">settting</a>
            </div>
        </nav>


        <!-- novels content -->

        <div class="novel-content">
            <div class="book-grid">
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($novel = mysqli_fetch_assoc($result)) {
                        ?>
                        
                    <div class="book-card">
                        <img src="images/<?php echo ($novel['image']);?>" alt="">
                        <h3 class="title"> <?php echo ($novel['title']);?> </h3>
                        <div class="adding-chapter">
                            <button class="upload">Upload chapters</button>
                            <button class="add">New chapter</button>
                        </div>
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

        