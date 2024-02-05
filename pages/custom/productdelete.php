<?php require '../parts/db_connect.php';

$sid = isset($_GET["sid"]) ? intval($_GET["sid"]) : 0;


$sql = "DELETE FROM custom_product_list WHERE sid=$sid";

$pdo->query($sql);

$goto = empty($_SERVER["HTTP_REFERER"]) ? "product_list.php" : $_SERVER["HTTP_REFERER"];

header('Location: ' . $goto);