<?php require '../parts/db_connect.php';

// 設定頁面相關資訊
$pageName = 'edit';
$title = '編輯';

// 從 GET 參數中取得 flower_id，預設為 0
$flower_id = isset($_GET['flower_id']) ? intval($_GET['flower_id']) : 0;

// 使用 flower_id 查詢資料庫中的資料
$sql = "SELECT * FROM intro_flower WHERE flower_id = $flower_id ";
$row = $pdo->query($sql)->fetch();

// 若資料不存在，導向列表頁並結束程式
if (empty($row)) {
    header('Location: list.php');
    exit; // 結束 PHP 程式
}
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
                                        <h5 class="card-title  text-center">꧁編輯花朵資料꧂</h5><br>
                                        <!-- 編輯表單 -->
                                        <form name="form1" method="post" onsubmit="sendForm(event)" class="d-grid gap-2">
                                            <div class="mb-3">
                                                <label class="form-label">編號</label>
                                                <!-- 顯示 flower_id，並設為唯獨狀態 -->
                                                <input type="text" class="form-control" id="flower_id" name="flower_id" disabled value="<?= $row['flower_id'] ?>">
                                            </div>
                                            <!-- 以隱藏欄位傳遞 flower_id -->
                                            <input type="hidden" name="flower_id" value="<?= $row['flower_id'] ?>">
                                            <div class="mb-3">
                                                <label for="flower_name" class="form-label">中文花名</label>
                                                <!-- 顯示中文花名，使用 htmlentities 防止 XSS 攻擊 -->
                                                <input type="text" class="form-control" id="flower_name" name="flower_name" value="<?= htmlentities($row['flower_name']) ?>">
                                                <div class="form-text"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="flower_engname" class="form-label">英文花名</label>
                                                <!-- 顯示英文花名 -->
                                                <input type="text" class="form-control" id="flower_engname" name="flower_engname" value="<?= $row['flower_engname'] ?>">
                                                <div class="form-text"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="flower_lang" class="form-label">花語</label>
                                                <!-- 顯示花語 -->
                                                <input type="text" class="form-control" id="flower_lang" name="flower_lang" value="<?= $row['flower_lang'] ?>">
                                                <div class="form-text"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="flower_intro" class="form-label">簡介</label>
                                                <!-- 顯示花朵簡介 -->
                                                <textarea class="form-control" name="flower_intro" id="flower_intro" cols="30" rows="3"><?= $row['flower_intro'] ?></textarea>
                                                <div class="form-text"></div>
                                            </div>
                                            <!-- 提交修改按鈕 -->
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
    <!-- 模態框 -->

    <!-- 編輯結果的錯誤提示彈窗 -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.href='intro_edit.php?flower_id=<?= $flower_id ?>'"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center" role="alert" id="errorAlert" >
                沒有調整任何資料
                    </div>
                    <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExZm1qZnB5Z3B5OHRteWcydXJoOHpzZ2F1MjRxNXBwdDlqbDZoZnZieiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/VhKhvVypYbBJhuU4DR/giphy.gif" class="img-fluid" alt="...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='intro_edit.php?flower_id=<?= $flower_id ?>'">繼續編輯</button>
                    <a type="button" class="btn btn-primary" href="intro_flower.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 編輯結果的錯誤提示彈窗end -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.href='intro_edit.php?flower_id=<?= $flower_id ?>'"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success text-center" role="alert">
                        編輯成功
                    </div>
                    <img src="https://media2.giphy.com/media/QA7nawRHAQV8EzGWTZ/giphy.gif" class="img-fluid" alt="...">
                </div>
                <div class="modal-footer">
                    <!-- 按鈕選項：繼續編輯或返回列表頁 -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='intro_edit.php?flower_id=<?= $flower_id ?>'">繼續編輯</button>
                    <a type="button" class="btn btn-primary" href="/floral_shop/pages/intro/intro_flower.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        //以下是無變更時的modal script
        let originalData = {};

        const hasFormChanged = () => {
            // 比較每個字段是否與原始數據相同
            for (const field in originalData) {
                if (field === 'flower_name' && document.form1[field].value != originalData[field]) {
                    return true; // 表單已更改
                } else if (field !== 'flower_name' && document.form1[field].value !== originalData[field]) {
                    return true; // 表單已更改
                }
            }
            return false; // 表單無變更
        };

        function check() {
            originalData = {
                flower_name: '<?= $row['flower_name'] ?>',
                flower_engname: '<?= $row['flower_engname'] ?>',
                flower_lang: '<?= $row['flower_lang'] ?>',
                flower_intro: '<?= $row['flower_intro'] ?>',
            };
        }
        check();
        console.log(originalData.categories_id)

        const sendForm = e => {

            e.preventDefault();
                flower_name.style.border = '1px solid #CCC';
                flower_name.nextElementSibling.innerHTML = "";
                flower_engname.style.border = '1px solid #CCC';
                flower_engname.nextElementSibling.innerHTML = "";
                flower_lang.style.border = '1px solid #CCC';
                flower_lang.nextElementSibling.innerHTML = "";
                flower_intro.style.border = '1px solid #CCC';
                flower_intro.nextElementSibling.innerHTML = "";


                // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
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

                if (isPass) {
                    // "沒有外觀" 的表單
                    const fd = new FormData(document.form1);

                    // 
                    fetch('intro_edit-api.php', {
                            method: 'POST',
                            body: fd, // content-type: multipart/form-data
                        }).then(r => r.json())
                        .then(result => {
                            console.log({
                                result
                            });
                            if (result.success) {
                                myModal.show();
                            }
                        })
                        .catch(ex => console.log(ex))
                }
            e.preventDefault();

            const errorAlert = document.getElementById('errorModal') ? new bootstrap.Modal(document.getElementById('errorModal')) : null;
            const successAlert = document.getElementById('successModal') ? new bootstrap.Modal(document.getElementById('successModal')) : null;

            if (!hasFormChanged()) {
                errorAlert.show();
            } else {
                successAlert.show();
            }


            // 
            const fd = new FormData(document.form1);
            fetch('intro_edit-api.php', {
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


        if (!hasFormChanged()) {
            if (errorAlert instanceof bootstrap.Modal) {
                errorAlert.show();
            } else {
                console.error('errorAlert 不是有效的 bootstrap 模態對象。', errorAlert);
            }
        }

        /*//以下是原本的
            const {
                flower_name: flower_name,
                flower_engname: flower_engname,
                flower_lang: flower_lang,
                flower_intro: flower_intro
            } = document.form1;


            const sendForm = e => {
                e.preventDefault();
                flower_name.style.border = '1px solid #CCC';
                flower_name.nextElementSibling.innerHTML = "";
                flower_engname.style.border = '1px solid #CCC';
                flower_engname.nextElementSibling.innerHTML = "";
                flower_lang.style.border = '1px solid #CCC';
                flower_lang.nextElementSibling.innerHTML = "";
                flower_intro.style.border = '1px solid #CCC';
                flower_intro.nextElementSibling.innerHTML = "";


                // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
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

                if (isPass) {
                    // "沒有外觀" 的表單
                    const fd = new FormData(document.form1);

                    // 
                    fetch('intro_edit-api.php', {
                            method: 'POST',
                            body: fd, // content-type: multipart/form-data
                        }).then(r => r.json())
                        .then(result => {
                            console.log({
                                result
                            });
                            if (result.success) {
                                myModal.show();
                            }
                        })
                        .catch(ex => console.log(ex))
                }
            }*/

        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))

        // Continue Adding button redirects to a new form page
        document.getElementById('continueAddingBtn').addEventListener('click', () => {
            // Redirect to the add.php page
            window.location.href = '';
        });
    </script>
    <?php include '../parts/html-foot.php' ?>