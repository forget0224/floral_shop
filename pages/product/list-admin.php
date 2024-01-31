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
    %s
    %s
    ORDER BY p.product_id DESC
    LIMIT %s, %s",
    $isSearch ? "WHERE p.name LIKE :searchKeyword" : "", //搜尋-商品關鍵字
    $isSearchCategory ? "AND p.categories_id = :searchCategory" : "", // 搜尋-類別
    ($isSearchPrice && $searchPriceFirst !== '' && $searchPriceSecond !== '') ? "AND p.price BETWEEN :searchPriceFirst AND :searchPriceSecond" : "", // 搜尋-價格
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
                <!-- 搜尋-商品關鍵字 -->
                <div class="ml-3">
                  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalToggleLabel">搜尋商品</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchForm" action="">
                            <input class="form-control mr-sm-2" type="search" placeholder="請輸入商品關鍵字" aria-label="Search" id="searchInput" value="">
                            <p class="form-text text-danger" id="searchInputError"></p>
                          </form>
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
                  <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">商品
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
                          <h5 class="modal-title" id="exampleModalToggleLabelCategory">搜尋類別</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchForm" action="">
                            <select class="form-control" id="categories_id" name="categories_id">
                              <option value="" disabled selected>--請選擇類別--</option>
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
                            <p class="form-text text-danger" id="searchInputCategoryError"></p>
                          </form>
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
                  <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggleCategory" role="button">類別
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
                          <h5 class="modal-title" id="exampleModalToggleLabelPrice">搜尋價格</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0" id="searchFormPrice" action="">
                            <input class="form-control mr-sm-2" type="number" placeholder="請輸入價格" aria-label="SearchPrice" id="searchInputPriceFirst" oninput="validatePriceInput()">
                            <p class="form-text text-danger" id="searchInputPriceErrorFirst"></p>

                            <input class="form-control mr-sm-2" type="number" placeholder="請輸入價格" aria-label="SearchPrice" id="searchInputPriceSecond" oninput="validatePriceInput()">
                            <p class="form-text text-danger" id="searchInputPriceError"></p>
                          </form>
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
                  <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalTogglePrice" role="button">價格
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                  </a>
                </div>
                <!-- 搜尋-價格結束 -->
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
    //搜尋-商品關鍵字
    var searchInputError = document.getElementById('searchInputError');
    var modalToggle = document.getElementById('exampleModalToggle');

    function searchProducts() {
      let searchInput = document.getElementById('searchInput');
      let searchKeyword = searchInput.value.trim();
      if (searchKeyword !== '') {
        window.location.href = 'list.php?search=' + encodeURIComponent(searchKeyword);
      } else {
        searchInputError.textContent = '請輸入關鍵字';
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
        searchInputCategoryError.textContent = '請選擇類別'
      }
    }

    modalToggleCategory.addEventListener('show.bs.modal', function() {
      searchInputCategoryError.textContent = '';
    });

    //搜尋價格
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
        searchInputPriceError.textContent = '請輸入價格';
        return;
      }

      // Check if both inputs are filled
      if (firstPrice !== '' || secondPrice !== '') {
        if (parseInt(firstPrice) > parseInt(secondPrice)) {
          searchInputPriceError.textContent = '要高於上一個值';
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
    // 搜尋價格結束

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