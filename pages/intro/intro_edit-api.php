<?php require '../parts/db_connect.php';


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

$flower_id = isset($_POST['flower_id']) ? intval($_POST['flower_id']) : 0;
if(empty($flower_id)){
  $output['error'] = '沒有資料編號';
  $output['code'] = 401;
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

# 如果沒有值就設定為空值 null
// $birthday = empty($_POST['birthday']) ? null : $_POST['birthday'];
// $birthday = strtotime($birthday); # 轉換為 timestamp
// if($birthday===false){
//   $birthday = null;
// } else {
//   $birthday = date('Y-m-d', $birthday);
// }

$sql = "UPDATE `intro_flower` SET 
  `flower_name`=?,
  `flower_engname`=?,
  `flower_lang`=?,
  `flower_intro`=?
  WHERE flower_id=? ";

$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    $_POST['flower_name'],
    $_POST['flower_engname'],
    $_POST['flower_lang'],
    $_POST['flower_intro'],
    $flower_id
  ]);
} catch(PDOException $e) {
  $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
}

// $stmt->rowCount(); # 資料變更了幾筆
$output['success'] = boolval($stmt->rowCount());


echo json_encode($output, JSON_UNESCAPED_UNICODE);
