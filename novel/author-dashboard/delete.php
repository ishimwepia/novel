<?php

include 'connect.php';
$_GET['deleteid'];
$sql = "DELETE FROM novels WHERE id = '".$_GET['deleteid']. "'";
if (mysqli_query($conn, $sql)){
    header('location:novels.php');
}else{
    echo "error deleting record:". mysqli_error($conn);
}

?>