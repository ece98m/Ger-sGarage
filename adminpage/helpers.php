<!-- helpers.php -->
<?php
function getMechanicsOptions()
{
    require '../userpages/connection.php';

    $sql = "SELECT * FROM mechanics";
    $result = $mysqli->query($sql);

    $options = '';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['id_mechanics'] . '">' . $row['firstname'] . ' ' . $row['surname'] . '</option>';
    }

    return $options;
}
?>
