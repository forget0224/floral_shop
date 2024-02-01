<?php
// require __DIR__ . '/admin-required.php';
require '../parts/db_connect.php';
header('Content-Type: application/json');

$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

// TODO: 資料輸入之前, 要做檢查
# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)

$member_id = isset($_POST['member_id']) ? intval($_POST['member_id']) : 0;
if (empty($member_id)) {
    $output['error'] = '沒有資料編號';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

# 如果沒有值就設定為空值 null
// $join_date = empty($_POST['join_date']) ? null : $_POST['join_date'];
// $join_date = strtotime($join_date); # 轉換為 timestamp
// if ($join_date === false) {
//     $join_date = null;
// } else {
//     $join_date = date('Y-m-d', $join_date);
// }

$sql = "UPDATE `member` SET 
    `name`=?,
    `email`=?,
    `phone`=?,
    `city`=?,
    `district`=?,
    `address`=?
    WHERE member_id=? ";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['city'],
        $_POST['district'],
        $_POST['address'],
        $member_id
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
}

// $stmt->rowCount(); # 資料變更了幾筆
$output['success'] = boolval($stmt->rowCount());


echo json_encode($output, JSON_UNESCAPED_UNICODE);
