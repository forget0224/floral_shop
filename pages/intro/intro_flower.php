<?php
require '../parts/db_connect.php';
$pageName = 'list';
$title = '花圖鑑';

// 你該頁面前面的那些東東

// 取得當前頁面的資料，並加入隨機排序（好手氣-1/3）
// 隨機排序資料
$randomSql = "SELECT * FROM intro_flower ORDER BY RAND() LIMIT 1";
$randomStmt = $pdo->query($randomSql);
$randomData = $randomStmt->fetch();

// 取得當前頁面的資料，並加入隨機排序（好手氣-1/3） end
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

  // 獲取排序的方式（升序或降序）
  $order = isset($_GET['order']) ? strtolower($_GET['order']) : 'desc';

  // 搜尋條件
  $searchCondition = '';
  if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $searchCondition = sprintf(
      " WHERE 
      flower_name LIKE '%%%s%%' OR 
      flower_engname LIKE '%%%s%%' OR 
      flower_lang LIKE '%%%s%%' OR 
      flower_intro LIKE '%%%s%%'",
      $search,
      $search,
      $search,
      $search
    );
  }

  // 修改原有的SQL查詢
  $sql = sprintf("SELECT * FROM intro_flower %s ORDER BY flower_id %s LIMIT %s, %s", $searchCondition, $order, ($page - 1) * $perPage, $perPage);
  $stmt = $pdo->query($sql);
  $rows = $stmt->fetchAll();
}

// 刪除
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
unset($_SESSION['deleteSuccess']);
?>

<?php include '../parts/html-head.php' ?>
<style>
  /* 在你的CSS樣式表中添加下面的代碼 */
  th a {
    text-decoration: none;
    /* 避免超連結下劃線 */
    color: #000;
    /* 設置箭頭顏色 */
    margin-left: 5px;
    /* 調整箭頭和文字之間的間距 */
  }

  th a:hover {
    color: #007bff;
    /* 鼠標懸停時的顏色 */
  }
</style>


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
          <div class="row">
            <div class="col-9">
              <h1 class="h3 mb-2 text-gray-800 d-inline-flex"><a href="/floral_shop/pages/intro/intro_flower.php" class="text-decoration-none text-reset">𓇚《花圖鑑》Guide des Fleurs</a></h1>
              <p class="mb-4">"我可以為自己獻上花束，比你愛我還更愛我自己。"--麥莉．希拉。</p>
            </div>
            <div class="col-3">
              <img class="img-fluid float-end w-25" onclick="showRandomDataModal() " src="https://media2.giphy.com/media/iehQ1h40viFAumBqD2/giphy.gif" class="img-fluid" alt="...">
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">"Je peux m'offrir un bouquet, m'aimant encore plus que tu ne m'aimes."-Miley Cyrus</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <!-- table裡面的東西 複製近來!!!!!!!!!  -->
                  <div class="row">
                    <div class="col-6">
                      <!-- 分頁按鈕 -->
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= 1 ?>&order=<?= $order ?>">
                              <i class="fa-solid fa-angles-left"></i>
                            </a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&order=<?= $order ?>">
                              <i class="fa-solid fa-angle-left"></i>
                            </a>
                          </li>

                          <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) : ?>
                              <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                              </li>
                          <?php endif;
                          endfor; ?>

                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&order=<?= $order ?>">
                              <i class="fa-solid fa-angle-right"></i>
                            </a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $totalPages ?>&order=<?= $order ?>">
                              <i class="fa-solid fa-angles-right"></i>
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                    <div class="col-6">
                      <!-- 搜尋欄 start-->
                      <div class="float-end mb-3">
                        <form action="" method="GET" class="form-inline">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="搜尋..." name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="submit">搜尋</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- 搜尋欄 end-->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <!-- 資料表格 -->
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th><i class="fa-solid fa-trash"></i></th>
                            <th>
                              <!-- 降升序箭頭 start -->
                              <a href="?page=<?= $page ?>&order=asc">
                                <i class="fa-solid fa-arrow-up"></i>
                              </a>
                              <a href="?page=<?= $page ?>&order=desc">
                                <i class="fa-solid fa-arrow-down"></i>
                              </a>
                              <!-- 降升序箭頭 end -->
                            </th>
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
                                <a href="/floral_shop/pages/intro/intro_edit.php?flower_id=<?= $r['flower_id'] ?>">
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
  <!-- Modal -->
  <!-- 刪除結果提示的 Modal 元素，使用 Bootstrap 框架的 modal 樣式 -->
  <div class="modal fade <?= $deleteSuccess ? 'show' : '' ?>" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal 對話框的樣式 -->
    <div class="modal-dialog">
      <!-- Modal 內容容器 -->
      <div class="modal-content">
        <!-- Modal 標頭 -->
        <div class="modal-header">
          <!-- Modal 標題 -->
          <h1 class="modal-title fs-5" id="exampleModalLabel">刪除結果</h1>
          <!-- 關閉 Modal 的按鈕 -->
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal 主要內容區域 -->
        <div class="modal-body">
          <!-- 顯示刪除成功的訊息 -->
          <div class="alert alert-success text-center" role="alert">
            已成功刪除花朵資料
          </div>
          <img src="https://media2.giphy.com/media/QA7nawRHAQV8EzGWTZ/giphy.gif" class="img-fluid" alt="...">
        </div>
        <!-- Modal 底部區域 -->
        <div class="modal-footer">
          <!-- 關閉 Modal 並繼續瀏覽的按鈕 -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">回頁面</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade <?= $deleteSuccess ? 'show' : '' ?>" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal 對話框的樣式 -->
    <div class="modal-dialog">
      <!-- Modal 內容容器 -->
      <div class="modal-content">
        <!-- Modal 標頭 -->
        <div class="modal-header">
          <!-- Modal 標題 -->
          <h1 class="modal-title fs-5" id="exampleModalLabel">Le Livre des Réponses</h1>
          <!-- 關閉 Modal 的按鈕 -->
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal 主要內容區域 -->
        <div class="modal-body">
          <!-- 顯示刪除成功的訊息 -->
          <div class="alert alert-warning text-center" role="alert">

            <h2 class="fw-bold"><?= $randomData['flower_name'] ?></h2>
            <h5><?= $randomData['flower_engname'] ?></h5>
            <h5 class="fw-bolder"><?= $randomData['flower_lang'] ?></h5>
            <p><?= $randomData['flower_intro'] ?></p>
          </div>
        </div>
        <!-- Modal 底部區域 -->
        <img src="https://media2.giphy.com/media/iehQ1h40viFAumBqD2/giphy.gif" class="img-fluid w-75 mx-auto" alt="...">
        <div class="modal-footer">
          <!-- 關閉 Modal 並繼續瀏覽的按鈕 -->
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">回頁面</button> -->
          <a type="button" class="btn btn-secondary" href="/floral_shop/pages/intro/intro_flower.php">回頁面</a>
        </div>
      </div>
    </div>
  </div>


  <script>
    // 取得當前頁面的資料，並加入隨機排序（好手氣-3/3)
    // 顯示隨機資料的 JavaScript 函數

    function showRandomDataModal() {
      // 取得 modal 元素
      var modal = new bootstrap.Modal(document.getElementById('exampleModal2'));
      // 顯示 modal
      modal.show();
    }
    // 取得當前頁面的資料，並加入隨機排序（好手氣-3/3)end

    // 刪除資料的 JavaScript 函數
    function delete_one(flower_id) {
      if (confirm(`是否要刪除編號為 ${flower_id} 的資料?`)) {
        location.href = `intro_delete.php?flower_id=${flower_id}`;
      }
    }
    // 等待整個文件內容載入完成後執行的事件
    document.addEventListener('DOMContentLoaded', function() {
      // 從伺服器端 PHP 取得的 deleteSuccess 狀態，轉換為 JavaScript 的布林值
      var deleteSuccess = <?= $deleteSuccess ? 'true' : 'false' ?>;

      // 如果 deleteSuccess 為 true，顯示刪除成功的 modal
      if (deleteSuccess) {
        // 使用 Bootstrap 5 的 Modal 類別來取得 modal 元素
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'));

        // 顯示 modal
        modal.show();
      }
    });
  </script>
  <?php include '../parts/html-foot.php' ?>