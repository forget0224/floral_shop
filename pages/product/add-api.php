<?php
// require '../parts/admin-required.php';
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



// 有寫$output的定義判斷，就不需要if判斷式
//header()函式用於設置HTTP響應的各種標頭，用於發送標頭資訊給客戶端的瀏覽器
// header('Content-Type: application/json');
// 檢查是否有收到資料
// if(!empty($_POST)){
  // 有收到資料，以JSON格式將資料回傳給用戶端
  // JSON_UNESCAPED_UNICODE用來避免轉譯成UNICODE
  // echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
// } else {
  //如果沒有收到資料就回傳空陣列
  // echo json_encode([]);
// }