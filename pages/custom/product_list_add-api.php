<?php
require '../parts/db_connect.php';

$output = [
    "success" => false,
    "error" => "",
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

try {
    $product_ids = $_POST['product_id'];
    $products_urls = $_POST['products_url'];
    $store_ids = $_POST['store_id'];
    $product_colors = $_POST['product_color'];
    $product_prices = $_POST['product_price'];
    $product_stocks = $_POST['product_stock'];

    // 假設所有陣列的長度相同，以其中一個陣列的長度為基準
    $dataCount = count($product_ids);

    // 遍歷資料並插入資料庫
    for ($i = 0; $i < $dataCount; $i++) {
        $product_id = $product_ids[$i];
        $products_url = $products_urls[$i];
        $store_id = $store_ids[$i];
        $product_color = $product_colors[$i];
        $product_price = $product_prices[$i];
        $product_stock = $product_stocks[$i];

        $sql = "INSERT INTO `custom_product_list` (`product_id`, `products_url`, `store_id`, `product_color`, `product_stock`, `product_price`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_id, $products_url, $store_id, $product_color, $product_stock, $product_price]);
    }

    $output['success'] = true;
} catch (PDOException $e) {
    $output['error'] = 'SQL出错了' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>