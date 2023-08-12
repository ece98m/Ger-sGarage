<?php

$host = 'localhost';
$dbname = 'gersgarage';
$username = 'root';
$password = '';
$socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock'; // Update this with the correct MySQL socket path

$sqlFilePath = 'gersgarage.sql';

$conn = mysqli_connect($host, $username, $password, $dbname, null, $socket);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!";
mysqli_close($conn);

if (!file_exists($sqlFilePath)) {
    echo "Error: SQL file not found.";
    exit;
}

$sqlQueries = file_get_contents($sqlFilePath);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;unix_socket=$socket", $username, $password);
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
