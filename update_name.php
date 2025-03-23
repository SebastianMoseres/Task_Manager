<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_manager";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $new_name = $_POST['new_name'];

    // Update query
    $sql = "UPDATE your_table_name SET name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_name, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Name</title>
</head>
<body>
    <h2>Update Name</h2>
    <form method="POST" action="">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" required><br><br>
        <label for="new_name">New Name:</label>
        <input type="text" id="new_name" name="new_name" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>