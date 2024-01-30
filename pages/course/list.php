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
                    <p class="mb-4">課程列表</p>

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

    <!-- Modal -->
    <div class="modal fade" id="deleteSuccess" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">刪除結果</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-success" role="alert">
            刪除成功
            </div>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續刪除</button>
            <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
        </div> -->
        </div>
    </div>
    </div>

    <script>
    function delete_one(course_id) {
        if (confirm(`是否要刪除編號為 ${course_id} 的資料?`)) {
        // 使用 jQuery 的 AJAX 進行非同步請求
        $.ajax({
            url: `delete.php?course_id=${course_id}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
            console.log(result);
            if (result.success) {
                // 刪除成功後顯示 Modal
                $('#deleteSuccess').modal('show');

                // 刪除成功後，等待一段時間再重新導向
                setTimeout(function() {
                location.href = 'list.php';
                }, 2000); // 這裡的 2000 是等待 2 秒，你可以調整成你需要的時間
            } else {
                // 刪除失敗的處理
                console.error('刪除失敗');
            }
            },
            error: function(xhr, status, error) {
            // 錯誤處理
            console.error('AJAX 錯誤:', status, error);
            }
        });
        }
    }
    </script>
    
    <?php include '../parts/html-foot.php' ?>