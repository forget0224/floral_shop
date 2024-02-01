<?php require '../parts/db_connect.php';
$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];






$delivery_date = empty($_POST['delivery_date']) ? null : $_POST['delivery_date'];
$delivery_date = strtotime($delivery_date);
if ($delivery_date === false) {
    $delivery_date = null;
} else {
    $delivery_date = date('Y-m-d', $delivery_date);
}



$order_date = empty($_POST['order_date']) ? null : $_POST['order_date'];
$order_date = strtotime($order_date);
if ($order_date === false) {
    $order_date = null;
} else {
    $order_date = date('Y-m-d H:i:s', $order_date);
}







$sql = "INSERT INTO `custom_orders`(`order_id`, `order_date`, `delivery_date`,`member_id`, `store_id`, `recipient_address`, `payment_method`) VALUES (?, ?, ?, ?, ?, ?,? )";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([
        $_POST['order_id'],
        $order_date,
        $delivery_date,
        $_POST['member_id'],
        $_POST['store_id'],
        $_POST['recipient_address'],
        $_POST['payment_method']
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL出錯了' . $e->getMessage();
}




$output['success'] = boolval($stmt->rowCount());
header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);