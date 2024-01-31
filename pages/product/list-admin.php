<?php require '../parts/db_connect.php';

// 刪除
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
unset($_SESSION['deleteSuccess']);

// 搜尋
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$isSearch = !empty($searchKeyword);

$pageName = 'list';
$title = '商品列表';
$perPage = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}
$t_sql = "SELECT COUNT(1) FROM product";
$row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
$totalRows = $row[0];
$totalPages = 0;
$rows = [];
if ($totalRows > 0) {
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }

  // 透過inner join將product表格和categories表格連接起來
  $sql = sprintf(
    "SELECT p.*, c.name AS category_name FROM product p
    INNER JOIN categories c ON p.categories_id = c.categories_id
    %s
    ORDER BY p.product_id DESC
    LIMIT %s, %s",
    $isSearch ? "WHERE p.name LIKE :searchKeyword" : "",
    ($page - 1) * $perPage,
    $perPage
  );

  $stmt = $pdo->prepare($sql);
  if ($isSearch) {
    $searchKeyword = '%' . $searchKeyword . '%';
    $stmt->bindParam(':searchKeyword', $searchKeyword, PDO::PARAM_STR);
  }
  $stmt->execute();
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
              <h6 class="m-0 font-weight-bold text-primary d-flex">
                <!-- 分頁 -->
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
                <!-- 分頁結束 -->
                <!-- 篩選 -->
                <div class="ml-3">
                  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel">篩選商品</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- 篩選搜尋欄位 -->
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchForm" action="">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput" value="">
                            <p class="form-text text-danger" id="searchInputError"></p>
                          </form>

                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-success" type="button" onclick="searchProducts()">Search</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">篩選商品</a>
                </div>
                <!-- 篩選結束 -->
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
            商品已成功刪除
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">繼續瀏覽</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    //搜尋
    function searchProducts() {
      let searchInput = document.getElementById('searchInput');
      let searchKeyword = searchInput.value.trim();
      if (searchKeyword !== '') {
        window.location.href = 'list.php?search=' + encodeURIComponent(searchKeyword);
      } else {
        searchInputError.textContent = '請輸入關鍵字';
      }
    }

    //刪除
    function delete_one(product_id) {
      if (confirm(`是否要刪除編號為 ${product_id} 的資料?`)) {
        location.href = `delete.php?product_id=${product_id}`;
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