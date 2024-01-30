<?php require '../parts/db_connect.php';
$pageName = '課程列表';
$title = '課程列表';

$perPage = 10;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  // redirect
  header('Location: ?page=1');
  exit;
}

$t_sql = "SELECT COUNT(1) FROM course";
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

  $sql = sprintf("
    SELECT course.*, store.store_name, store.store_address
    FROM course
    INNER JOIN store ON course.store_id = store.store_id
    ORDER BY course.course_id DESC
    LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $stmt = $pdo->query($sql);
  $rows = $stmt->fetchAll();
}

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
                    <h1 class="h3 mb-2 text-gray-800">課程列表</h1>
                    <p class="mb-4">課程列表<a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <!-- 分頁 start -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= 1 ?>">
                                        <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $page-1 ?>">
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
                                        <a class="page-link" href="?page=<?= $page+1 ?>">
                                        <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $totalPages ?>">
                                        <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </li>
                                    </ul>
                                </nav>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <!-- table裡面的東西 複製近來!!!!!!!!!  -->
                                    <thead>
                                        <tr>
                                            <th><i class="fa-solid fa-trash"></i></th>
                                            <th>#</th>
                                            <th>課程名稱</th>
                                            <th>課程介紹</th>
                                            <th>課程分類</th>
                                            <th>商家名稱</th>
                                            <th>上課地點</th>
                                            <th>課程定價</th>
                                            <th>最小開課人數</th>
                                            <th>最大開課人數</th>
                                            <th><i class="fa-solid fa-file-pen"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rows as $r) : ?>
                                        <tr>
                                        <td>
                                            <a href="javascript: delete_one(<?= $r['course_id'] ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        <td><?= $r['course_id'] ?></td>
                                        <td><?= $r['name'] ?></td>
                                        <td><?= $r['intro'] ?></td>
                                        <td><?= $r['category_id'] ?></td>
                                        <td><?= $r['store_name'] ?></td>
                                        <td><?= $r['location'] ?></td>
                                        <td><?= htmlentities($r['price']) ?></td>
                                        <td><?= $r['min_capacity'] ?></td>
                                        <td><?= $r['max_capacity'] ?></td>

                                        <td><a href="edit.php?course_id=<?= $r['course_id'] ?>">
                                            <i class="fa-solid fa-file-pen"></i>
                                            </a></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
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

    <?php include '../parts/html-foot.php' ?>