<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection using PDO
$host = 'localhost';
$db   = 'samity_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch data from the setup table and store it in the session
    $stmt = $pdo->query("SELECT * FROM setup");
    $setupData = $stmt->fetchAll();

    // Store setup data in the session
    $_SESSION['setup'] = [];
    foreach ($setupData as $row) {
        // Ensure both 'key' and 'value' columns exist
        if (isset($row['key']) && isset($row['value'])) {
            $_SESSION['setup'][$row['key']] = $row['value'];
        }
    }

    // Uncomment the line below for debugging purposes
    // echo "<div style='margin:20px auto;max-width:400px;padding:20px;background:#e6ffe6;border:1px solid #b2ffb2;border-radius:8px;text-align:center;font-family:sans-serif;color:#2d662d;'>Database connection successful and setup data loaded!</div>";
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
