<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');
$employees_result = $conn->query("SELECT id, name FROM employees");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (employee_id, date, status) 
            VALUES ($employee_id, '$date', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Attendance marked successfully!</p>";
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
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Mark Attendance
    </header>
    <div class="container">
        <form method="POST" action="">
            <label>Employee:</label>
            <select name="employee_id" required>
                <option value="">Select Employee</option>
                <?php while ($row = $employees_result->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            
            <label>Date:</label>
            <input type="date" name="date" required>
            
            <label>Status:</label>
            <select name="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Leave">Leave</option>
            </select>
            
            <button type="submit">Mark Attendance</button>
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
