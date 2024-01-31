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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <!-- 新增卡片放這邊 -->
                            <div class="col-6 border">
                                <div class="card-body">
                                <h5 class="card-title">新增資料</h5>
                                <form name="form1" method="post" onsubmit="sendForm(event)">
                                    <div class="mb-3">
                                    <label for="name" class="form-label">課程名稱</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入課程名稱(30字內)" maxlength="30">
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
                                    <div class="mb-3">
                                    <label for="store_id" class="form-label">商家名稱</label>
                                    <input type="text" class="form-control" id="store_name" name="store_name" disabled value="(代入商家名稱)"></input>
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="location" class="form-label">上課地點</label>
                                    <input type="checkbox" id="useStoreAddress" onclick="useStoreAddress()">帶入商家預設地址
                                    <input type="text" class="form-control" id="location" name="location" placeholder="帶入商家預設地址">
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="price" class="form-label">課程定價</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="請輸入課程定價" step="100" min="0" max="30000">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
            </div>
            </div>
        </div>
    </div>
    
    <?php include '../parts/scripts.php' ?>

    <!-- 送出表單 -->
    <script>
    // const {
    //   name: name_f,
    //   email: email_f,
    //   mobile: mobile_f,
    // } = document.form1;

    // function validateEmail(email) {
    //   var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //   return re.test(email);
    // }

    // function validateMobile(mobile) {
    //   var re = /^09\d{2}-?\d{3}-?\d{3}$/;
    //   return re.test(mobile);
    // }


    const sendForm = e => {
        e.preventDefault();
        // name_f.style.border = '1px solid #CCC';
        // name_f.nextElementSibling.innerHTML = "";
        // email_f.style.border = '1px solid #CCC';
        // email_f.nextElementSibling.innerHTML = "";
        // mobile_f.style.border = '1px solid #CCC';
        // mobile_f.nextElementSibling.innerHTML = "";

        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查

        // if (name_f.value.length < 2) {
        //   isPass = false;
        //   name_f.style.border = '1px solid red';
        //   name_f.nextElementSibling.innerHTML = "請填寫正確的姓名";
        // }

        // if (email_f.value && !validateEmail(email_f.value)) {
        //   isPass = false;
        //   email_f.style.border = '1px solid red';
        //   email_f.nextElementSibling.innerHTML = "請填寫正確的 Email";
        // }

        // if (mobile_f.value && !validateMobile(mobile_f.value)) {
        //   isPass = false;
        //   mobile_f.style.border = '1px solid red';
        //   mobile_f.nextElementSibling.innerHTML = "請填寫正確的手機號碼";
        // }


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

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
    </script>
    
    <?php include '../parts/html-foot.php' ?>