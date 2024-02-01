<?php
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

$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
if(empty($course_id)){
  $output['error'] = '沒有資料編號';
  $output['code'] = 401;
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

$sql = "UPDATE `course` SET 
  `name`=?,
  `intro`=?,
  `location`=?,
  `price`=?,
  `min_capacity`=?,
  `max_capacity`=?
  WHERE course_id=? ";

$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    $_POST['name'],
    $_POST['intro'],
    $_POST['location'],
    $_POST['price'],
    $_POST['min_capacity'],
    $_POST['max_capacity'],
    $course_id
  ]);
} catch(PDOException $e) {
  $output['error'] = 'SQL有東西出錯了'. $e->getMessage();
}

// $stmt->rowCount(); # 資料變更了幾筆
$output['success'] = boolval($stmt->rowCount());

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>