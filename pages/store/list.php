<?php
require '../parts/db_connect.php';
$pageName = 'store_list';
$title = '店家列表';
// 你該頁面前面的那些東東


// 刪除
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
unset($_SESSION['deleteSuccess']);





// 每一頁20筆資料
$perPage = 10;


// get網址列輸入?page= ，未輸入預設為1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    // redirect
    header('Location: ?page=1');
    exit;
}





// 考量分頁狀況，取得資料總筆數前就必需放入資料篩選
// 取得資料總筆數COUNT(1)
$filterConditionsCount = [];

if (!empty($_GET['filterName'])) {
    $filterConditionsCount[] = "store_name LIKE :filterName";
}

if (!empty($_GET['filterPhone'])) {
    $filterConditionsCount[] = "store_tel LIKE :filterPhone";
}

if (!empty($_GET['filterEmail'])) {
    $filterConditionsCount[] = "store_email LIKE :filterEmail";
}

if (!empty($_GET['filterAddress'])) {
    $filterConditionsCount[] = "store_address LIKE :filterAddress";
}

if (!empty($_GET['filterSubscription'])) {
    $filterConditionsCount[] = "sub_name = :filterSubscription";
}

$t_sql = "SELECT COUNT(1) 
        FROM store
        LEFT JOIN store_sub ON store.sub_id = store_sub.sub_id";

// 將篩選條件加入 SQL 查詢中
if (!empty($filterConditionsCount)) {
    $t_sql .= " WHERE " . implode(' AND ', $filterConditionsCount);
}

// 使用參數化查詢
$stmtCount = $pdo->prepare($t_sql);

// 綁定參數
if (!empty($_GET['filterName'])) {
    $stmtCount->bindValue(':filterName', '%' . $_GET['filterName'] . '%', PDO::PARAM_STR);
}

if (!empty($_GET['filterPhone'])) {
    $stmtCount->bindValue(':filterPhone', '%' . $_GET['filterPhone'] . '%', PDO::PARAM_STR);
}

if (!empty($_GET['filterEmail'])) {
    $stmtCount->bindValue(':filterEmail', '%' . $_GET['filterEmail'] . '%', PDO::PARAM_STR);
}

if (!empty($_GET['filterAddress'])) {
    $stmtCount->bindValue(':filterAddress', '%' . $_GET['filterAddress'] . '%', PDO::PARAM_STR);
}

if (!empty($_GET['filterSubscription'])) {
    $stmtCount->bindValue(':filterSubscription', $_GET['filterSubscription'], PDO::PARAM_STR);
}

// 執行查詢
$stmtCount->execute();

// 取得結果
$rowCount = $stmtCount->fetchColumn();


// print_r($row); exit;  # 直接離程式
$totalRows = $rowCount; # 取得總筆數


// 必須先設預設值，html裡面迴圈需要有讀取資料
$totalPages = 0;
$rows = [];



// 頁面數量
// 第一頁 => 顯示1~20筆資料
// 頁數和顯示資料的關係 => ($page-1)*$perPage
if ($totalRows > 0) {
    $totalPages = ceil($totalRows / $perPage); # 計算總頁數
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    // 篩選功能，判斷是否有篩選條件放入
    // 在原有的 $sql 前添加條件
    $filterConditions = [];

    if (!empty($_GET['filterName'])) {
        $filterConditions[] = "store_name LIKE :filterName";
    }

    if (!empty($_GET['filterPhone'])) {
        $filterConditions[] = "store_tel LIKE :filterPhone";
    }

    if (!empty($_GET['filterEmail'])) {
        $filterConditions[] = "store_email LIKE :filterEmail";
    }

    if (!empty($_GET['filterAddress'])) {
        $filterConditions[] = "store_address LIKE :filterAddress";
    }

    if (!empty($_GET['filterSubscription'])) {
        $filterConditions[] = "sub_name = :filterSubscription";
    }

    // 預設排序順序為 DESC
    $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

    // sql顯示列表資料
    $sql = "SELECT store_id, store_name, store_email, store_tel, store_address, sub_name, sub_date 
        FROM store
        LEFT JOIN store_sub ON store.sub_id = store_sub.sub_id";


    // 將篩選條件加入 SQL 查詢中
    if (!empty($filterConditions)) {
        $sql .= " WHERE " . implode(' AND ', $filterConditions);
    }

    // 加入排序邏輯
    if (isset($_GET['orderBy'])) {
        $orderField = $_GET['orderBy'];
        $orderType = ($order === 'desc') ? 'DESC' : 'ASC';
        $sql .= " ORDER BY store.$orderField $orderType";
    } else {
        // 若未指定排序條件，預設以 store_id DESC 排序
        $sql .= " ORDER BY store.store_id DESC";
    }


    $sql .= " LIMIT :offset, :limit";


    // 使用參數化查詢
    $stmt = $pdo->prepare($sql);

    // 綁定參數
    if (!empty($_GET['filterName'])) {
        $stmt->bindValue(':filterName', '%' . $_GET['filterName'] . '%', PDO::PARAM_STR);
    }

    if (!empty($_GET['filterPhone'])) {
        $stmt->bindValue(':filterPhone', '%' . $_GET['filterPhone'] . '%', PDO::PARAM_STR);
    }

    if (!empty($_GET['filterEmail'])) {
        $stmt->bindValue(':filterEmail', '%' . $_GET['filterEmail'] . '%', PDO::PARAM_STR);
    }

    if (!empty($_GET['filterAddress'])) {
        $stmt->bindValue(':filterAddress', '%' . $_GET['filterAddress'] . '%', PDO::PARAM_STR);
    }

    if (!empty($_GET['filterSubscription'])) {
        $stmt->bindValue(':filterSubscription', $_GET['filterSubscription'], PDO::PARAM_STR);
    }


    // 綁定 LIMIT 參數
    $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);

    // 執行查詢
    $stmt->execute();

    // 取得結果
    $rows = $stmt->fetchAll();
}



// 頁面按鈕

?>

<?php include '../parts/html-head.php' ?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../parts/navbar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../parts/navtop.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">店家列表</h1>
                    <p class="mb-4">
                        "謹記：管理店家列表，如舵手操控著整艘船。確保每次操作都是謹慎的，以維護平台的和諧與穩定。"
                    </p>

                    <!-- 頁面整塊貼上!!!!!! -->
                    <div class="row">

                        <!-- 分頁切換功能 -->
                        <div class="row my-2">
                            <div class="d-flex"> 
                                <!-- bootstrap => navigation -->
                                <nav class="mx-2 " aria-label="Page navigation example">
                                    <?php if ($totalPages > 1) : ?>
                                        <ul class="pagination">
                                            <?php if ($page > 1) : ?>
                                                <!-- 回到最前頁 -->
                                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                    <a class=" page-link" href="?page=1&orderBy=<?= $_GET['orderBy'] ?? 'store_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                        <i class="fa-solid fa-angles-left"></i>
                                                    </a>
                                                </li>
                                                <!-- 上一頁 -->
                                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                                    <a class=" page-link" href="?page=<?= $page - 1 ?>&orderBy=<?= $_GET['orderBy'] ?? 'store_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                        <i class="fa-solid fa-angle-left"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                                                if ($i >= 1 and $i <= $totalPages) : 0
                                            ?>
                                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                        <a class="page-link" href="?page=<?= $i ?>&orderBy=<?= $_GET['orderBy'] ?? 'store_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                            <?= $i ?>
                                                        </a>
                                                    </li>
                                            <?php endif;
                                            endfor; ?>
                                            <?php if ($page < $totalPages) : ?>
                                                <!-- 下一頁 -->
                                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $page + 1 ?>&orderBy=<?= $_GET['orderBy'] ?? 'store_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                        <i class="fa-solid fa-angle-right"></i>
                                                    </a>
                                                </li>
                                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?page=<?= $totalPages ?>&orderBy=<?= $_GET['orderBy'] ?? 'store_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                        <i class="fa-solid fa-angles-right"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php endif; ?>
                                </nav>
                                <p class="mb-4 ms-auto ">
                                    目前搜尋結果：共 <?= $totalRows ?> 筆資料
                                </p>
                            </div>

                        </div>

                        <!-- 篩選功能 -->
                        <form class="d-flex align-items-center" method="get" action="">
                            <div class="form-group mx-1">
                                <label for="filterName">姓名：</label>
                                <input type="text" id="filterName" name="filterName" value="<?= isset($_GET['filterName']) ? htmlentities($_GET['filterName']) : '' ?>">
                            </div>
                            <div class="form-group mx-1">
                                <label for="filterEmail">信箱：</label>
                                <input type="text" id="filterEmail" name="filterEmail" value="<?= isset($_GET['filterEmail']) ? htmlentities($_GET['filterEmail']) : '' ?>">
                            </div>
                            <div class="form-group mx-1">
                                <label for="filterPhone">電話：</label>
                                <input type="text" id="filterPhone" name="filterPhone" value="<?= isset($_GET['filterPhone']) ? htmlentities($_GET['filterPhone']) : '' ?>">
                            </div>
                            <div class="form-group mx-1">
                                <label for="filterAddress">地址：</label>
                                <input type="text" id="filterAddress" name="filterAddress" value="<?= isset($_GET['filterAddress']) ? htmlentities($_GET['filterAddress']) : '' ?>">
                            </div>
                            <div class="form-group mx-1">
                                <label for="filterSubscription">訂閱方案：</label>
                                <select id="filterSubscription" name="filterSubscription">
                                    <option value="" <?= empty($_GET['filterSubscription']) ? 'selected' : '' ?>>請選擇</option>
                                    <option value="1個月" <?= isset($_GET['filterSubscription']) && $_GET['filterSubscription'] === '1個月' ? 'selected' : '' ?>>1個月</option>
                                    <option value="6個月" <?= isset($_GET['filterSubscription']) && $_GET['filterSubscription'] === '6個月' ? 'selected' : '' ?>>6個月</option>
                                    <option value="12個月" <?= isset($_GET['filterSubscription']) && $_GET['filterSubscription'] === '12個月' ? 'selected' : '' ?>>12個月</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mx-3">篩選</button>
                            <input type="hidden" name="orderBy" value="<?= $_GET['orderBy'] ?? 'store_id' ?>">
                            <input type="hidden" name="order" value="<?= $_GET['order'] ?? 'desc' ?>">
                        </form>
                    </div>
                    <div class="row">
                        <!-- 列表顯示 -->
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- 刪除按鈕 -->
                                        <th><i class="fa-solid fa-trash"></i></th>
                                        <th style="width:60px">#
                                            <a href="?page=<?= $page ?>&orderBy=store_id&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'store_id' && isset($_GET['order']) && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'store_id' && $_GET['order'] === 'asc') ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                                            </a>
                                        </th>
                                        <th>姓名</th>
                                        <th>信箱</th>
                                        <th>電話</th>
                                        <th>地址</th>
                                        <th style="width:120px">訂閱方案
                                            <a href="?page=<?= $page ?>&orderBy=sub_id&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'sub_id' && isset($_GET['order']) && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>&filterName=<?= $_GET['filterName'] ?? '' ?>&filterEmail=<?= $_GET['filterEmail'] ?? '' ?>&filterPhone=<?= $_GET['filterPhone'] ?? '' ?>&filterAddress=<?= $_GET['filterAddress'] ?? '' ?>&filterSubscription=<?= $_GET['filterSubscription'] ?? '' ?>">
                                                <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'sub_id' && $_GET['order'] === 'asc') ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                                            </a>
                                        </th>
                                        <th>訂閱日期</th>
                                        <!-- 修改按鈕 -->
                                        <th><i class="fa-solid fa-file-pen"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $r) : ?>
                                        <tr>
                                            <!-- 假連結方式，執行一個 刪除函式 -->
                                            <!-- href="javascript:  -->
                                            <td>
                                                <a href="javascript: delete_one(<?= $r['store_id'] ?>)">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                            <!-- <td>
                                <a href="delete.php?store_id=<?= $r['store_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </td> -->
                                            <td><?= $r['store_id'] ?></td>
                                            <td><?= $r['store_name'] ?></td>
                                            <td><?= $r['store_email'] ?></td>
                                            <td><?= $r['store_tel'] ?></td>
                                            <td><?= htmlentities($r['store_address']) ?></td>
                                            <td><?= $r['sub_name'] ?></td>
                                            <td><?= $r['sub_date'] ?></td>
                                            <td>
                                                <a href="edit.php?store_id=<?= $r['store_id'] ?>"><i class="fa-solid fa-file-pen"></i></a>
                                            </td>

                                            <!-- 避免 XSS 攻擊 -->
                                            <!--<td><?= htmlentities($r['store_address']) ?></td>-->
                                            <!--<td><?= strip_tags($r['store_address']) ?></td>-->
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade <?= $deleteSuccess ? 'show' : '' ?>" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">刪除結果</h1>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-success" role="alert">
                                                商品已成功刪除</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">繼續瀏覽</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../parts/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../parts/scripts.php' ?>


    <script>
        function delete_one(store_id) {
            if (confirm(`是否要刪除編號為 ${store_id} 的資料?`)) {
                location.href = `delete.php?store_id=${store_id}`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var deleteSuccess = <?= $deleteSuccess ? 'true' : 'false' ?>;
            if (deleteSuccess) {
                var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
                modal.show();
            }
        });
    </script>



    <?php include '../parts/html-foot.php' ?>