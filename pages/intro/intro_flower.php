<?php require '../parts/db_connect.php';
$pageName = 'list';
$title = '列表';
// 你該頁面前面的那些東東

// 每頁顯示的筆數
$perPage = 20;

// 取得當前頁碼，若不存在則預設為第一頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  // 如果頁碼小於1，重新導向到第一頁
  header('Location: ?page=1');
  exit;
}

// 取得總筆數的 SQL 查詢
$t_sql = "SELECT COUNT(1) FROM intro_flower";
// 取得總筆數
$row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);
$totalRows = $row[0]; // 取得總筆數
$totalPages = 0; // 預設值
$rows = []; // 預設值

// 如果有資料，計算總頁數
if ($totalRows > 0) {
  $totalPages = ceil($totalRows / $perPage);

  // 如果當前頁碼大於總頁數，重新導向到最後一頁
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }

  // 取得當前頁面的資料
  $sql = sprintf("SELECT * FROM intro_flower ORDER BY flower_id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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
                    <h1 class="h3 mb-2 text-gray-800">《花圖鑑》Guide des Fleurs</h1>
                    <p class="mb-4">"我可以為自己獻上花束，比你愛我還更愛我自己。"--麥莉．希拉。</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Je peux m'offrir un bouquet, m'aimant encore plus que tu ne m'aimes.</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <!-- table裡面的東西 複製近來!!!!!!!!!  -->
                                    <div class="row">
    <div class="col">
      <!-- 分頁按鈕 -->
      <nav aria-label="Page navigation example">
        <ul class="pagination">
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
    </div>
  </div>
  <div class="row">
    <div class="col">
      <!-- 資料表格 -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><i class="fa-solid fa-trash"></i></th>
            <th>#</th>
            <th>中文花名</th>
            <th>英文花名</th>
            <th>花語</th>
            <th>簡介</th>
            <th><i class="fa-solid fa-file-pen"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r) : ?>
            <tr>
              <td>
                <!-- 刪除按鈕 -->
                <a href="javascript: delete_one(<?= $r['flower_id'] ?>)">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
              <td><?= $r['flower_id'] ?></td>
              <td><?= $r['flower_name'] ?></td>
              <td><?= $r['flower_engname'] ?></td>
              <td><?= $r['flower_lang'] ?></td>
              <td><?= $r['flower_intro'] ?></td>
              <td>
                <!-- 編輯按鈕 -->
                <a href="edit.php?flower_id=<?= $r['flower_id'] ?>">
                  <i class="fa-solid fa-file-pen"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
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
    <script>
  // 刪除資料的 JavaScript 函數
  function delete_one(flower_id) {
    if (confirm(`是否要刪除編號為 ${flower_id} 的資料?`)) {
      location.href = `intro_delete.php?flower_id=${flower_id}`;
    }
  }
</script>
    <?php include '../parts/html-foot.php' ?>