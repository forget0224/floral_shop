<?php
require '../parts/db_connect.php';

// 假設你的 session 中存儲了登入的商家 ID
// 根據你的應用邏輯取得商家 ID
$storeId = $_SESSION['admin']['store_id'];

// 查詢商家地址
$sql = "SELECT store_address FROM store WHERE store_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$storeId]);
$storeAddress = $stmt->fetchColumn();

// 將地址返回為 JSON 格式
header('Content-Type: application/json');
echo json_encode(['storeAddress' => $storeAddress]);
?>
