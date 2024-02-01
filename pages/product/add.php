<?php
require '../parts/db_connect.php';
// require '../parts/admin-required.php';
$pageName = 'add';
$title = '增加商品';
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
          <!-- 頁面整塊貼上!!!!!! -->
          <div class="container">
            <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">新增資料</h5>

                    <form name="form1" method="post" onsubmit="sendForm(event)">

                      <div class="mb-3">
                        <label for="name" class="form-label">商品名稱</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="categories_id" class="form-label">類別</label>
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

                            // You can adjust the indentation based on your preference
                            echo "<option value=\"$categoryId\">$categoryName</option>";
                          }
                          ?>
                        </select>
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="price" class="form-label">價格</label>
                        <input type="number" class="form-control" id="price" name="price">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="size" class="form-label">尺寸</label>
                        <input type="text" class="form-control" id="size" name="size">
                        <div class="form-text"></div>
                        <span style="color:gray;font-size:smaller">(尺寸格式:10cmx10cm)</span>
                      </div>

                      <div class="mb-3 hide-created-at">
                        <label for="created_at" class="form-label">創建時間</label>
                        <input type="datetime" class="form-control" id="created_at" name="created_at">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3 hide-updated-at">
                        <label for="updated_at" class="form-label">更新時間</label>
                        <input type="datetime" class="form-control" id="updated_at" name="updated_at">
                        <div class="form-text"></div>
                      </div>

                      <div class="mb-3">
                        <label for="description" class="form-label">描述</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">新增</button>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">新增結果</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success" role="alert">
            新增成功
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="continueAddingBtn">繼續新增</button>
          <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
        </div>
      </div>
    </div>
  </div>
  <?php include '../parts/scripts.php'  ?>

  <script>
    const {
      name: name_f,
      categories_id: categories_f,
      price: price_f,
      size: size_f
    } = document.form1;


    // sendForm函式用於處理表單提交事件
    const sendForm = e => {
      e.preventDefault(); //避免預設使頁面刷新或跳轉，改用js處理表單提交
      name_f.style.border = '1px solid #CCC';
      name_f.nextElementSibling.innerHTML = "";
      categories_f.style.border = '1px solid #CCC';
      categories_f.nextElementSibling.innerHTML = "";
      price_f.style.border = '1px solid #CCC';
      price_f.nextElementSibling.innerHTML = "";
      size_f.style.border = '1px solid #CCC';
      size_f.nextElementSibling.innerHTML = "";

      let isPass = true; //表單有沒有通過檢查

      if (name_f.value === "" || name_f.value === null) {
        isPass = false;
        name_f.style.border = '1px solid red';
        name_f.nextElementSibling.innerHTML = "請填寫商品名稱 _:(´□`」 ∠):_";
      }

      if (categories_f.value === "" || categories_f.value === null) {
        isPass = false;
        categories_f.style.border = '1px solid red';
        categories_f.nextElementSibling.innerHTML = "請選擇商品類別 (｡-_-｡)";
      }

      if (price_f.value === "" || price_f.value === null) {
        isPass = false;
        price_f.style.border = '1px solid red';
        price_f.nextElementSibling.innerHTML = "請填寫價格 ㅍ_ㅍ";
      }

      if (size_f.value === "" || size_f.value === null) {
        isPass = false;
        size_f.style.border = '1px solid red';
        size_f.nextElementSibling.innerHTML = "請填寫尺寸 (≖＿≖)✧";
      }

      if (isPass) {
        // "沒有外觀" 的表單
        const fd = new FormData(document.form1);

        fetch('add-api.php', {
            method: 'POST',
            body: fd,
          }).then(r => r.json())
          .then(result => {
            console.log({
              result
            });
            if (result.success) {
              myModal.show();
              document.form1.reset();
            }
          })
          .catch(ex => console.log(ex))
      }
    }

    // Continue Adding button redirects to a new form page
    document.getElementById('continueAddingBtn').addEventListener('click', () => {
      // Redirect to the add.php page
      window.location.href = 'add.php';
    });

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
  </script>


  <?php include '../parts/html-foot.php' ?>