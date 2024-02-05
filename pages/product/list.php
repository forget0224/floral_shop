<?php require '../parts/db_connect.php';

// 刪除
$deleteSuccess = isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] === true;
unset($_SESSION['deleteSuccess']);

// 搜尋-商品關鍵字
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$isSearch = !empty($searchKeyword);

// 搜尋-類別
$searchSelectCategory = isset($_GET['searchCategory']) ? $_GET['searchCategory'] : '';
$isSearchCategory = !empty($searchSelectCategory);

// 搜尋-價格
$searchPriceFirst = isset($_GET['searchPriceFirst']) ? $_GET['searchPriceFirst'] : '';
$searchPriceSecond = isset($_GET['searchPriceSecond']) ? $_GET['searchPriceSecond'] : '';
$isSearchPrice = ($searchPriceFirst !== '' && $searchPriceSecond !== '');

// 搜尋-描述
$searchDescription = isset($_GET['searchDescription']) ? $_GET['searchDescription'] : '';
$isSearchDescription = !empty($searchDescription);

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

  $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'product_id';
  $order = isset($_GET['order']) && ($_GET['order'] === 'asc' || $_GET['order'] === 'desc') ? strtoupper($_GET['order']) : 'DESC';

  // 透過inner join將product表格和categories表格連接起來
  $sql = sprintf(
    "SELECT p.*, c.name AS category_name FROM product p
    INNER JOIN categories c ON p.categories_id = c.categories_id
    %s
    %s
    %s
    %s
    ORDER BY %s %s
    LIMIT %s, %s",
    $isSearch ? "WHERE p.name LIKE :searchKeyword" : "", //搜尋-商品關鍵字
    $isSearchCategory ? "AND p.categories_id = :searchCategory" : "", // 搜尋-類別
    ($isSearchPrice && $searchPriceFirst !== '' && $searchPriceSecond !== '') ? "AND p.price BETWEEN :searchPriceFirst AND :searchPriceSecond" : "", // 搜尋-價格
    $isSearchDescription ? "AND p.description LIKE :searchDescription" : "", //搜尋-描述關鍵字
    $orderBy,
    $order,
    ($page - 1) * $perPage,
    $perPage
  );

  $stmt = $pdo->prepare($sql);

  // 搜尋-商品關鍵字
  if ($isSearch) {
    $searchKeyword = '%' . $searchKeyword . '%';
    $stmt->bindParam(':searchKeyword', $searchKeyword, PDO::PARAM_STR);
  }
  // 搜尋-類別
  if ($isSearchCategory) {
    $stmt->bindParam(':searchCategory', $searchSelectCategory, PDO::PARAM_INT);
  }
  //搜尋-價格
  if ($isSearchPrice) {
    $stmt->bindParam(':searchPriceFirst', $searchPriceFirst, PDO::PARAM_INT);
    $stmt->bindParam(':searchPriceSecond', $searchPriceSecond, PDO::PARAM_INT);
  }
  //搜尋-描述關鍵字
  if ($isSearchDescription) {
    $searchDescription = '%' . $searchDescription . '%';
    $stmt->bindParam(':searchDescription', $searchDescription, PDO::PARAM_STR);
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
          <h1 class="h3 mb-2 text-gray-800">商品列表 <i class="fa-solid fa-cart-arrow-down"></i></h1>
          <p class="mb-4">
            生活中，若商品列表出現了，我們就不得不考慮它出現了的事實。當前最急迫的事，想必就是釐清疑惑了。
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
                          <a class="page-link" href="?page=<?= $i ?>&orderBy=<?= $orderBy ?>&order=<?= $order ?>">
                            <?= $i ?>
                          </a>
                        </li>
                    <?php endif;
                    endfor; ?>

                    <!-- <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif;
                          endfor; ?> -->
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
                <!-- 搜尋-商品關鍵字 -->
                <div class="ml-3">
                  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel">搜尋商品 <i class="fa-solid fa-gifts"></i></h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchForm" action="">
                            <input class="form-control mr-sm-2" type="search" placeholder="請輸入關鍵字" aria-label="Search" id="searchInput" value="">
                          </form>
                          <div class="form-text text-danger" id="searchInputError"></div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-success" type="button" onclick="searchProducts()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" data-toggle="modal" href="#exampleModalToggle" role="button">商品
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                  </a>
                </div>
                <!-- 搜尋-商品關鍵字結束 -->
                <!-- 搜尋-商品類別 -->
                <div class="ml-3">
                  <div class="modal fade" id="exampleModalToggleCategory" aria-hidden="true" aria-labelledby="exampleModalToggleLabelCategory" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabelCategory">搜尋類別 <i class="fa-solid fa-table-list"></i></h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchForm" action="">
                            <select class="form-control" id="categories_id" name="categories_id">
                              <option value="" disabled selected>-- 請選擇類別 --</option>
                              <?php
                              // Fetch categories from the database
                              $categoriesSql = "SELECT * FROM categories";
                              $categoriesResult = $pdo->query($categoriesSql);

                              while ($category = $categoriesResult->fetch(PDO::FETCH_ASSOC)) {
                                $categoryId = $category['categories_id'];
                                $categoryName = htmlentities($category['name']);

                                echo "<option value=\"$categoryId\">$categoryName</option>";
                              }
                              ?>
                            </select>
                          </form>
                          <div class="form-text text-danger" id="searchInputCategoryError"></div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-success" type="button" onclick="searchCategory()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" data-toggle="modal" href="#exampleModalToggleCategory" role="button">類別
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                  </a>
                </div>
                <!-- 搜尋-商品類別結束 -->
                <!-- 搜尋-價格 -->
                <div class="ml-3">
                  <div class="modal fade" id="exampleModalTogglePrice" aria-hidden="true" aria-labelledby="exampleModalToggleLabelPrice" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabelPrice">搜尋價格 <i class="fa-solid fa-sack-dollar"></i></h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchFormPrice" action="">
                            <input class="form-control mr-sm-2" type="number" placeholder="請輸入價格" aria-label="SearchPrice" id="searchInputPriceFirst" oninput="validatePriceInput()">
                            <p class="form-text text-danger" id="searchInputPriceErrorFirst"></p>

                            <input class="form-control mr-sm-2" type="number" placeholder="請輸入價格" aria-label="SearchPrice" id="searchInputPriceSecond" oninput="validatePriceInput()">
                          </form>
                          <div class="form-text text-danger" id="searchInputPriceError"></div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-success" type="button" onclick="searchPrice()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" data-toggle="modal" href="#exampleModalTogglePrice" role="button">價格
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                  </a>
                </div>
                <!-- 搜尋-價格結束 -->
                <!-- 搜尋-描述 -->
                <div class="col-2">
                  <div class="modal fade" id="exampleModalToggleDescription" aria-hidden="true" aria-labelledby="exampleModalToggleLabelDescription" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabelDescription">搜尋描述 <i class="fa-solid fa-comment-dots"></i></h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchFormDescription" action="">
                            <input class="form-control mr-sm-2" type="search" placeholder="請輸入關鍵字" aria-label="SearchDescription" id="searchInputDescription" value="">
                          </form>
                          <div class="form-text text-danger" id="searchInputDescriptionError"></div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-success" type="button" onclick="searchDescription()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a class="btn btn-primary" data-toggle="modal" href="#exampleModalToggleDescription" role="button">描述
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                  </a>
                </div>
                <!-- 搜尋-描述結束 -->
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 20px;"><i class="fa-solid fa-trash"></i></th>
                      <th style="width: 20px;">
                        <a href="?orderBy=product_id&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'product_id' && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                          <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'product_id' && $_GET['order'] === 'asc') ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up' ?>"></i>
                        </a>#
                      </th>
                      <th style="width: 100px;">商品名稱</th>
                      <th style="width: 100px;">種類列表</th>
                      <th style="width: 60px;">
                        <a class="d-block" href="?orderBy=price&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'price' && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                          <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'price' && $_GET['order'] === 'asc') ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up' ?>"></i>
                        </a>價格
                      </th>
                      <th style="width: 120px;">尺寸</th>
                      <th style="width: 120px;">
                        <a class="d-block" href="?orderBy=created_at&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'created_at' && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                          <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'created_at' && $_GET['order'] === 'asc') ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up' ?>"></i>
                        </a>
                        創建時間
                      </th>
                      <th style="width: 120px;">
                        <a class="d-block" href="?orderBy=updated_at&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'updated_at' && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                          <i class="fas <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'updated_at' && $_GET['order'] === 'asc') ? 'fa-arrow-circle-down' : 'fa-arrow-circle-up' ?>"></i>
                        </a>
                        更新時間
                      </th>
                      <th style="width: 200px;">描述</th>
                      <th style="width: 20px;"><i class="fa-solid fa-file-pen"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $r) : ?>
                      <tr>
                        <td style="width: 20px;">
                          <a href="javascript: delete_one(<?= $r['product_id'] ?>)">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </td>
                        <td style="width: 20px;"><?= $r['product_id'] ?></td>
                        <td style="width: 100px;"><?= $r['name'] ?></td>
                        <td style="width: 100px;"><?= $r['category_name'] ?></td>
                        <td style="width: 60px;"><?= $r['price'] ?></td>
                        <td style="width: 120px;"><?= $r['size'] ?></td>
                        <td style="width: 120px;"><?= $r['created_at'] ?></td>
                        <td style="width: 120px;"><?= $r['updated_at'] ?></td>
                        <td style="width: 200px;"><?= $r['description'] ?></td>
                        <td style="width: 20px;"><a href=" edit.php?product_id=<?= $r['product_id'] ?>">
                            <i class="fa-solid fa-file-pen"></i>
                          </a>
                        </td>
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
            商品已成功刪除 (ﾉ>ω<)ﾉ </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">繼續瀏覽</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      //搜尋-商品關鍵字
      var searchInputError = document.getElementById('searchInputError');
      var modalToggle = document.getElementById('exampleModalToggle');

      function searchProducts() {
        let searchInput = document.getElementById('searchInput');
        let searchKeyword = searchInput.value.trim();
        if (searchKeyword !== '') {
          window.location.href = 'list.php?search=' + encodeURIComponent(searchKeyword);
        } else {
          searchInputError.textContent = '請輸入關鍵字 (ㆆᴗㆆ)';
        }
      }

      modalToggle.addEventListener('show.bs.modal', function() {
        searchInputError.textContent = '';
      });

      // 搜尋-類別
      var searchInputCategoryError = document.getElementById('searchInputCategoryError');
      var modalToggleCategory = document.getElementById('exampleModalToggleCategory');

      function searchCategory() {
        var searchSelectCategory = document.getElementById('categories_id');
        var searchKeywordCategory = searchSelectCategory.value.trim();
        if (searchKeywordCategory !== '') {
          window.location.href = 'list.php?searchCategory=' + encodeURIComponent(searchKeywordCategory);
        } else {
          searchInputCategoryError.textContent = '請選擇類別 ε≡(ノ´＿ゝ｀）ノ'
        }
      }

      modalToggleCategory.addEventListener('show.bs.modal', function() {
        searchInputCategoryError.textContent = '';
      });

      //搜尋-價格
      var searchInputPriceFirst = document.getElementById('searchInputPriceFirst');
      var searchInputPriceSecond = document.getElementById('searchInputPriceSecond');
      var searchInputPriceError = document.getElementById('searchInputPriceError');
      var modalTogglePrice = document.getElementById('exampleModalTogglePrice');

      function validatePriceInput() {
        searchInputPriceError.textContent = '';
        if (searchInputPriceFirst.value.trim() === '') {
          searchInputPriceSecond.value = '';
          return;
        }
      }

      function searchPrice() {
        searchInputPriceError.textContent = '';
        var firstPrice = searchInputPriceFirst.value.trim();
        var secondPrice = searchInputPriceSecond.value.trim();
        if (firstPrice === '' && secondPrice === '') {
          searchInputPriceError.textContent = '請輸入價格 ლ(・´ｪ`・ლ)';
          return;
        }

        if (firstPrice !== '' && secondPrice == '') {
          searchInputPriceError.textContent = '請輸入第二個價格 (´◓Д◔`)';
          return;
        }

        // Check if both inputs are filled
        if (firstPrice !== '' || secondPrice !== '') {
          if (parseInt(firstPrice) > parseInt(secondPrice)) {
            searchInputPriceError.textContent = '第二個值要高於第一個值啦! ( ิ◕㉨◕ ิ)';
            return;
          }
        }

        // Construct URL with price range
        let url = 'list.php?';
        if (firstPrice !== '') {
          url += 'searchPriceFirst=' + encodeURIComponent(firstPrice) + '&';
        }
        if (secondPrice !== '') {
          url += 'searchPriceSecond=' + encodeURIComponent(secondPrice);
        }
        url += 'search=price';
        window.location.href = url;
      }

      modalTogglePrice.addEventListener('show.bs.modal', function() {
        searchInputPriceError.textContent = '';
      });
      // 搜尋-價格結束
      // 搜尋-描述
      var modalToggleDescription = document.getElementById('exampleModalToggleDescription');
      var searchInputDescriptionError = document.getElementById('searchInputDescriptionError');

      function searchDescription() {
        var searchInputDescription = document.getElementById('searchInputDescription');
        var searchKeywordDescription = searchInputDescription.value.trim();
        if (searchKeywordDescription !== '') {
          window.location.href = 'list.php?searchDescription=' + encodeURIComponent(searchKeywordDescription);
        } else {
          searchInputDescriptionError.textContent = '請輸入關鍵字 ( σ՞ਊ ՞)σ'
        }
      }
      modalToggleDescription.addEventListener('show.bs.modal', function() {
        searchInputDescriptionError.textContent = '';
      });
      //搜尋-描述結束

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