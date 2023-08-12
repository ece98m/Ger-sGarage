<?php

$host = '127.0.0.1';
$dbname = 'gersgarage';
$username = 'root';
$password = 'root';

$sqlFilePath = 'gersgarage.sql';


if (!file_exists($sqlFilePath)) {
    echo "Error: SQL file not found.";
    exit;
}

$sqlQueries = file_get_contents($sqlFilePath);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queries = explode(';', $sqlQueries);

    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            $stmt = $pdo->prepare($query);
            $stmt->execute();
        }
    }

    $pdo = null;
    echo "Migration successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
