<?php 
require __DIR__ . '/pages/parts/db_connect.php';

header('Content-Type: application/json');

$output = [
    "success" => false,
    "code" => 0,
    "postData" => $_POST,
    "error" => '',
];

if (empty($_POST['store_account']) or empty($_POST['store_password'])) {
    # 欄位資料不足
    $output['code'] = 401;
    $output['error'] = '欄位資料不足';
    echo json_encode($output);
    exit;
}

# 先由帳號找到該筆
$sql = "SELECT * FROM store WHERE store_account=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['store_account']]);
$row = $stmt->fetch();

if (empty($row)) {
    # 帳號是錯的
    $output['code'] = 403;
    $output['error'] = '帳號錯誤';
    echo json_encode($output);
    exit;
}

$output['success'] = password_verify($_POST['store_password'], $row['store_password']);
if ($output['success']) {
    $_SESSION['admin'] = [
        'store_id' => $row['store_id'],
        'store_account' => $row['store_account'],
        'store_name' => $row['store_name'],
    ];
} else {
    # 密碼是錯的
    $output['code'] = 405;
    $output['error'] = '密碼錯誤';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
