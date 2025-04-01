<?php


function getNovels(){
    global $conn;
    $sql = "SELECT * FROM novels ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $novels = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $novels;
}
?>