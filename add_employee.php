<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');
$departments_result = $conn->query("SELECT id, name FROM departments");
$locations_result = $conn->query("SELECT id, location_name FROM work_locations");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department_id = $_POST['department_id'];
    $work_location_id = $_POST['work_location_id'];
    $base_salary = $_POST['base_salary'];
    $email = $_POST['email'];

    $sql = "INSERT INTO employees (name, position, department_id, work_location_id, base_salary, email) 
            VALUES ('$name', '$position', $department_id, $work_location_id, $base_salary, '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Employee added successfully!</p>";
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
    <title>Add Employee</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Add Employee
    </header>
    <div class="container">
        <form method="POST" action="">
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Position:</label>
            <input type="text" name="position" required>
            
            <label>Department:</label>
            <select name="department_id" required>
                <option value="">Select Department</option>
                <?php while ($row = $departments_result->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            
            <label>Work Location:</label>
            <select name="work_location_id" required>
                <option value="">Select Work Location</option>
                <?php while ($row = $locations_result->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['location_name'] ?></option>
                <?php endwhile; ?>
            </select>
            
            <label>Base Salary:</label>
            <input type="number" name="base_salary" step="0.01" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <button type="submit">Add Employee</button>
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
