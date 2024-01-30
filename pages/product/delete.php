<?php require '../parts/db_connect.php';

$product_id = isset($_GET["product_id"]) ? intval($_GET["product_id"]) : 0;

$sql = "DELETE FROM product WHERE product_id=$product_id";

$pdo->query($sql);

// Set the session variable indicating successful deletion
$_SESSION['deleteSuccess'] = true;

$goto = empty($_SERVER["HTTP_REFERER"]) ? "list.php" : $_SERVER["HTTP_REFERER"];

header('Location: ' . $goto);