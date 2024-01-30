<?php
require '../parts/admin-required.php';
require '../parts/db_connect.php';

$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST, //將接收到的表單資料作為json回應
  "errors" => [],
];

//將資料插入資料表中
$sql = "INSERT INTO `product`(`name`, `categories_id`, `price`, `size`, `created_at`, `updated_at`, `description`) VALUES (?, ?, ?, ?, NOW(), ?, ?)";

$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    $_POST['name'],
    $_POST['categories_id'],
    $_POST['price'],
    $_POST['size'],
    $_POST['created_at'],
    $_POST['description'],
  ]);
} catch (PDOException $e) {
  $output['error'] = 'SQL有出錯' . $e->getMessage();
}

$output['success'] = boolval($stmt->rowCount());
$output['lastInsertId'] = $pdo->lastInsertId();

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
