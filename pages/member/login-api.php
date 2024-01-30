<?php
require '../parts/db_connect.php';

header('Content-Type: application/json');

$output = [
    "success" => false,
    "code" => 0,
    "postData" => $_POST,
    "error" => '',
];

if (empty($_POST['email']) or empty($_POST['password'])) {
    # 欄位資料不足
    $output['code'] = 401;
    echo json_encode($output);
    exit;
}

# 先由帳號找到該筆
$sql = "SELECT * FROM member WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['email']]);
$row = $stmt->fetch();

if (empty($row)) {
    # 帳號是錯的
    $output['code'] = 403;
    echo json_encode($output);
    exit;
}

$output['success'] = password_verify($_POST['password'], $row['password']);
if ($output['success']) {
    $_SESSION['admin'] = [
        'member_id' => $row['member_id'],
        'email' => $row['email'],
        'name' => $row['name'],
    ];
} else {
    # 密碼是錯的
    $output['code'] = 405;
}
// 明碼
// if ($_POST['password'] === $row['password']) {
//     $output['success'] = true;
//     $_SESSION['admin'] = [
//         'member_member_id' => $row['member_member_id'],
//         'email' => $row['email'],
//         'name' => $row['name'],
//     ];
// } else {
    # 密碼是錯的
//     $output['code'] = 405;
// }

echo json_encode($output, JSON_UNESCAPED_UNICODE);
