<?php
require '../parts/db_connect.php';

// 資料庫 store_id欄位沒有0的編號 => 不會進行任何操作
$store_id = isset($_GET['store_id']) ? intval($_GET['store_id']) : 0;
$sql = "DELETE FROM store WHERE store_id=$store_id ";
$pdo->query($sql);


// Set the session variable indicating successful deletion
// 獲得刪除session
$_SESSION['deleteSuccess'] = true;




# $_SERVER['HTTP_REFERER'] # 人從哪裡來，回哪裡去
// Headers => Request Headers => Refer:
$goto = empty($_SERVER['HTTP_REFERER']) ? 'list.php' : $_SERVER['HTTP_REFERER'];
header('Location: ' . $goto);
