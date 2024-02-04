<?php require '../parts/db_connect.php';
$pageName = 'add';
$title = '新增課程';
?>
<?php include '../parts/html-head.php' ?>
<style>
  form .mb-3 .form-text {
    color: red;
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
                    <h1 class="h3 mb-2 text-gray-800">新增課程</h1>
                    <p class="mb-4">請新增您的課程</p>

                    <!-- 新增資料的卡片 -->
                    <div class="card_container d-flex justify-content-center">
                        <div class="card shadow mb-4 px-0 col-6">
                            <div class="card-body">
                                <h5 class="card-title">新增資料</h5>
                                <form name="form1" method="post" onsubmit="sendForm(event)">
                                    <div class="mb-3">
                                      <label for="name" class="form-label">課程名稱</label>
                                      <input type="text" class="form-control" id="name" name="name" placeholder="請輸入課程名稱(30字內)">
                                      <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="intro" class="form-label">課程介紹</label>
                                      <textarea class="form-control" id="intro" name="intro" rows="5" placeholder="請輸入課程介紹(1000字內)" maxlength="1000"></textarea>
                                      <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="category_id" class="form-label">課程分類</label>
                                      <select class="form-control" id="category_id" name="category_id" required>
                                          <option value="" disabled selected>請選擇課程分類</option>
                                          <option value="1">花藝基礎課程</option>
                                          <option value="2">植栽相關課程</option>
                                          <option value="3">節慶主題課程</option>
                                          <option value="4">進階商業課程</option>
                                      </select>
                                      <div class="form-text"></div>
                                    </div>
                                    <!-- 代入商家名稱 -->
                                    <div class="mb-3">
                                      <label for="store_id" class="form-label">商家名稱</label>
                                      <?php
                                      // 在這裡從 $_SESSION 中取得商家名稱
                                      if (isset($_SESSION['admin']['store_name'])) {
                                          $store_name = $_SESSION['admin']['store_name'];
                                      } else {
                                          // 處理未登入的情況，可能將用戶導向登入頁面；或者設置一個默認值，這取決於你的應用邏輯
                                          $store_name = '未登入，無法代入商家名稱，請先登入';
                                      }
                                      ?>
                                      <input type="text" class="form-control" id="store_name" name="store_name" value="<?php echo $store_name; ?>" readonly></input>
                                      <div class="form-text"></div>
                                    </div>
                                    <!-- 代入上課地點 -->
                                    <div class="mb-3">
                                      <label for="location" class="form-label">上課地點</label>
                                      <input type="checkbox" class="me-1" id="addressCheckbox" onclick="useStoreAddress()">帶入商家預設地址
                                      <input type="text" class="form-control" id="location" name="location" value="">
                                      <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="price" class="form-label">課程定價</label>
                                      <input type="number" class="form-control" id="price" name="price" placeholder="請輸入課程定價" step="100" min="0">
                                      <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="min_capacity" class="form-label">最小開課人數</label>
                                      <input type="number" class="form-control" id="min_capacity" name="min_capacity" placeholder="請輸入最小開課人數" min="1" max="300">
                                      <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="max_capacity" class="form-label">最大開課人數</label>
                                      <input type="number" class="form-control" id="max_capacity" name="max_capacity" placeholder="請輸入最大開課人數" min="1" max="300">
                                      <div class="form-text"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">新增</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
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
                <a href="">
                    <button type="button" class="btn btn-secondary" href="add.php" data-bs-dismiss="modal">繼續新增</button>
                </a>
                <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
            </div>
            </div>
        </div>
    </div>
    
    <?php include '../parts/scripts.php' ?>

    <!-- 送出表單 -->
    <script>
    const {
      name: name_f,
      intro: intro_f,
      category_id: category_f,
      store_name: store_f,
      location: location_f,
      price: price_f,
      min_capacity: min_f,
      max_capacity: max_f
    } = document.form1;

    const sendForm = e => {
        e.preventDefault();
        name_f.style.border = '1px solid #CCC';
        name_f.nextElementSibling.innerHTML = "";
        intro_f.style.border = '1px solid #CCC';
        intro_f.nextElementSibling.innerHTML = "";
        category_f.style.border = '1px solid #CCC';
        category_f.nextElementSibling.innerHTML = "";
        store_f.style.border = '1px solid #CCC';
        store_f.nextElementSibling.innerHTML = "";
        location_f.style.border = '1px solid #CCC';
        location_f.nextElementSibling.innerHTML = "";
        price_f.style.border = '1px solid #CCC';
        price_f.nextElementSibling.innerHTML = "";
        min_f.style.border = '1px solid #CCC';
        min_f.nextElementSibling.innerHTML = "";
        max_f.style.border = '1px solid #CCC';
        max_f.nextElementSibling.innerHTML = "";

        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查

        if (name_f.value.length < 2) {
          isPass = false;
          name_f.style.border = '1px solid red';
          name_f.nextElementSibling.innerHTML = "請輸入至少2個字的課程名稱";
        }
        
        if (name_f.value.length > 30) {
          isPass = false;
          name_f.style.border = '1px solid red';
          name_f.nextElementSibling.innerHTML = "課程名稱需小於30字";
        }
        
        if (intro_f.value.length < 2) {
          isPass = false;
          intro_f.style.border = '1px solid red';
          intro_f.nextElementSibling.innerHTML = "請輸入至少2個字的課程介紹";
        }
        
        if (intro_f.value.length > 1000) {
          isPass = false;
          intro_f.style.border = '1px solid red';
          intro_f.nextElementSibling.innerHTML = "課程介紹需小於1000字";
        }
        
        // TODO:之後不用驗證
        if (!store_f.value) {
          isPass = false;
          store_f.style.border = '1px solid red';
          store_f.nextElementSibling.innerHTML = "請輸入商家id";
        }
        
        // TODO:之後修改驗證
        if (!location_f.value) {
          isPass = false;
          location_f.style.border = '1px solid red';
          location_f.nextElementSibling.innerHTML = "請輸入上課地點";
        }
        
        if (price_f.value.length < 1) {
          isPass = false;
          price_f.style.border = '1px solid red';
          price_f.nextElementSibling.innerHTML = "請輸入正確的定價";
        }
        
        if (min_f.value.length < 1) {
          isPass = false;
          min_f.style.border = '1px solid red';
          min_f.nextElementSibling.innerHTML = "請輸入正確的最小開課人數";
        }
        
        if (max_f.value.length < 1) {
          isPass = false;
          max_f.style.border = '1px solid red';
          max_f.nextElementSibling.innerHTML = "請輸入正確的最大開課人數";
        }
        
        if (min_f.value > max_f.value) {
          isPass = false;
          max_f.style.border = '1px solid red';
          max_f.nextElementSibling.innerHTML = "最大開課人數需大於最小開課人數";
        }

        if (isPass) {
        // "沒有外觀" 的表單
        const fd = new FormData(document.form1);

        fetch('add-api.php', {
            method: 'POST',
            body: fd, // content-type: multipart/form-data
            }).then(r => r.json())
            .then(result => {
            console.log({
                result
            });
            if(result.success){
                myModal.show();
            }
            })
            .catch(ex => console.log(ex))
        }
    }
    function useStoreAddress() {
      const locationInput = document.getElementById('location');
      const addressCheckbox = document.getElementById('addressCheckbox');

      // 檢查 checkbox 是否被勾選
      if (addressCheckbox.checked) {
        // 使用 AJAX 從後端獲取商家地址
        fetch('get-store-address.php')  // 這裡的 URL 需要指向一個能夠獲取商家地址的後端 API
          .then(response => response.json())
          .then(data => {
            // 將商家地址填入 location 欄位
            locationInput.value = data.storeAddress;
          })
          .catch(error => console.error('Error fetching store address:', error));

        // 加上 readonly
        locationInput.setAttribute('readonly', true);
      } else {
        // 如果 checkbox 沒有勾選，移除 readonly，允許用戶編輯 location
        locationInput.removeAttribute('readonly');
        // 清空 location 欄位的值
        locationInput.value = '';
      }
    }

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
    </script>
    
    <?php include '../parts/html-foot.php' ?>