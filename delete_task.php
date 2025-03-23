<?php

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['id'];

    if (empty($task_id)) {
        echo "Error: Task ID is required!";
        exit();
    }

    $sql = "DELETE FROM tasks2 WHERE id = $task_id";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
        // header("Location: task_manager.php");
        // exit();
    } else {
        echo "Error: " . $conn->error;
    }
}


?>