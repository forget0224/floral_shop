<?php
require '../parts/admin-required.php';
require '../parts/db_connect.php';
// require __DIR__ . '/admin-required.php';
// require __DIR__ . "/parts/db_connect.php";

//$output 陣列被用來構建要作為 JSON 格式回應的資料結構
// 一種關聯式陣列。回應給前端的格式
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
// 將pdo內的資料(sql)先準備好
// 為了將資料插入佔位符，一定要先prepare，然後才會到下面的執行

try {
  // 準備好後，執行。執行execute的內容要放陣列
  $stmt->execute([
    $_POST['name'],
    $_POST['categories_id'],
    $_POST['price'],
    $_POST['size'],
    $_POST['created_at'],
    $_POST['description'],
  ]);
  //PDOException是用於代表資料庫例外（exception）的類別
  //catch 的目的是捕獲這個例外，並以某種方式處理它
} catch (PDOException $e) {
  //程式碼將例外的訊息（$e->getMessage()）添加到 $output['error'] 中
  $output['error'] = 'SQL有出錯' . $e->getMessage();
}

// $stmt->rowCount() 新增筆數
$output['success'] = boolval($stmt->rowCount());
// boolval() 是 PHP 的函式，用於將值轉換為布林值。
// 如果有記錄被成功插入，$output['success'] 將是 true；反之 false。

//用於取得最新建立資料的主鍵
// $pdo 是與資料庫建立連線後，使用 PDO 物件所做的操作
$output['lastInsertId'] = $pdo->lastInsertId();

header('Content-Type: application/json');
// json_encode() 函式將 $output 陣列轉換成 JSON 格式的字串。
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