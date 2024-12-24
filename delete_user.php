<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'konsep');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Query untuk menghapus data
    $sql = "DELETE FROM users WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully'); window.location.href='index.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
