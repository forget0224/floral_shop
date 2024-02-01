<?php
require '../parts/db_connect.php';
// require '../parts/admin-required.php';
$pageName = 'edit';
$title = '編輯商品';

$product_id = isset($_GET["product_id"]) ? intval($_GET["product_id"]) : 0;
// $sql = "SELECT * FROM product WHERE product_id=$product_id";
$sql = "SELECT p.*, c.name AS category_name 
        FROM product p
        LEFT JOIN categories c ON p.categories_id = c.categories_id
        WHERE product_id=$product_id";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
  header('Location: list.php');
  exit; # 結束 php 程式
}
?>

<?php include '../parts/html-head.php' ?>

<style>
  form .mb-3 .form-text {
    color: red;
  }

  .hide-created-at,
  .hide-updated-at {
    display: none;
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
          <div class="container">
            <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" method="post" onsubmit="sendForm(event)">

                      <div class="mb-3">
                        <label class="form-label">編號</label>
                        <input type="text" class="form-control" disabled value="<?= $row['product_id'] ?>">
                      </div>
                      <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">

                      <div class="mb-3">
                        <label for="name" class="form-label">商品名稱</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="categories_id" class="form-label">種類列表</label>

                        <select class="form-control" id="categories_id" name="categories_id">
                          <option value="" disabled selected>--請選擇類別--</option>
                          <?php
                          // Fetch categories from the database
                          $categoriesSql = "SELECT * FROM categories";
                          $categoriesResult = $pdo->query($categoriesSql);

                          // Loop through the categories and generate <option> elements
                          while ($category = $categoriesResult->fetch(PDO::FETCH_ASSOC)) {
                            $categoryId = $category['categories_id'];
                            $categoryName = htmlentities($category['name']);

                            $selected = ($categoryId == $row['categories_id']) ? 'selected' : '';

                            // You can adjust the indentation based on your preference
                            echo "<option value=\"$categoryId\" $selected>$categoryName</option>";
                          }
                          ?>
                        </select>


                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="price" class="form-label">價格</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= $row['price'] ?>">
                        <div class="form-text"></div>
                      </div>
                      <div class="mb-3">
                        <label for="size" class="form-label">尺寸</label>
                        <input type="text" class="form-control" id="size" name="size" value="<?= $row['size'] ?>">
                        <div class="form-text"></div>
                      </div>

                      <!-- 創建時間和更新時間在編輯的頁面上隱藏 -->
                      <div class="mb-3 hide-created-at">
                        <label for="created_at" class="form-label">創建時間</label>
                        <input type="datetime" class="form-control" id="created_at" name="created_at" value="<?= $row['created_at'] ?>">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3 hide-updated-at">
                        <label for="updated_at" class="form-label">更新時間</label>
                        <input type="datetime" class="form-control" id="updated_at" name="updated_at" value="<?= $row['updated_at'] ?>">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">描述</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $row['description'] ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                  </div>
                </div>
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
  <!-- 沒有修改 -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" role="alert" id="errorAlert">
            沒有更改 (o´罒`o)
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='edit.php?product_id=<?= $product_id ?>'">繼續編輯</button>
          <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
        </div>
      </div>
    </div>
  </div>
  <!-- 編輯成功 -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success" role="alert" id="successAlert">
            編輯成功 (✪ω✪)
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='edit.php?product_id=<?= $product_id ?>'">繼續編輯</button>
          <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
        </div>
      </div>
    </div>
  </div>
  <?php include '../parts/scripts.php'  ?>

  <script>
    let originalData = {};

    const hasFormChanged = () => {
      // Compare each field with the original data
      for (const field in originalData) {
        if (field === 'categories_id' && document.form1[field].value != originalData[field]) {
          return true; // Form has changed
        } else if (field !== 'categories_id' && document.form1[field].value !== originalData[field]) {
          return true; // Form has changed
        }
      }
      return false; // No changes in the form
    };


    function check() {
      originalData = {
        name: '<?= htmlentities($row['name']) ?>',
        categories_id: '<?= $row['categories_id'] ?>',
        // categories_id: '<?= $row['category_name'] ?>',
        price: '<?= $row['price'] ?>',
        size: '<?= $row['size'] ?>',
        description: '<?= $row['description'] ?>',
      };
    }
    check();
    console.log(originalData.categories_id)

    const sendForm = e => {
      e.preventDefault();

      const errorAlert = new bootstrap.Modal(document.getElementById('errorModal'));
      const successAlert = new bootstrap.Modal(document.getElementById('successModal'));

      if (!hasFormChanged()) {
        errorAlert.show();
      } else {
        successAlert.show();
      }

      const fd = new FormData(document.form1);
      fetch('edit-api.php', {
          method: 'POST',
          body: fd,
        })
        .then(r => r.json())
        .then(result => {
          console.log({
            result
          });
          if (result.success) {
            if (hasFormChanged()) {
              successAlert.show();
            } else {
              errorAlert.show();
            }
          }
        })
        .catch(ex => console.log(ex));
    };
  </script>

  <?php include '../parts/html-foot.php' ?>