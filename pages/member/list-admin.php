<?php

require '../parts/db_connect.php';
$pageName = 'list';
$title = '列表';

$perPage = 20;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    // redirect
    header('Location: ?page=1');
    exit;
}


$t_sql = "SELECT COUNT(1) FROM member";
// $t_stmt = $pdo->query($t_sql);
// $row = $t_stmt->fetch(PDO::FETCH_NUM);

$row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);

// print_r($row); exit;  # 直接離開程式
$totalRows = $row[0]; # 取得總筆數
$totalPages = 0; # 預設值
$rows = []; # 預設值
if ($totalRows > 0) {
    $totalPages = ceil($totalRows / $perPage); # 計算總頁數

    if ($page > $totalPages) {
        // redirect
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf("SELECT * FROM member ORDER BY member_id ASC
    LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
}




?>
<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>


                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-trash"></i></th>
                        <th>#</th>
                        <th>姓名</th>
                        <th>電郵</th>
                        <th>手機</th>
                        <th>城市</th>
                        <th>地址</th>
                        <th><i class="fas fa-file-pen"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_one(<?= $r['member_id'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $r['member_id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['phone'] ?></td>
                            <td><?= $r['city'] ?></td>

                            <td><?= htmlentities($r['address']) ?></td>
                            <!--
                            <td><?= strip_tags($r['address']) ?></td>
                            -->
                            <td><a href="edit.php?member_id=<?= $r['member_id'] ?>">
                                    <i class="fas fa-file-pen"></i>
                                </a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
    function delete_one(sid) {
        if (confirm(`是否要刪除編號為 ${member_id} 的資料?`)) {
            location.href = `delete.php?member_id=${sid}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>