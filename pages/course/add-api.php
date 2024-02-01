<?php
require '../parts/db_connect.php';

$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST,
  "errors" => [],
];

$sql = "INSERT INTO `course`(`name`, `category_id`, `intro`, `store_id`, `location`, `price`, `min_capacity`, `max_capacity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

# 如果沒有值就設定為空值 null
// $category_id = empty($_POST['category_id']) ? null : $_POST['category_id'];

try {
  $stmt->execute([
    $_POST['name'],
    $_POST['category_id'],
    $_POST['intro'],
    $_POST['store_id'],
    $_POST['location'],
    $_POST['price'],
    $_POST['min_capacity'],
    $_POST['max_capacity']
  ]);
} catch(PDOException $e) {
  $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
}

// $stmt->rowCount(); # 新增幾筆
$output['success'] = boolval($stmt->rowCount());
$output['lastInsertId'] = $pdo-> lastInsertId();  // 取得最新建立資料的 PK

header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);