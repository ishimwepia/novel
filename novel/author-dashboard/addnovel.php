<?php

include 'connect.php';

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

    $sql = "INSERT INTO novels (title, author_id, price, genre, synopsis, created_at, image) VALUES ('$title', '$author', '$price', '$genre', '$synopsis', '$date', '$image')";

    if (mysqli_query($conn, $sql)){
        echo "Novel added successfully";
    }
    else{
        echo die(mysqli_error($conn, $sql));
}

    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
        $target = "images/".basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            header("location: novels.php");
        }
        else{
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
    <title>Add Novel</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>

    
    <form action="addnovel.php" method="post" enctype="multipart/form-data">
        <h2>Add Novel</h2>
        
        <div class="form-group">
            <label for="cover_image">Cover Image:</label>
            <input type="file" name="image" accept="image/*" required>
            <img value="image" class="image" src="images" alt="Cover preview">
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" value="" placeholder="Enter novel title" required>
        </div>
        
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" name="author" value="" placeholder="Enter author name" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" name="price" value="" >
        </div>
        
        <div class="form-group">
            <label for="genre">Genre:</label>
            <select name="genre" value="genre">
                <option value="fiction">Fiction</option>
                <option value="nonfiction">Non-Fiction</option>
                <option value="romance">Romance</option>
                <option value="thriller">Thriller</option>
                <option value="scifi">Science Fiction</option>
                <option value="fantasy">Fantasy</option>
                <option value="mystery">Mystery</option>
                <option value="biography">Biography</option>
                <option value="history">History</option>
                <option value="selfhelp">Self-Help</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="synopsis">Synopsis:</label>
            <textarea name="synopsis" value="synopsis" placeholder="Enter book description"></textarea>
        </div>
        
        <div class="form-group">
            <label for="publication_date">Publication Date:</label>
            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
        </div>
        
        <button type="submit" name="submit">Add Novel</button>
    </form>

  
</body>
</html>