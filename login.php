<?php
include 'connect.php';
require_once 'aunthenticate.php';
// session_start();

if (isLoggedIn()){
    redirectBasedOnUserType();
    exit();
}

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirectBasedOnUserType(){
    if($_SESSION['user_type']=='reader'){
        header("location:index.php");
    } elseif($_SESSION['user_type']=='author'){
        header("location:dashboard.php");
    } elseif($_SESSION['user_type']=='admin'){
        header("location:admin_dashboard.php");
    } else{
        header("location:index.php");
    }

    exit();
}

if (isset($_POST['submit'])){
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);


    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1){
        $user = $result->fetch_assoc();

        echo "Stored Password Hash: " . $user['password'] . "<br>";
        echo "Input Password: " . $hashedInputPassword . "<br>";

        $verify_result = password_verify($password, $user['password']);

        echo "Password Verification Result: " . ($verify_result ? "Success" : "Failed") . "<br>";

        if ($verify_result){
    
            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            
            session_regenerate_id(true);
            
            header("Location: index.php");
            exit();
        }
        else{
    
            echo "Login Failed! Incorrect Password";
            exit();
        }
    }
    else {
        echo "No user found with this username";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>E_novel login</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
                <i class="bi bi-person"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class="bi bi-file-lock"></i>
            </div>
            <div class="forget">
                <a href="forgot_password.php">Forgot password</a>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
</body>
</html>