<?php
// require __DIR__ . '/admin-required.php';
require '../parts/db_connect.php';
header('Content-Type: application/json');

// 基本與add-api邏輯相同

// 回應給前端的訊息變數格式
$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

// 確保獲得store_id編號
$store_id = isset($_POST['store_id']) ? intval($_POST['store_id']) : 0;
if (empty($store_id)) {
    $output['error'] = '沒有資料編號';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


# 如果沒有值就設定為空值 null
$sub_date = empty($_POST['sub_date']) ? null : $_POST['sub_date'];
$sub_date = strtotime($sub_date); # 轉換為 timestamp 
if ($sub_date === false) {
    $sub_date = null;
} else {
    // $today = date("Y-m-d H:i:s");  // 2001-03-10 17:16:18 (the MySQL DATETIME format)
    $sub_date = date('Y-m-d', $sub_date);
}



// TODO: 資料輸入之前, 要做檢查
# filter_var('bob@example.com', FILTER_VALIDATE_store_account)
$sql = "UPDATE `store` SET 
    `store_name`=?,
    `store_account`=?,
    `store_password`=?,
    `store_tel`=?,
    `store_email`=?,
    `sub_id`=?,
    `sub_date`=?,
    `store_address`=?
    WHERE store_id=? ";

$stmt = $pdo->prepare($sql);


// 實際上每個變數都要進行資料處理，使用者上傳的資料格式不一定正確
try {
    // 執行sql語法，放入從前端獲得的表單資料
    $stmt->execute([
        $_POST['store_name'],
        $_POST['store_account'],
        $_POST['store_password'],
        $_POST['store_tel'],
        $_POST['store_email'],
        $_POST['sub_id'],
        $sub_date,
        $_POST['store_address'],
        $store_id
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL有東西出錯了' . $e->getMessage();
}

// $stmt->rowCount(); # 資料變更了幾筆
// 資料也可能沒有變更 => rowCount() 會獲得0
// boolval(1) true
// boolval(0) false
$output['success'] = boolval($stmt->rowCount());

echo json_encode($output, JSON_UNESCAPED_UNICODE);

