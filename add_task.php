<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task'];

    $sql = "INSERT INTO tasks2 (task_name) VALUES ('$task_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New task added successfully!";
        header("Location: task_manager.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>