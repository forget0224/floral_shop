<?php
require '../parts/db_connect.php';


// 刪除
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
unset($_SESSION['deleteSuccess']);

$pageName = 'list';
$title = '列表';

$perPage = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$searchField = isset($_GET['search-field']) ? $_GET['search-field'] : '';
$searchQuery = isset($_GET['search-query']) ? $_GET['search-query'] : '';

$allowedFields = ['name', 'email', 'phone', 'city', 'district', 'address'];
if (!in_array($searchField, $allowedFields)) {
    $searchField = 'name'; // 默认搜索字段
}

// 构建基于搜索条件的 SQL 查询
$t_sql = "SELECT COUNT(1) FROM member";
$sql = "SELECT * FROM member";
$where = "";
$params = [];

if ($searchQuery && $searchField) {
    $where = " WHERE $searchField LIKE ?";
    $params[] = "%$searchQuery%";
    $t_sql .= $where;
    $sql .= $where;
}

$sql .= " ORDER BY member_id ASC"; // 添加排序
$sql .= " LIMIT ?, ?"; // 添加分页

// 为计算总行数准备和执行查询
$stmt = $pdo->prepare($t_sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key + 1, $value);
}
$stmt->execute();
$totalRows = $stmt->fetch(PDO::FETCH_NUM)[0];

// 计算总页数
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
}

// 为获取数据准备和执行查询
$stmt = $pdo->prepare($sql);
$paramIndex = 1;
foreach ($params as $value) {
    $stmt->bindValue($paramIndex++, $value);
}
$stmt->bindValue($paramIndex++, ($page - 1) * $perPage, PDO::PARAM_INT);
$stmt->bindValue($paramIndex, $perPage, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll();
?>

<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
<style>
    /* 使用 Flexbox 讓 pagination-container 元素水平置中 */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin-bottom: 20px;  */
    }

    .container {
        margin-top: 15rem;
    }

    .pagination li a {
        margin-right: 5px;
        /* 增加右邊距 */
    }

    .text-lg {
        font-size: 20px;
    }

    .blue-text {
    color: blue;
}

</style>

<div class="container">
    <div class="row table h3">
        <div class="col pagination-container">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- 首頁 -->
                    <li class="page-item">
                        <a class="page-link" href="?page=1&search-field=<?= htmlentities($searchField) ?>&search-query=<?= htmlentities($searchQuery) ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <!-- 上一頁 -->
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= max(1, $page - 1) ?>&search-field=<?= htmlentities($searchField) ?>&search-query=<?= htmlentities($searchQuery) ?>">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>
                    <!-- 分頁數字 -->
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&search-field=<?= htmlentities($searchField) ?>&search-query=<?= htmlentities($searchQuery) ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <!-- 下一頁 -->
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= min($totalPages, $page + 1) ?>&search-field=<?= htmlentities($searchField) ?>&search-query=<?= htmlentities($searchQuery) ?>">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <!-- 末頁 -->
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $totalPages ?>&search-field=<?= htmlentities($searchField) ?>&search-query=<?= htmlentities($searchQuery) ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-5 mx-auto text-center">
            <form action="?" method="get">
                <div class="form-group">
                    <select name="search-field" class="form-control form-control-lg">
                        <option value="" disabled selected>請選擇欄位名稱</option>
                        <option value="name">姓名</option>
                        <option value="email">電郵</option>
                        <option value="phone">手機</option>
                        <option value="city">城市</option>
                        <option value="district">區域</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="search-query"></label>
                    <input type="text" class="form-control form-control-lg" id="search-query" name="search-query" placeholder="請輸入搜尋內容">
                </div>
                <button type="submit" class="btn btn-primary ml-2">搜尋</button>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div id="total-results" class="mb-3 text-lg">
                <p>資料總筆數: <span id="total-count" class="blue-text"><?= $totalRows ?></span> 筆</p>
            </div>
        </div>
    </div>

    <div class="row table h3">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-user-pen"></i></i></th>
                        <th>編號</th>
                        <th>姓名</th>
                        <th>電郵</th>
                        <th>手機</th>
                        <th>城市</th>
                        <th>區域</th>
                        <th>地址</th>
                        <th><i class="fa-solid fa-trash-can"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="edit.php?member_id=<?= $r['member_id'] ?>">
                                    <i class="fa-solid fa-user-pen"></i></i>
                                </a>
                            </td>
                            <td><?= $r['member_id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['city'] ?></td>
                            <td><?= $r['district'] ?></td>
                            <td><?= htmlentities($r['address']) ?></td>
                            <!--
                            <td><?= strip_tags($r['address']) ?></td>
                            -->
                            <td>
                                <a href="javascript: delete_one(<?= $r['member_id'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade <?= $deleteSuccess ? 'show' : '' ?>" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSuccessModalLabel">刪除成功</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-lg">
                    <div class="alert alert-success" role="alert">
                    會員資料已成功刪除
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" href="list.php" data-dismiss="modal">關閉</button> -->
                    <a type="button" class="btn btn-primary" href="list.php">關閉</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
    // 獲取總筆數元素
    var totalCountElement = document.getElementById('total-count');

    // 使用 PHP 變數中的總筆數來設置元素內容
    totalCountElement.textContent = <?= $totalRows ?>;

    function delete_one(member_id) {
        if (confirm(`是否要刪除編號為 ${member_id} 的資料?`)) {
            location.href = `delete.php?member_id=${member_id}`;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var deleteSuccess = <?= $deleteSuccess ? 'true' : 'false' ?>;
        if (deleteSuccess) {
            var modal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
            modal.show();
        }
    });
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>