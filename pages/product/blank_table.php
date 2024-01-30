<?php require '../parts/db_connect.php';
$pageName = '頁面名';
$title = '頁面標題';
// 你該頁面前面的那些東東

// 確認是否已刪除成功
// Check if the deleteSuccess session variable is set
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
// Clear the session variable
unset($_SESSION['deleteSuccess']);

// 搜尋功能
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

//
$pageName = 'list';
$title = '列表';
$perPage = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  // redirect
  header('Location: ?page=1');
  exit;
}
$t_sql = "SELECT COUNT(1) FROM product";
$row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
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

  // 透過inner join將product表格和categories表格連接起來
  $sql = sprintf(
    "SELECT p.*, c.name AS category_name FROM product p
    INNER JOIN categories c ON p.categories_id = c.categories_id
    ORDER BY p.product_id DESC
    LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
  );

  // 資料庫的查詢結果
  $stmt = $pdo->query($sql);
  // 從資料庫的查詢結果中擷取所有的資料列
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
          <h1 class="h3 mb-2 text-gray-800">商品列表</h1>
          <p class="mb-4">
            商品列表 <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <!-- 第一頁 -->
                    <li class="page-item">
                      <a class="page-link" href="?page=1">
                        <i class="fa-solid fa-angles-left"></i>
                      </a>
                    </li>
                    <!-- 上一頁 -->
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= ($page - 1 > 0) ? ($page - 1) : 1 ?>">
                        <i class="fa-solid fa-angle-left"></i>
                      </a>
                    </li>
                    <!-- 中間頁數 -->
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                      if ($i >= 1 and $i <= $totalPages) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif;
                    endfor; ?>
                    <!-- 下一頁 -->
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= ($page + 1 <= $totalPages) ? ($page + 1) : $totalPages ?>">
                        <i class="fa-solid fa-angle-right"></i>
                      </a>
                    </li>
                    <!-- 最後一頁 -->
                    <li class="page-item">
                      <a class="page-link" href="?page= <?= $totalPages ?>">
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
                  <thead>
                    <tr>
                      <th><i class="fa-solid fa-trash"></i></th>
                      <th>#</th>
                      <th>商品名稱</th>
                      <th>種類列表</th>
                      <th>價格</th>
                      <th>尺寸</th>
                      <th>創建時間</th>
                      <th>更新時間</th>
                      <th>描述</th>
                      <th><i class="fa-solid fa-file-pen"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $r) : ?>
                      <tr>
                        <td>
                          <a href="javascript: delete_one(<?= $r['product_id'] ?>)">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </td>
                        <td><?= $r['product_id'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['category_name'] ?></td>
                        <td><?= $r['price'] ?></td>
                        <td><?= $r['size'] ?></td>
                        <td><?= $r['created_at'] ?></td>
                        <td><?= $r['updated_at'] ?></td>
                        <td><?= $r['description'] ?></td>
                        <td><a href="edit.php?product_id=<?= $r['product_id'] ?>">
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