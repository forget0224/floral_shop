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
$logMessages = [];
$fieldTranslations = [
    'products_url' => '商品連結',
    'product_color' => '商品顏色',
    'product_price' => '商品價格',
    'product_stock' => '商品庫存',
    'sid' => '商品編號',
    'store_id' => '店家名稱',
    'product_id' => '商品名稱'
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

                updateDataInDatabase($newData, $fieldTranslations);
            }
        }
    }


    foreach ($sidsFromFrontend as $sidFromFrontend) {
        if (!isSidInDatabase($sidFromFrontend, $allDataFromDatabase)) {
            $newData = getNewDataBySid($formData, $sidFromFrontend);
            if (!empty($newData)) {
                insertDataIntoDatabase($newData, $fieldTranslations);
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
                deleteDataFromDatabase($originalData, $fieldTranslations);

            }
        }
    }


    error_log('Delete List: ' . print_r($deleteList, true));
    $output['logMessages'] = $logMessages;
    $output['deleteList'] = $deleteList;
    $output['success'] = true;
    $output['message'] = '已更新';
} catch (PDOException $e) {
    $output['error'] = 'SQL 有錯誤' . $e->getMessage();
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



function updateDataInDatabase($data, $fieldTranslations)
{
    global $pdo, $logMessages;

    $originalData = getOriginalDataBySid($data['sid'], fetchAllDataFromDatabase());


    $changedFields = array_diff_assoc($data, $originalData);

    if (!empty($changedFields) && isset($changedFields['sid'])) {

        unset($changedFields['sid']);
    }

    if (!empty($changedFields)) {

        $sql = "UPDATE `custom_product_list` SET ";
        $updates = [];

        foreach ($changedFields as $key => $value) {
            $updates[] = "`$key`=?";
        }

        $sql .= implode(', ', $updates);
        $sql .= " WHERE `sid`=?";

        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute(array_merge(array_values($changedFields), [$data['sid']]));

            $logMessage = "更新: ";
            foreach ($changedFields as $key => $value) {
                $logMessage .= "{$fieldTranslations[$key]}: {$originalData[$key]} -> $value, ";
            }
            $logMessages[] = rtrim($logMessage, ', ');
        } catch (PDOException $e) {
            error_log('SQL 更新有錯' . $e->getMessage());
        }
    }
}



function insertDataIntoDatabase($data, $fieldTranslations)
{
    global $pdo, $logMessages;

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

        $logMessage = "新增: ";
        foreach ($data as $key => $value) {
            if (isset($fieldTranslations[$key])) {
                $logMessage .= "{$fieldTranslations[$key]}: $value, ";
            }
        }
        $logMessages[] = rtrim($logMessage, ', ');

    } catch (PDOException $e) {
        error_log('SQL INSERT有錯' . $e->getMessage());
    }
}




// function deleteDataFromDatabase($sid, $store_id, $product_id, $fieldTranslations)
// {
//     global $pdo, $logMessages;
//     $sql = "DELETE FROM custom_product_list WHERE sid=? AND store_id=?";

//     $stmt = $pdo->prepare($sql);

//     try {
//         $stmt->execute([$sid, $store_id]);


//         $logMessages[] = "刪除資料庫: sid=$deleteSid, store_id=$deleteStoreId, product_id=$deleteProductId";
//     } catch (PDOException $e) {

//         error_log('SQL 删除出错了' . $e->getMessage());
//     }
// }
function deleteDataFromDatabase($data, $fieldTranslations)
{
    global $pdo, $logMessages;
    $sql = "DELETE FROM custom_product_list WHERE sid=? AND store_id=?";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $data['sid'],
            $data['store_id']
        ]);



        $logMessage = "刪除: ";
        foreach ($data as $key => $value) {
            if (isset($fieldTranslations[$key])) {
                $logMessage .= "{$fieldTranslations[$key]}: $value, ";
            }
        }
        $logMessages[] = rtrim($logMessage, ', ');

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