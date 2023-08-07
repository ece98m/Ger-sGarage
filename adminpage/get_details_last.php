<?php
require "../userpages/connection.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Adding the selected parts on invoice
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["selected_parts"])) {
    $booking_id = $_POST["booking_id"];
    $successMessages = []; // Array to store success messages

    foreach ($_POST["selected_parts"] as $part_id_value) {
        // Use prepared statements to avoid SQL injection.
        $sql = "INSERT INTO part_cost (part_id, bill_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $part_id_value, $booking_id);
        if ($stmt->execute()) {
            $successMessages[] = "Part added successfully"; // Store the success message in the array
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }
    }
}
if (!empty($successMessages)) {
    foreach ($successMessages as $message) {
        echo '<p style="color: green;">' . $message . "</p>";
    }
}

if (empty($_POST["selected_parts"])) { ?>

<head>
</head>
<body>
    <form method="post" action="" id="booking_last">
        <label for="booking_id">Booking ID:</label>
        <input type="text" name="booking_id" id="booking_id" required>
        <br>
        <label>Parts and Products:</label><br>
        <?php foreach ($parts as $part_id => $part_name) {
            echo '<input type="checkbox" name="selected_parts[]" value="' .
                $part_id .
                '"> ' .
                $part_name .
                "<br>";
        } ?>
        <br>
        <input type="submit" name="submit" value="Add on Receipt">
    </form>
    
</body>

<script>
    $(document).ready(function() {
        $("#booking_last").on("submit", function(e) {
            e.preventDefault();
            var formValues= $(this).serialize();
            var formattedDate = formatDate(dateText);
            console.log("Selected date:", formattedDate);

            $.ajax({
            url: 'get_details_last.php',
            type: 'POST',
            data: formValues,
            dataType: 'html', 
            success: function(data) {
                $('#bookings').html(data);
            }
            });
        });
    });
</script>
<?php } else { ?>
alert
<?php }
?>
