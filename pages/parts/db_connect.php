<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'floral_shop';

# data source name

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

// 3取不到資料時報錯的寫法

$pdo_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];


try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
    // $stmt = $pdo->query("SELECT * FROM custom_orders LIMIT 2");

    // echo json_encode($stmt->fetchAll());
} catch (PDOException $ex) {   //有pdo的錯誤才會進入catch
    // echo $ex->getMessage();
}


#啟動 session 的功能
if (!isset($_SESSION)) {
    session_start();
}

