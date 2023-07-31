<?php
include '../userpages/connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['date'])) {
    $selectedDate = $_POST['date'];
    $dates = [];
    for ($i = 0; $i < 6; $i++) {
        $dates[] = date('Y-m-d', strtotime($selectedDate. ' + '.$i.' days'));
    }

    $mechanicNames = [];
    foreach ($dates as $date) {
        $sql = "SELECT id_mechanics FROM bookings WHERE booking_date = '$date'";
        $result = mysqli_query($mysqli, $sql);
        $mechanicNamesForTheDay = [];
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $mechanicId = $row["id_mechanics"];
                $nameSql = "SELECT firstname, surname FROM mechanics WHERE id_mechanics = '$mechanicId'";
                $nameResult = mysqli_query($mysqli, $nameSql);
                if (mysqli_num_rows($nameResult) > 0) {
                    while($nameRow = mysqli_fetch_assoc($nameResult)) {
                        $mechanicNamesForTheDay[] = $nameRow["firstname"] . ' ' . $nameRow["surname"];
                    }
                }
            }
        }
        $mechanicNames[$date] = $mechanicNamesForTheDay;
    }

    echo '<table>';
    foreach ($mechanicNames as $date => $names) {
        echo '<tr>';
        echo '<td>'.$date.'</td>';
        foreach ($names as $name) {
            echo '<td>'.$name.'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
