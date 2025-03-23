<?php
include 'db_connect.php';



$sql = "SELECT * FROM tasks2";
$result = $conn->query($sql);


// if ($result->num_rows > 0) {
//     echo "<table class='table'>";
//     echo "<tr><th>ID</th><th>Task</th><th>Completed</th><th>Actions</th></tr>";
//     while($row = $result->fetch_assoc()) {
//         echo "<tr>";
//         echo "<td>" . $row["id"] . "</td>";
//         echo "<td>" . $row["task_name"] . "</td>";
//         echo "<td>" . ($row["completed"] ? 'Yes' : 'No') . "</td>";
//         echo "<td><button class='btn btn-danger' onclick='deleteTask(" . $row["id"] . ")'>Delete</button></td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// } else {
//     echo "No tasks found!";
// }

?>

<!DOCTYPE html>
<html lang="en">
<style>
    .title-banner {
        background-color: #6c757d;
        /* Softer grayish-blue color */
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
    }
    
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">


<body>
    <div class="title-banner">
        Task Manager
        <div style="font-size: 1rem; font-weight: normal; margin-top: 10px;">
            by seb
        </div>
    </div>

    <div class="container mt-5">
        <h2>Add New Task</h2>
        <form action="add_task.php" method="POST">
            <input type="text" class="form-control" id="task" name="task" placeholder="Enter Task" required><br><br>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <!Display Taks awig>
            <?php if ($result->num_rows > 0): ?>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Completed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['task_name']; ?></td>
                                <td><?php echo $row['completed'] ? 'Yes' : 'No'; ?></td>

                                <td>
                                    <button class="btn btn-info"
                                        onclick="toggleCompletion(<?php echo $row['id']; ?>, <?php echo $row['completed']; ?>)">Toggle
                                        Completion</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger"
                                        onclick="deleteTask(<?php echo $row['id']; ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No tasks found!</p>
            <?php endif; ?>
    </div>


    <!-- //
     * JavaScript Function: deleteTask
     * 
     * This function is used to delete a task dynamically using AJAX. It sends an asynchronous 
     * HTTP POST request to the server to delete a task identified by its unique ID. Upon 
     * successful deletion, the page is reloaded to reflect the updated task list.
     * 
     * @param {number} taskId - The unique identifier of the task to be deleted.
     * 
     * Functionality:
     * - Creates an XMLHttpRequest object to handle the AJAX request.
     * - Sends a POST request to the "delete_task.php" endpoint with the task ID as a parameter.
     * - Sets the appropriate request header for form data.
     * - Handles the server response:
     *   - If the response is "Success", an alert is displayed to confirm the deletion, 
     *     and the page is reloaded to update the task list.
     *   - If the response indicates an error, an alert is displayed to notify the user.
     * 
     * Note:
     * - This function assumes that the server-side script "delete_task.php" is properly 
     *   implemented to handle the deletion of tasks and return appropriate responses.
     * - The page reloads after a successful deletion to ensure the task list is updated.
     */ -->
    <script>
        // JavaScript to Delete Tasks Dynamically
        function deleteTask(taskId) {
            // AJAX means asynchronous JavaScript and XML. It is a set of web development 
            // techniques using many web technologies on the client side to create asynchronous web applications. 
            // With AJAX, web applications can send and retrieve data from a server asynchronously without 
            // interfering with the display and behavior of the existing page.
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "delete_task.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + taskId);

            xhttp.onload = function () {
                if (this.responseText == "Success") {
                    alert("Task deleted!");
                    location.reload(); // Reload the page to update the task list
                } else {
                    alert("Error deleting task!");
                }
            };
        }

        function toggleCompletion(taskId, currentStatus) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "toggle_completion.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Toggle completion status (1 = completed, 0 = not completed)
            var newStatus = currentStatus == 1 ? 0 : 1;

            // Send task ID and new completion status
            xhttp.send("id=" + taskId + "&completed=" + newStatus);

            xhttp.onload = function () {
                if (this.responseText == "Success") {
                    alert("Task completion status updated!");
                    location.reload(); // Reload the page to show updated status
                } else {
                    alert("Error updating task completion status!");
                }
            };
        }
    </script>

    <div class="text-center mt-5">
        <img src="download.jpeg" alt="Task Manager Image" class="img-fluid bottom-image"
            style="max-width: 100%; height: auto;">
    </div>
</body>

</html>