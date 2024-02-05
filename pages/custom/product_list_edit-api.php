<?php
require '../parts/db_connect.php';

header('Content-Type: application/json');

$output = [
    "success" => false,
    "error" => false,
    "code" => 0,
    "postData" => $_POST,
    "errors" => [],
];

try {

    $formData = $_POST;

    $sidsFromFrontend = $formData['sid'];
    $deleteList = isset($formData['deleteList']) ? $formData['deleteList'] : [];
    $allDataFromDatabase = fetchAllDataFromDatabase();



    foreach ($allDataFromDatabase as $originalData) {

        $sidFromDatabase = $originalData['sid'];


        if (in_array($sidFromDatabase, $sidsFromFrontend)) {

            $newData = getNewDataBySid($formData, $sidFromDatabase);

            if (!empty($newData)) {

                updateDataInDatabase($newData);
            }
        }
    }


    foreach ($sidsFromFrontend as $sidFromFrontend) {
        if (!isSidInDatabase($sidFromFrontend, $allDataFromDatabase)) {
            $newData = getNewDataBySid($formData, $sidFromFrontend);
            if (!empty($newData)) {
                insertDataIntoDatabase($newData);
            }
        }
    }

    foreach ($deleteList as $deleteSid) {

        if (isSidInDatabase($deleteSid, $allDataFromDatabase)) {

            $originalData = getOriginalDataBySid($deleteSid, $allDataFromDatabase);


            if (!empty($originalData)) {
                $deleteSid = $originalData['sid'];
                $deleteStoreId = $originalData['store_id'];
                $deleteProductId = $originalData['product_id'];
                deleteDataFromDatabase($deleteSid, $deleteStoreId, $deleteProductId);
            }
        }
    }

    error_log('Delete List: ' . print_r($deleteList, true));

    $output['deleteList'] = $deleteList;
    $output['success'] = true;
    $output['message'] = '数据已更新';
} catch (PDOException $e) {
    $output['error'] = 'SQL 有错误' . $e->getMessage();
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);


function fetchAllDataFromDatabase()
{
    global $pdo;

    $sql = "SELECT * FROM `custom_product_list`";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNewDataBySid($formData, $sid)
{
    $newData = [];

    foreach ($formData['sid'] as $index => $formDataSid) {

        if ($formDataSid == $sid) {
            $newData = [
                'product_id' => $formData['product_id'][$index],
                'products_url' => $formData['products_url'][$index],
                'store_id' => $formData['store_id'][$index],
                'product_color' => $formData['product_color'][$index],
                'product_price' => $formData['product_price'][$index],
                'product_stock' => $formData['product_stock'][$index],
                'sid' => $formData['sid'][$index],
            ];

            break;
        }
    }

    return $newData;
}

function updateDataInDatabase($data)
{
    global $pdo;

    $sql = "UPDATE `custom_product_list` SET 
        `products_url`=?,
        `store_id`=?,
        `product_color`=?,
        `product_price`=?,
        `product_stock`=? 
        WHERE `sid`=?";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $data['products_url'],
            $data['store_id'],
            $data['product_color'],
            $data['product_price'],
            $data['product_stock'],
            $data['sid']
        ]);


        error_log("Updated data in database: " . print_r($data, true));
    } catch (PDOException $e) {

        error_log('SQL 更新出错了' . $e->getMessage());
    }
}
function insertDataIntoDatabase($data)
{
    global $pdo;

    $sql = "INSERT INTO `custom_product_list` 
        (`product_id`, `products_url`, `store_id`, `product_color`, `product_stock`, `product_price`) 
        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $data['product_id'],
            $data['products_url'],
            $data['store_id'],
            $data['product_color'],
            $data['product_stock'],
            $data['product_price']
        ]);


        error_log("Inserted data into database: " . print_r($data, true));
    } catch (PDOException $e) {

        error_log('SQL 插入有东西出错了' . $e->getMessage());
    }
}

function deleteDataFromDatabase($sid, $store_id)
{
    global $pdo;
    $sql = "DELETE FROM custom_product_list WHERE sid=? AND store_id=?";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$sid, $store_id]);


        error_log("Deleted data from database with sid=$sid and store_id=$store_id");
    } catch (PDOException $e) {

        error_log('SQL 删除出错了' . $e->getMessage());
    }
}



function isSidInDatabase($sid, $allDataFromDatabase)
{

    foreach ($allDataFromDatabase as $data) {
        if ($data['sid'] == $sid) {
            return true;
        }
    }

    return false;
}

function getOriginalDataBySid($sid, $allDataFromDatabase)
{
    foreach ($allDataFromDatabase as $originalData) {
        if ($originalData['sid'] == $sid) {
            return $originalData;
        }
    }

    return null;
}
?>