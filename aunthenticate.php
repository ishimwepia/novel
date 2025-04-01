<?php  

session_start();

function isLoggedIn(){
    return isset($_SESSION['id']);
}

function requireLogin(){
    if(!isLoggedIn()){
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("login.php");
        exit();

    }

}

function loginUser($id,$username){
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $usename;

    $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
    unset($_SESSION['redirect_url']);
    header("location:".$redirect_url);
    exit();
}

function logoutUser(){
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}

?>