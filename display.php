


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display novel</title>
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>

        .table{
            width: 50%;
            margin: auto;
            text-align: center;
            background-color: white;
        }

   


       
    </style>
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

    <div class="container">    
        <table class="table">
            <tbhead>
                <tr>
                    <th>id</th>
                    <th>cover</th>
                    <th>title</th>
                    <th>author</th>
                    <th>price($)</th>
                    <th>genre</th>
                    <th>synopsis</th>
                    <th>date</th>
                    <th>operatons</th>
                </tr>
            </thead>
 
            <?php
                include 'connect.php';
                $sql = "SELECT * FROM novels ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows ($result) > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td><img src='images/".$row['image']."' width='100' height='100'></td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['author_id']."</td>";
                        echo "<td>".$row['price']."</td>";
                        echo "<td>".$row['genre']."</td>";
                        echo "<td class='synopsis' title='".$row['synopsis']."'>".$row['synopsis']."</td>";
                        echo "<td>".$row['created_at']."</td>";
                        echo "<td>";
                        echo "<button class='btn btn-danger btn-sm'> <a href='delete.php?deleteid=".$row['id']."'>delete</a></button>";
                        echo "<button class='btn btn-success btn-sm'><a href='update.php?updateid=".$row['id']."'>update</a></button>";
                        echo"</td>";
                        echo "</tr>";

                    }

                }

                ?>

                
            

        </table>
    </div>
</body>
</html>