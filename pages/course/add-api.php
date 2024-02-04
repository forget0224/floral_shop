<?php
require '../parts/db_connect.php';

$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST,
  "errors" => [],
];

// 先查詢 store_name 對應的 store_id
$storeNameQuery = "SELECT store_id FROM store WHERE store_name = ?";
$storeStmt = $pdo->prepare($storeNameQuery);
$storeStmt->execute([$_POST['store_name']]);
$storeRow = $storeStmt->fetch();

if (!$storeRow) {
  $output['error'] = '無法找到對應的商家';
} else {
  // 使用查詢到的 store_id 進行 INSERT
  $sql = "INSERT INTO `course`(`name`, `category_id`, `intro`, `store_id`, `location`, `price`, `min_capacity`, `max_capacity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);

  try {
    $stmt->execute([
      $_POST['name'],
      $_POST['category_id'],
      $_POST['intro'],
      $storeRow['store_id'], // 使用查詢到的 store_id
      $_POST['location'],
      $_POST['price'],
      $_POST['min_capacity'],
      $_POST['max_capacity']
    ]);

    $output['success'] = boolval($stmt->rowCount());
    $output['lastInsertId'] = $pdo->lastInsertId();  // 取得最新建立資料的 PK
  } catch(PDOException $e) {
    $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
  }
}

header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>