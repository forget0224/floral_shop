<?php require '../parts/db_connect.php';
$pageName = 'add';
$title = '新增';
// 你該頁面前面的那些東東

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
                    <!-- 頁面整塊貼上!!!!!! -->
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">꧁新增花朵資料꧂</h5><br>

                                        <!-- 表單開始 -->
                                        <form name="form1" method="post" onsubmit="sendForm(event)" class="d-grid gap-2">
                                            <!-- 中文花名輸入欄 -->
                                            <div class="mb-3">
                                                <label for="flower_name" class="form-label">中文花名</label>
                                                <input type="text" class="form-control" id="flower_name" name="flower_name" placeholder="至少兩個中文字元，勿用特殊符號、數字">
                                                <div class="form-text"></div> <!-- 用來顯示錯誤訊息的元素 -->
                                            </div>

                                            <!-- 英文花名輸入欄 -->
                                            <div class="mb-3">
                                                <label for="flower_engname" class="form-label">英文花名</label>
                                                <input type="text" class="form-control" id="flower_engname" name="flower_engname" placeholder="至少兩個英文字元，勿用特殊符號、數字">
                                                <div class="form-text"></div>
                                            </div>

                                            <!-- 花語輸入欄 -->
                                            <div class="mb-3">
                                                <label for="flower_lang" class="form-label">花語</label>
                                                <input type="text" class="form-control" id="flower_lang" name="flower_lang" placeholder="至少兩個中文字元">
                                                <div class="form-text"></div>
                                            </div>

                                            <!-- 花朵簡介輸入欄 -->
                                            <div class="mb-3">
                                                <label for="flower_intro" class="form-label">花朵簡介</label>
                                                <textarea class="form-control" name="flower_intro" id="flower_intro" cols="30" rows="3" placeholder="至少兩個中文字元"></textarea>
                                                <div class="form-text"></div>
                                            </div>

                                            <!-- 送出按鈕 -->
                                            <button type="submit" class="btn btn-primary">新增</button>
                                        </form>
                                        <!-- 表單結束 -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 模態框按鈕觸發 -->
                        <!--
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
-->

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
    <!-- 模態框 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">新增結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="continueAddingBtn"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success text-center" role="alert">
                    已成功新增資料
                    </div>
                    <img src="https://media2.giphy.com/media/QA7nawRHAQV8EzGWTZ/giphy.gif" class="img-fluid" alt="...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='/floral_shop/pages/intro/intro_add.php'">繼續新增</button>
                    <a type="button" class="btn btn-primary" href="/floral_shop/pages/intro/intro_flower.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        // 取得表單中的各個欄位
        const {
            flower_name: flower_name,
            flower_engname: flower_engname,
            flower_lang: flower_lang,
            flower_intro: flower_intro
        } = document.form1;


        // 送出表單的函式
        const sendForm = e => {
            e.preventDefault();

            // 重置欄位的樣式和錯誤訊息
            flower_name.style.border = '1px solid #CCC';
            flower_name.nextElementSibling.innerHTML = "";
            flower_engname.style.border = '1px solid #CCC';
            flower_engname.nextElementSibling.innerHTML = "";
            flower_lang.style.border = '1px solid #CCC';
            flower_lang.nextElementSibling.innerHTML = "";
            flower_intro.style.border = '1px solid #CCC';
            flower_intro.nextElementSibling.innerHTML = "";

            let isPass = true; // 表單有沒有通過檢查



            // 檢查中文花名欄位
            if (!/^[\u4E00-\u9FA5]{2,}$/.test(flower_name.value)) {
                isPass = false;
                flower_name.style.border = '1px solid red';
                flower_name.nextElementSibling.innerHTML = "請填寫正確的中文花名（需至少兩個中文字元且不能包含特殊符號或數字）";
            }



            // 檢查英文花名欄位
            if (!/^[a-zA-Z ]{2,}$/.test(flower_engname.value) || /\d/.test(flower_engname.value)) {
                isPass = false;
                flower_engname.style.border = '1px solid red';
                flower_engname.nextElementSibling.innerHTML = "請填寫正確的英文花名（需至少兩個英文字元且不能包含特殊符號或數字）";
            }



            // 檢查花語欄位
            if (flower_lang.value.length < 2) {
                isPass = false;
                flower_lang.style.border = '1px solid red';
                flower_lang.nextElementSibling.innerHTML = "請填寫正確的花語（需至少兩個中文字元）";
            }



            // 檢查花朵簡介欄位
            if (flower_intro.value.length < 2) {
                isPass = false;
                flower_intro.style.border = '1px solid red';
                flower_intro.nextElementSibling.innerHTML = "請填寫正確的花朵簡介（需至少兩個中文字元）";
            }



            // 如果表單通過檢查，使用Fetch API送出表單
            if (isPass) {
                const fd = new FormData(document.form1);

                fetch('intro_add-api.php', {
                        method: 'POST',
                        body: fd,
                    }).then(r => r.json())
                    .then(result => {
                        console.log({
                            result
                        });
                        if (result.success) {
                            // 若新增成功，顯示模態框
                            myModal.show();
                        }
                    })
                    .catch(ex => console.log(ex))
            }
        }

        // 初始化模態框
        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

        // Continue Adding button redirects to a new form page
        document.getElementById('continueAddingBtn').addEventListener('click', () => {
            // Redirect to the add.php page
            window.location.href = '';
        });
    </script>
    <?php include '../parts/html-foot.php' ?>