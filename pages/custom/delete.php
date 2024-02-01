<?php require '../parts/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sids = isset($_GET['sids']) ? $_GET['sids'] : [];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sids = isset($_POST['sids']) ? $_POST['sids'] : [];
} else {
    echo 'Invalid request method';
    exit;
}


$sids = array_map('intval', $sids);

if (!empty($sids)) {
    $idList = implode(',', $sids);
    $sql = "DELETE FROM custom_orders WHERE sid IN ($idList)";
    $pdo->query($sql);
}


$goto = empty($_SERVER['HTTP_REFERER']) ? 'list.php' : $_SERVER['HTTP_REFERER'];
header('Location: ' . $goto);
?>