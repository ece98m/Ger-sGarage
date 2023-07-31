<?php

require '../userpages/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Delete part
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $part_id = $_POST["part_id"];
        
        // Query to delete a part from the 'parts' table
        $sql = "DELETE FROM parts WHERE part_id = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $part_id); // "i" means integer
    
        if ($stmt->execute()) {
            echo "Part deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    
    // Add part
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        $part_name = $_POST["part_name"];
        $price = $_POST["price"];
    
        // Query to add a new part to the 'parts' table
        $sql = "INSERT INTO parts (part_name, price) VALUES (?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sd", $part_name, $price); // "sd" means string and double

        if ($stmt->execute()) {
            echo "New part added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
// Update price
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $part_id = $_POST["part_id"];
    $price = $_POST["price"];

    // Query to update the price in the 'parts' table
    $sql = "UPDATE parts SET price = ? WHERE part_id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("di", $price, $part_id); // "di" means double and integer

    if ($stmt->execute()) {
        echo "Price updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Query to retrieve data from the 'parts' table
$sql = "SELECT part_id, part_name, price FROM parts";

// Execute the query
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Parts List</title>
    <!-- Add any additional CSS or JavaScript here -->
</head>
<body>
   
<!-- Form to add new parts -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <input type="hidden" name="action" value="add">
    <label for="part_name">Product Name:</label><br>
    <input type="text" id="part_name" name="part_name"><br>
    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price"><br>
    <input type="submit" value="Add">
</form>

<!-- Form to delete part -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <input type="hidden" name="action" value="delete">
    <label for="part_id">Product ID:</label><br>
    <input type="text" id="part_id" name="part_id"><br>
    <input type="submit" value="Delete">
</form>
<!-- Form to update the price -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <input type="hidden" name="action" value="update">
    <label for="part_id">Product ID:</label><br>
    <input type="text" id="part_id" name="part_id"><br>
    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price"><br>
    <input type="submit" value="Update">
</form>

    <br>

    <table>
        <tr>
            <th>Part ID</th>
            <th>Part Name</th>
            <th>Price</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["part_id"] ?></td>
                <td><?= $row["part_name"] ?></td>
                <td>$<?= $row["price"] ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No parts found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php
// Close the connection
$mysqli->close();
?>
