<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');
$employees_result = $conn->query("SELECT id, name FROM employees");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $bonus = $_POST['bonus'];
    $tax_rate = $_POST['tax_rate'];

    $sql = "SELECT base_salary FROM employees WHERE id = $employee_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $base_salary = $row['base_salary'];
        $tax = ($tax_rate / 100) * $base_salary;
        $net_salary = $base_salary + $bonus - $tax;

        $payroll_sql = "INSERT INTO payroll (employee_id, month, year, base_salary, bonus, tax, net_salary)
                        VALUES ($employee_id, $month, $year, $base_salary, $bonus, $tax, $net_salary)";

        if ($conn->query($payroll_sql) === TRUE) {
            echo "<p style='color: green;'>Payroll generated successfully! Net Salary: $net_salary</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Employee not found!</p>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Payroll</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Generate Payroll
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
            
            <label>Month (1-12):</label>
            <input type="number" name="month" min="1" max="12" required>
            
            <label>Year:</label>
            <input type="number" name="year" required>
            
            <label>Bonus:</label>
            <input type="number" name="bonus" step="0.01" required>
            
            <label>Tax Rate (%):</label>
            <input type="number" name="tax_rate" step="0.01" required>
            
            <button type="submit">Generate Payroll</button>
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
