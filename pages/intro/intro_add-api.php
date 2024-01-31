<?php require '../parts/db_connect.php';




// 初始化輸出陣列
$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST,
  "errors" => [],
];

// TODO: 資料輸入之前, 要做檢查
# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)

/* # 會有 SQL injection 的問題
$sql = "INSERT INTO `address_book`(`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES (
  '{$_POST['name']}',
  '{$_POST['email']}',
  '{$_POST['mobile']}',
  '{$_POST['birthday']}',
  '{$_POST['address']}',
  NOW() )";

$stmt = $pdo->query($sql);
*/

# 如果沒有值就設定為空值 null
// $birthday = empty($_POST['birthday']) ? null : $_POST['birthday'];
// $birthday = strtotime($birthday); # 轉換為 timestamp
// if($birthday===false){
//   $birthday = null;
// } else {
//   $birthday = date('Y-m-d', $birthday);
// }

// 準備 SQL 語句，使用參數化查詢以防止 SQL 注入攻擊
$sql = "INSERT INTO `intro_flower`(`flower_name`, `flower_engname`, `flower_lang`, `flower_intro`) VALUES (?, ?, ?, ?)";
// ,  `created_at`
$stmt = $pdo->prepare($sql);

try {
  // 執行參數化查詢
  $stmt->execute([
    $_POST['flower_name'],
    $_POST['flower_engname'],
    $_POST['flower_lang'],
    $_POST['flower_intro'],
  ]);

  // 判斷是否成功插入資料
  if ($stmt->rowCount() > 0) {
    $output['success'] = true;
    $output['lastInsertId'] = $pdo->lastInsertId();
  } else {
    $output['error'] = '無法成功插入資料。';
  }

} catch(PDOException $e) {
  $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
}

// 取得新增資料的筆數和最新建立資料的 PK
$output['success'] = boolval($stmt->rowCount());
$output['lastInsertId'] = $pdo->lastInsertId();

// 設定回應頭為 JSON 格式
header('Content-Type: application/json');

// 輸出 JSON 格式的結果
echo json_encode($output, JSON_UNESCAPED_UNICODE);

// 你該頁面前面的那些東東

