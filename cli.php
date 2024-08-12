<?php
include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',

], 'root', '');

$sqlFile = file_get_contents("./database.sql");
// $db->connection->query($sqlFile);
$db->query($sqlFile);

// try {
//     $db->connection->beginTransaction();
//     $db->connection->query("INSERT INTO products VALUES(99,'Gloves')");
//     $search = "Shirts";
//     $query = "SELECT * FROM products WHERE name=:name";
//     // ? char represents the placeholder of the query for prepared statement

//     $stmt = $db->connection->prepare($query);

//     $stmt->bindValue('name', 'Gloves', PDO::PARAM_STR);

//     $stmt->execute();

//     var_dump($stmt->fetchAll(PDO::FETCH_OBJ));

//     $db->connection->commit();
//     // ^ this makes changes and also ends transactions
// } catch (Exception $e) {
//     if ($db->connection->inTransaction()) {
//         $db->connection->rollBack();
//     }

//     echo "Transaction failed";
// }



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