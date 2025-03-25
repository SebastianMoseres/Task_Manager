<?php
// Database connection
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Get the task ID
    $new_name = $_POST['new_name']; // Get the new task name

    // Update query for the correct table (tasks2)
    $sql = "UPDATE tasks2 SET task_name = ? WHERE id = ?"; // Correct table name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_name, $id); // 'si' for string and integer binding

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        // Redirect after success
        header("Location: task_manager.php"); // Redirect to task manager
        exit();
    } else {
        // If update fails
        echo "Error updating record: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>