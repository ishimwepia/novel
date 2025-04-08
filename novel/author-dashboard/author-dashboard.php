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
                <a href="author-dashboard.php" class="nav-link active">Overview</a>
                <a href="novels.php" class="nav-link ">My Novels</a>
                <a href="#" class="nav-link">Earning</a>
                <a href="#" class="nav-link">Analytics</a>
                <a href="#" class="nav-link">settting</a>
            </div>
        </nav>


        <!-- novels content -->

        <div class="novel-content">
        <div class="stat-grid">
                <div class="stat-card">
                    <p class="stat-label">Total novels</p>
                    <p class="stat-value">60</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Total views</p>
                    <p class="stat-value">1200</p>
                </div>
            
                <div class="stat-card">
                    <p class="stat-label">My earning</p>
                    <p class="stat-value">2400$</p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Ratings</p>
                    <p class="stat-value">4.5</p>
                </div>
            </div>

            <h2 class="section-title">My Novels</h2>
        
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Novels</h3>
                    <button class="btn"><a href="addnovel.php">New novel +</a></button>
                </div>
           
                <div class="card-body">
                    <div class="filter">
                        <input type="text" class="search-input" placeholder="Search novels...">
                        <select class="filter-select">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="review">Review</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                              <th>id</th>
                              <th>Title</th>
                              <th>Author</th> 
                              <th>Price($)</th> 
                              <th>Genre</th>
                              <th>Chapters</th>
                              <th>Status</th>
                              <th>Views</th>
                              <th>date-created</th>
                              <th>Actions</th>
                            </tr>
                        </thead>

                        <?php
                         include 'connect.php';
                            $sql = "SELECT * FROM novels ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows ($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                    
                                    echo"<tbody>";
                                        echo"<tr>";
                                            echo"<td>".$row['id']."</td>";
                                            echo"<td>".$row['title']."</td>";
                                            echo"<td>".$row['author_id']."</td>";
                                            echo"<td>".$row['price']."</td>";
                                            echo"<td>".$row['genre']."</td>";
                                            echo"<td>".$row['chapters']."</td>";
                                            echo"<td>".$row['status']."</td>";
                                            echo"<td>".$row['views']."</td>";
                                            echo"<td>".$row['created_at']."</td>";
                                            echo"<td class='actions'>";
                                                echo"<button class='btn-action view'><a href=''>View</a></button>";
                                                echo"<button class='btn-action edit'><a href='update.php?updateid=".$row['id']."'>Edit</a></button>";
                                                echo"<button class='btn-action delete'><a href='delete.php?deleteid=".$row['id']."'>Delete</a></button>";
                                                // echo"<button class='btn-action chapter'><a href=''>add chapter</a></button>";
                                            echo"</td>";
                                        echo"</tr>";
                                    echo"</tbody>";
                                }
                             }
                        ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>

        