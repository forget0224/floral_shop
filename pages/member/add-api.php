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


// 验证地址是否为空
if (empty($_POST['address'])) {
    $output['error'] = "地址不能为空";
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; // 停止继续执行代码
}



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
