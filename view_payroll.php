<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');
$sql = "SELECT employees.name, payroll.month, payroll.year, payroll.base_salary, 
               payroll.bonus, payroll.tax, payroll.net_salary 
        FROM payroll 
        JOIN employees ON payroll.employee_id = employees.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payroll</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        View Payroll Records
    </header>
    <div class="container">
        <table>
            <tr>
                <th>Employee Name</th>
                <th>Month</th>
                <th>Year</th>
                <th>Base Salary</th>
                <th>Bonus</th>
                <th>Tax</th>
                <th>Net Salary</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['month'] ?></td>
                    <td><?= $row['year'] ?></td>
                    <td><?= $row['base_salary'] ?></td>
                    <td><?= $row['bonus'] ?></td>
                    <td><?= $row['tax'] ?></td>
                    <td><?= $row['net_salary'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <nav>
            <a href="index.php">Back to Home</a>
        </nav>
    </div>
    <footer>
        &copy; 2024 Employee Payroll Management System. All Rights Reserved.
    </footer>
</body>
</html>
