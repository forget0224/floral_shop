<?php require '../parts/db_connect.php';

$pageName = 'list';
$title = '列表';

$perPage = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$searchCity = isset($_GET['search-city']) ? $_GET['search-city'] : '';

if ($searchCity) {
    $t_sql = "SELECT COUNT(1) FROM member WHERE city LIKE ?";
    $pdo_stmt = $pdo->prepare($t_sql);
    $pdo_stmt->execute(["%$searchCity%"]);
    $totalRows = $pdo_stmt->fetch(PDO::FETCH_NUM)[0];

    if ($totalRows > 0) {
        $totalPages = ceil($totalRows / $perPage);

        if ($page > $totalPages) {
            header('Location: ?page=' . $totalPages);
            exit;
        }

        $sql = sprintf("SELECT * FROM member WHERE city LIKE ? ORDER BY member_id ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["%$searchCity%"]);
        $rows = $stmt->fetchAll();
    }
} else {
    $t_sql = "SELECT COUNT(1) FROM member";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

    if ($totalRows > 0) {
        $totalPages = ceil($totalRows / $perPage);

        if ($page > $totalPages) {
            header('Location: ?page=' . $totalPages);
            exit;
        }

        $sql = sprintf("SELECT * FROM member ORDER BY member_id ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        $stmt = $pdo->query($sql);
        $rows = $stmt->fetchAll();
    }
}





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
        margin-right: 10px; /* 增加右邊距 */
    }
</style>
<div class="container">
    <div class="row table h3">
            <div class="col pagination-container">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <!-- 更新鏈接以包含搜索城市 -->
                        <li class="page-item">
                            <a class="page-link" href="?page=1&search-city=<?= htmlentities($searchCity) ?>">
                            <i class="fa-solid fa-backward"></i></i>
                            </a>
                        </li>

                        <!-- 注意：這裡需要加入對前一頁和後一頁鏈接的處理 -->

                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search-city=<?= htmlentities($searchCity) ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>

                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $totalPages ?>&search-city=<?= htmlentities($searchCity) ?>">
                            <i class="fa-solid fa-forward"></i></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    <div class="row">
        <div class="col">
            <form action="?" method="get" class="d-flex justify-content-center">
                <div class="form-group">
                    <label for="search-city"></label>
                    <input type="text" class="form-control form-control-lg" id="search-city" name="search-city" placeholder="請輸入城市名稱">
                </div>
                <button type="submit" class="btn btn-primary ml-2"><i class="fa-solid fa-magnifying-glass"></i>搜尋</button>
            </form>
        </div>
    </div>



    <div class="row table h3">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                        <th><i class="fa-solid fa-user-pen"></i></i></th>
                        <th>#</th>
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

</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
    function delete_one(member_id) {
        if (confirm(`是否要刪除編號為 ${member_id} 的會員資料?`)) {
            location.href = `delete.php?member_id=${member_id}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>