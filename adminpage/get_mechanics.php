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
        $mechanicIdsForTheDay = [];
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $mechanicIdsForTheDay[] = $row["id_mechanics"];
            }
        }
        $mechanicNames[$date] = $mechanicIdsForTheDay;
    }

    echo '<table>';
    echo '<tr><th>MECHANICS</th>';
    foreach ($dates as $date) {
        echo '<th>'.$date.'</th>';
    }
    echo '</tr>';

    $allMechanics = [];
    foreach ($mechanicNames as $date => $mechanicIds) {
        foreach ($mechanicIds as $mechanicId) {
            $nameSql = "SELECT firstname, surname FROM mechanics WHERE id_mechanics = '$mechanicId'";
            $nameResult = mysqli_query($mysqli, $nameSql);
            if (mysqli_num_rows($nameResult) > 0) {
                while($nameRow = mysqli_fetch_assoc($nameResult)) {
                    $allMechanics[$mechanicId]['name'] = $nameRow["firstname"] . ' ' . $nameRow["surname"];
                    $allMechanics[$mechanicId]['dates'][$date] = 1;
                }
            }
        }
    }

    foreach ($allMechanics as $mechanicId => $mechanicData) {
        echo '<tr>';
        echo '<td>'.$mechanicData['name'].'</td>';
        foreach ($dates as $date) {
            echo '<td>';
            echo isset($mechanicData['dates'][$date]) ? 'X' : '';
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
}
?>
