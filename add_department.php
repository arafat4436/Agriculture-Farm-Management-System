<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $manager = $_POST['manager'];

    $sql = "INSERT INTO departments (name, manager) VALUES ('$name', '$manager')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Department added successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Add Department
    </header>
    <div class="container">
        <form method="POST" action="">
            <label>Department Name:</label>
            <input type="text" name="name" required>
            
            <label>Manager Name:</label>
            <input type="text" name="manager" required>
            
            <button type="submit">Add Department</button>
        </form>
        <nav>
            <a href="index.php">Back to Home</a>
        </nav>
    </div>
    <footer>
        &copy; 2024 Employee Payroll Management System. All Rights Reserved.
    </footer>
</body>
</html>
