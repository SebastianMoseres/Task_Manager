<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['id'];
    $completed = $_POST['completed'];

    if (empty($task_id)) {
        echo "Error: Task ID is required!";
        exit();
    }

    $sql = "UPDATE tasks2 SET completed = $completed WHERE id = $task_id";

    if ($conn->query($sql) === TRUE) {
        echo "Success"; // Send "Success" to the JavaScript on the front end
    } else {
        echo "Error: " . $conn->error;  // Send error if the query fails
    }
}


?>