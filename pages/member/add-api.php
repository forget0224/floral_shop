<?php
// require __DIR__ . '/admin-required.php';
require '../parts/db_connect.php';



$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];



// TODO: 資料輸入之前, 要做檢查
# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)

/* # 會有 SQL injection 的問題
$sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES (
  '{$_POST['name']}',
  '{$_POST['email']}',
  '{$_POST['mobile']}',
  '{$_POST['birthday']}',
  '{$_POST['address']}',
  NOW() )";

$stmt = $pdo->query($sql);
*/


$sql = "INSERT INTO `member`(`name`, `email`, `phone`, `city`, `district`, `address`) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['city'],
        $_POST['district'],
        $_POST['address'],
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
}

// $stmt->rowCount(); # 新增幾筆
$output['success'] = boolval($stmt->rowCount());
$output['lastInsertId'] = $pdo->lastInsertId();  // 取得最新建立資料的 PK

header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);
