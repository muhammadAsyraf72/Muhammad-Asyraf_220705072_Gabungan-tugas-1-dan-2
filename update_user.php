<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'konsep');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // Query untuk memperbarui data
    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User updated successfully'); window.location.href='index.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
