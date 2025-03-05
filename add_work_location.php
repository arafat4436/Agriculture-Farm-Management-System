<?php
$conn = new mysqli('localhost', 'root', '', 'payroll_system');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_name = $_POST['location_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $sql = "INSERT INTO work_locations (location_name, address, city, state, country) 
            VALUES ('$location_name', '$address', '$city', '$state', '$country')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Work Location added successfully!</p>";
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
    <title>Add Work Location</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        Add Work Location
    </header>
    <div class="container">
        <form method="POST" action="">
            <label>Location Name:</label>
            <input type="text" name="location_name" required>
            
            <label>Address:</label>
            <input type="text" name="address" required>
            
            <label>City:</label>
            <input type="text" name="city" required>
            
            <label>State:</label>
            <input type="text" name="state" required>
            
            <label>Country:</label>
            <input type="text" name="country" required>
            
            <button type="submit">Add Location</button>
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
