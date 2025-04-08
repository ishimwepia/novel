<?php

include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-novel Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">

    <div class="header">
      <h1>Welcome </h1>
      <p>Sign in to continue to E_novel</p>
    </div>

    <div class="content">
      <h2>Choose how you want to sign in</h2>

      <div class="role-options">

        <div class="role-option">
          <div class="icon-container">
                <i class="bi bi-book custom-icon"></i>
          </div>
          <div class="role-name">
            <a href="reader_login.php">Reader</a>
          </div>
          <div class="role-description">Browse and read books</div>
        </div>

        <div class="role-option">
          <div class="icon-container">
            <i class="bi bi-vector-pen custom-icon"></i>
          </div>
          <div class="role-name">
            <a href="author_login.php">Author</a>
          </div>
          <div class="role-description">Publish and manage books</div>
        </div>

      </div>
    </div>
  </div>
</body>
</html>