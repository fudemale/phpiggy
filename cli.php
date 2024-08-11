<?php
include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',

], 'root', '');

$query = "SELECT * FROM products";

$stmt = $db->connection->query($query, PDO::FETCH_ASSOC);

var_dump($stmt->fetchAll(PDO::FETCH_OBJ));


// $driver = 'mysql';

// $config = http_build_query(data: [
//     'host' => 'localhost',
//     'port' => 3306,
//     'dbname' => 'phpiggy'
// ], arg_separator: ';');

// $dsn = "{$driver}:{$config}";
// $username = 'root';
// $password = '';

// try {
//     $db = new PDO($dsn, $username, $password);
// } catch (PDOException $e) {
//     die("Unable to connect to database");
// }