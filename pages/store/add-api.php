<?php
// 登入有權限才能使用增加頁面
// require __DIR__ . '/admin-required.php';
require '../parts/db_connect.php';

// 回應給前端的訊息變數格式
$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

// 在資料庫設定那邊要改允許 null
# 如果沒有值就設定為空值 null
# strtotime()   回傳 int|false
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
// ? 跳脫字元
$sql = "INSERT INTO `store`(`store_name`, `store_account`,`store_password`,`store_tel`,`store_email`,  `store_address`,`sub_id`, `sub_date`) VALUES (?, ?, ?, ?, ?, ?, ? ,?)";

// prepare()還未執行
// php語法 $ar1->store_name ，相當於 js 的 ar1.store_name 
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
        $_POST['store_address'],
        $_POST['sub_id'],
        $sub_date
        
    ]);
} catch (PDOException $e) {
    $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
}



// $stmt->rowCount(); # 新增幾筆
// $output['success'] 表示資料是否成功插入到資料庫中，並作為回應給前端的一個指示。

// 檢查執行 SQL 語句後影響的行數來判斷的，插入成功，$stmt->rowCount()將返回正整數，失敗則為0     
// boolval(1) true
// boolval(0) false
$output['success'] = boolval($stmt->rowCount());
$output['lastInsertId'] = $pdo->lastInsertId();  // 取得最新建立資料的 PK


header('Content-Type: application/json');

echo json_encode($output, JSON_UNESCAPED_UNICODE);



// if (!empty($_POST)) {
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
// } else {
//     echo json_encode([]);
// }


// json_encode();   陣列轉換成json格式的指令
// json_decode($json字串, ($assoc));;   json格式轉換回物件或陣列的指令














//會有 SQL injection 的問題
/* 
$sql = "INSERT INTO `store`(`store_name`, `store_account`, `store_tel`, `sub_date`, `store_address`, `created_at`) VALUES (
    '{$_POST['store_name']}',
    '{$_POST['store_account']}',
    '{$_POST['store_tel']}',
    '{$_POST['sub_date']}',
    '{$_POST['store_address']}',
    NOW() )";

$stmt = $pdo->query($sql);
*/