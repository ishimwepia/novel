<?php
include 'connect.php';

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isPasswordStrong($password) {
    return (
        strlen($password) >= 8 && 
        preg_match("/[A-Z]/", $password) && 
        preg_match("/[a-z]/", $password) && 
        preg_match("/[0-9]/", $password) && 
        preg_match("/[^a-zA-Z0-9]/", $password) 
    );
}


if (isset($_POST['register'])) {
    
    $name = validateInput($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $type = validateInput($_POST['type']);


    $errors = [];

    if (empty($name)) {
        $errors[] = "Username is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    }

    if (!$email) {
        $errors[] = "Invalid email format";
    }

    if (!isPasswordStrong($password)) {
        $errors[] = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character";
    }

    if (empty($type) || !in_array($type,['reader','author','admin'])) {
        $errors[] = "please select a user type";
    }

    $check_stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($check_stmt, "ss", $name, $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    
    while ($row = mysqli_fetch_assoc($check_result)) {
        // if ($row['username'] === $name) {
        //     echo "Username is already taken";
        //     exit();
        // }
        if ($row['email'] === $email) {
            echo "Email is already registered";
            exit();
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password,user_type) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $type);

        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful. Redirecting to login page...";
            // Add a small delay to see the message
            sleep(2);
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Registration failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <form action="signup.php" method="post">
            <h2>E_novel Sign Up</h2>
            
            <?php
            if (!empty($errors)) {
                echo "<div class='error-messages'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            }
            ?>

            <div class="input-box">
                <input type="text" name="name" placeholder="Username" required 
                       value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                <i class="bi bi-person"></i>
            </div>
            
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required
                       value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                <i class="bi bi-envelope"></i>
            </div>
            
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="bi bi-file-lock"></i>
            </div>

            <div class="input-box">
                <select name="type" required>
                    <option value="" disable selected>select use type</option>
                    <option value="reader" <?php echo (isset($type) AND $type == 'reader')? 'selected': '';?> >reader</option>
                    <option value="author" <?php echo (isset($type) AND $type == 'author')? 'selected': '';?> >author</option>
                    <option value="admin"  <?php echo (isset($type) AND $type == 'admin')? 'selected': '';?> >admin</option>
                </select>
            </div>
                    
            <button type="submit" class="btn" name="register">SignUp</button>
            
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html> 