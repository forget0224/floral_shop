<?php
require '../parts/db_connect.php';
header('Content-Type: application/json');

$output = [
    "success" => false,
    "error" => false,
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';

if (empty($order_id)) {
    $output['error'] = '沒有資料編號';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$order_date = empty($_POST['order_date']) ? null : $_POST['order_date'];
$order_date = strtotime($order_date);
if ($order_date === false) {
    $order_date = null;
} else {
    $order_date = date('Y-m-d', $order_date);
}

$delivery_date = empty($_POST['delivery_date']) ? null : $_POST['delivery_date'];
$delivery_date = strtotime($delivery_date);
if ($delivery_date === false) {
    $delivery_date = null;
} else {
    $delivery_date = date('Y-m-d H:i:s', $delivery_date);
}

$sql = "UPDATE `custom_orders` SET 
  `order_date`=?,
  `delivery_date`=?,
  `member_id`=?,
  `store_id`=?,
  `recipient_address`=?,
  `payment_method`=? 
  WHERE `order_id`=?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $order_date,
        $delivery_date,
        $_POST['member_id'],
        $_POST['store_id'],
        $_POST['recipient_address'],
        $_POST['payment_method'],
        $order_id
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
}
$output['success'] = ($stmt->rowCount() > 0);
$output['error'] = ($stmt->rowCount() === 0);


echo json_encode($output, JSON_UNESCAPED_UNICODE);
