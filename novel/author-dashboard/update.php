<?php

include 'connect.php';

$id = $title = $author = $price = $genre = $synopsis = $date = $image = "";

if(isset($_GET['updateid'])){
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM novels WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $author = $row['author_id'];
        $price = $row['price'];
        $genre = $row['genre'];
        $synopsis = $row['synopsis'];
        $date = $row['created_at'];
        $image = $row['image'];
    }
  
}

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $genre = $_POST['genre'];
    $synopsis = $_POST['synopsis'];
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $image = "";
    if(isset($_FILES['image']) && isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
    }

    $sql = "update novels set id= '$id', title = '$title', author_id = '$author', price = '$price', genre = '$genre',
     synopsis = '$synopsis', created_at = '$date', image = '$image' where id = '$id'";

    if (mysqli_query($conn, $sql)){
        header("location: novels.php"); 
    }
    else{
        echo die(mysqli_error($conn, $sql));
}

    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
        $target = "images/".basename($image);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        
            echo "There was a problem uploading the image";
        }
    }
    

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update Novel</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <form action="update.php?updateid=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <h2>update novel</h2>
        
        <div class="form-group">
            <label for="cover_image">Cover Image:</label>
            <input type="file" name="image" accept="image/*" required>
            <img src="images/<?php echo $image; ?>" class="image" alt="Cover preview">
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" placeholder="Enter novel title" required  value="<?php echo $title; ?>">
        </div>
        
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" name="author"  placeholder="Enter author name" required value="<?php echo $author; ?>">
        </div>
        
        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" name="price" value="<?php echo $price; ?>">
        </div>
        
        <div class="form-group">
            <label for="genre">Genre:</label>
            <select name="genre" value="<?php echo $genre; ?>">
                <option value="<?php if($genre=='fiction') echo 'selected'; ?>">Fiction</option>
                <option value="nonfiction"<?php if($genre=='Non-fiction') echo 'selected'; ?>>Non-Fiction</option>
                <option value="romance"<?php if ($genre== 'romance') echo 'selected';?> >Romance</option>
                <option value="thriller"<?php if($genre=='thriller') echo 'selected';?> >Thriller</option>
                <option value="scifi"<?php if($genre=='science fiction') echo 'selected';?> >Science Fiction</option>
                <option value="fantasy"<?php if($genre=='fantasy') echo 'selected';?> >Fantasy</option>
                <option value="mystery"<?php if ($genre=='mystery') echo'selected';?> >Mystery</option>
                <option value="biography"<?php if($genre=='biography') echo 'selcted';?> >Biography</option>
                <option value="history"<?php if($genre=='history') echo 'selected';?> >History</option>
                <option value="horror"<?php if($genre=='horror') echo 'selected';?> >horror</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="synopsis">Synopsis:</label>
            <textarea name="synopsis" placeholder="Enter book description" value="<?php echo $synopsis; ?>"></textarea>
        </div>
        
        <div class="form-group">
            <label for="publication_date">Publication Date:</label>
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
        </div>
        
        <button type="submit" name="submit">update Novel</button>
    </form>

  
</body>
</html>