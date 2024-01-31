<?php
require '../parts/db_connect.php';

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

$sql = "DELETE FROM course WHERE course_id=$course_id";

$result = $pdo->query($sql);

if ($result) {
    // 在成功刪除後，設定一個標誌或返回一個成功的 JSON 響應
    echo json_encode(['success' => true]);
    exit();
}

// 如果刪除失敗，可以返回一個失敗的 JSON 響應
echo json_encode(['success' => false]);
exit();
?>