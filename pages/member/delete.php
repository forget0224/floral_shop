<?php
require '../parts/db_connect.php';

$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : 0;

$sql = "DELETE FROM member WHERE member_id=$member_id ";

$pdo->query($sql);

# $_SERVER['HTTP_REFERER'] # 人從哪裡來

$goto = empty($_SERVER['HTTP_REFERER']) ? 'list.php' : $_SERVER['HTTP_REFERER'];

header('Location: '. $goto);


