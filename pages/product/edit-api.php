<?php
date_default_timezone_set('Asia/Taipei');
// require '../parts/admin-required.php';
require '../parts/db_connect.php';
header('Content-Type: application/json');

$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST,
  "errors" => [],
];

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
if (empty($product_id)) {
  $output['error'] = '沒有資料編號';
  $output['code'] = 401;
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

$sql = "UPDATE `product` SET 
  `name`=?,
  `categories_id`=?,
  `price`=?,
  `size`=?,
  `description`=?,
  `updated_at`=?,
  `created_at`=?  
  WHERE product_id=? ";

$stmt = $pdo->prepare($sql);

try {
  $updateTimestamp = date('Y-m-d H:i:s');
  $stmt->execute([
    $_POST['name'],
    $_POST['categories_id'],
    $_POST['price'],
    $_POST['size'],
    $_POST['description'],
    $updateTimestamp,
    $_POST['created_at'],  
    $product_id
  ]);
} catch (PDOException $e) {
  $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

// $stmt->rowCount(); # 資料變更了幾筆
$output['success'] = boolval($stmt->rowCount());


echo json_encode($output, JSON_UNESCAPED_UNICODE);
