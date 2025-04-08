<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['author_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the logged-in author's ID
$author_id = $_SESSION['author_id'];

include 'connect.php';

// Prepare a query to select only novels by the current author
$sql = "SELECT * FROM novels WHERE author_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $author_id);
$stmt->execute();
$result = $stmt->get_result();

// Display the novels
if ($result->num_rows > 0) {
    echo "<h1>My Novels</h1>";
    echo "<div class='novel-list'>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<div class='novel-item'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        // Display other novel information
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        // Add edit and delete buttons if needed
        echo "<a href='edit_novel.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete_novel.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>";
        echo "</div>";
    }
    
    echo "</div>";
} else {
    echo "<p>You haven't published any novels yet.</p>";
    echo "<a href='add_novel.php'>Add your first novel</a>";
}

// Close connection
$stmt->close();
$conn->close();
?>