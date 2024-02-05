<?php
require '../parts/db_connect.php';
$pageName = 'store_edit';
$title = '店家編輯';
// 你該頁面前面的那些東東

$store_id = isset($_GET['store_id']) ? intval($_GET['store_id']) : 0;
$sql = "SELECT * FROM store WHERE store_id=$store_id";

// fetch()  select找到的資料只有一筆
// 用fetchALL() 會拿到陣列型態，多包一層
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: list.php');
    exit; # 結束 php 程式
}



?>
<?php include '../parts/html-head.php' ?>

<style>
    form .mb-3,
    .form-text {
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
                    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <!-- table裡面的東西 複製近來!!!!!!!!!  -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">編輯資料</h5>
                                                    <!-- <form method="post" onsubmit="return false"> -->
                                                    <form name="form1" method="post" onsubmit="sendForm(event)">
                                                        <div class="mb-3">
                                                            <label class="form-label">編號</label>
                                                            <!-- disabled 不讓人操作 -->
                                                            <!-- 修改時會看到預設值 <?= $row['store_id'] ?> -->
                                                            <input type="text" class="form-control" disabled value="<?= $row['store_id'] ?>">
                                                        </div>

                                                        <!-- <?= $row['store_id'] ?>  是從這邊獲取，不能刪掉-->
                                                        <input type="hidden" name="store_id" value="<?= $row['store_id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="store_name" class="form-label">姓名</label>
                                                            <!-- name 要設定 htmlentities() ，以免注入攻擊-->
                                                            <input type="text" class="form-control" id="store_name" name="store_name" value="<?= htmlentities($row['store_name']) ?>" placeholder="請輸入兩個字元以上的姓名">
                                                            <div class="form-text"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="store_account" class="form-label">帳號</label>
                                                            <input type="text" class="form-control" id="store_account" name="store_account" value="<?= $row['store_account'] ?>" placeholder="請輸入包含英文及數字6~20字元的帳號">
                                                            <div class="form-text"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="store_password" class="form-label">密碼</label>
                                                            <input type="text" class="form-control" id="store_password" name="store_password" value="<?= $row['store_password'] ?>" placeholder="請輸入包含英文及數字8~16字元的密碼">
                                                            <div class="form-text"></div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="store_tel" class="form-label">電話</label>
                                                            <input type="text" class="form-control" id="store_tel" name="store_tel" value="<?= $row['store_tel'] ?>" placeholder="09xx-xxx-xxx">
                                                            <div class="form-text"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="store_email" class="form-label">信箱</label>
                                                            <input type="text" class="form-control" id="store_email" name="store_email" value="<?= $row['store_email'] ?>" placeholder="xxx@gmail.com">
                                                            <div class="form-text"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="store_address" class="form-label">地址</label>
                                                            <textarea class="form-control" name="store_address" id="store_address" cols="30" rows="3"><?= $row['store_address'] ?></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="sub_id" class="form-label">訂閱方案</label>
                                                            <select class="form-select" id="sub_id" name="sub_id">
                                                                <option value="1">1個月</option>
                                                                <option value="2">6個月</option>
                                                                <option value="3">12個月</option>
                                                            </select>
                                                            <div class="form-text"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="sub_date" class="form-label">訂閱日期</label>
                                                            <input type="date" class="form-control" id="sub_date" name="sub_date" value="<?= $row['sub_date'] ?>">
                                                            <div class="form-text"></div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">修改</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- 成功Modal -->
                                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-success" role="alert">
                                                        編輯成功
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="continueEditingBtn">繼續編輯</button>
                                                    <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 失敗Modal -->
                                    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger" role="alert" id="errorAlert">
                                                        沒有更改
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="restartEditingBtn">重新編輯</button>
                                                    <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
                                                </div>
                                            </div>
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
        // 訂閱日期
        // 取得當前日期的字串表示
        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0'); // 月份從0開始，因此需要+1
            const day = now.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        // 將當前日期設定為預設值
        document.getElementById('sub_date').value = getCurrentDate();



        // 驗證
        // 重新命名input欄位，解構賦子
        const {
            store_name: store_name_f, // <input type="text" class="form-control" id="name" name="name">   
            store_account: store_account_f, // 新增帳號的解構賦值   
            store_password: store_password_f, // 新增密碼的解構賦值
            store_email: store_email_f,
            store_tel: store_tel_f,
        } = document.form1;


        // 帳號驗證函式
        function validatestore_account(store_account) {
            // 長度在8到20位之間，包含英文、數字
            var re = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/;
            return re.test(store_account);
        }

        // 密碼
        function validatePassword(store_password) {
            // 長度在8到16位之間，包含英文和數字
            var re = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{8,16}$/;
            return re.test(store_password);
        }

        // 信箱
        function validatestore_email(store_email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(store_email);
        }
        // 電話
        function validatestore_tel(store_tel) {
            var re = /^09\d{2}-?\d{3}-?\d{3}$/;
            return re.test(store_tel);
        }






        // 表單送出流程
        const sendForm = e => {
            e.preventDefault();
            // 表單送出，重置輸入框內容
            store_name_f.style.border = '1px solid #CCC';
            store_name_f.nextElementSibling.innerHTML = "";
            store_account_f.style.border = '1px solid #CCC';
            store_account_f.nextElementSibling.innerHTML = "";
            store_email_f.style.border = '1px solid #CCC';
            store_email_f.nextElementSibling.innerHTML = "";
            store_tel_f.style.border = '1px solid #CCC';
            store_tel_f.nextElementSibling.innerHTML = "";

            // alert() 是同步函式，盡量別用
            // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
            let isPass = true; // 表單有沒有通過檢查


            // 判斷name輸入欄位長度
            // 姓名
            if (store_name_f.value.trim().length === 0) {
                // alert("請填寫正確的姓名");
                isPass = false;
                store_name_f.style.border = '1px solid red';
                store_name_f.nextElementSibling.innerHTML = "請填寫姓名";
            } else if (store_name_f.value.trim().length < 2) {
                // alert("請填寫正確的姓名");
                isPass = false;
                store_name_f.style.border = '1px solid red';
                store_name_f.nextElementSibling.innerHTML = "請填寫正確的姓名";
            }

            // 帳號
            if (store_account_f.value.trim().length === 0) {
                isPass = false;
                store_account_f.style.border = '1px solid red';
                store_account_f.nextElementSibling.innerHTML = "請填寫帳號";
            } else if (!validatestore_account(store_account_f.value)) {
                isPass = false;
                store_account_f.style.border = '1px solid red';
                store_account_f.nextElementSibling.innerHTML = "請填寫6~20位數，包含英文及數字的帳號";
            }

            // 密碼驗證
            if (store_password_f.value.trim().length === 0) {
                isPass = false;
                store_password_f.style.border = '1px solid red';
                store_password_f.nextElementSibling.innerHTML = "請填寫密碼";
            } else if (!validatePassword(store_password_f.value)) {
                isPass = false;
                store_password_f.style.border = '1px solid red';
                store_password_f.nextElementSibling.innerHTML = "請填寫8~16位數，包含英文及數字的密碼";
            }

            // 信箱驗證
            if (store_email_f.value && !validatestore_email(store_email_f.value)) {
                isPass = false;
                store_email_f.style.border = '1px solid red';
                store_email_f.nextElementSibling.innerHTML = "請填寫正確的信箱";
            }
            // 電話驗證
            if (store_tel_f.value && !validatestore_tel(store_tel_f.value)) {
                isPass = false;
                store_tel_f.style.border = '1px solid red';
                store_tel_f.nextElementSibling.innerHTML = "請填寫正確的手機號碼";
            }

            // 表單前端驗證通過
            // 接獲後端傳回的json訊息
            if (isPass) {
                // "沒有外觀" 的表單
                const fd = new FormData(document.form1);

                // fetch完，第一個then =>r 接收到資料，但不清楚接著要怎麼做
                // r => t.json() 下指令要求 r =>把資料轉成json()型式

                // 第二個then拿到的result =>json() 型式
                fetch('edit-api.php', {
                        method: 'POST',
                        body: fd, // content-type: multipart/form-data
                    }).then(r => r.json())
                    .then(result => {
                        console.log({
                            result
                        });
                        // Modal功能    
                        if (result.success) {
                            successModal.show();
                            // 清除表單輸入的資料
                            document.form1.reset();
                        } else {
                            // 編輯失敗，顯示 errorModal
                            errorModal.show();
                        }
                    })
                    .catch(ex => console.log(ex))
            }
        }

        // successModal
        document.getElementById('continueEditingBtn').addEventListener('click', () => {
            // Redirect to the edit.php page
            window.location.href = 'edit.php?store_id=<?= $store_id ?>';
        });
        // errorModal
        document.getElementById('restartEditingBtn').addEventListener('click', () => {
            // Redirect to the edit.php page
            window.location.href = 'edit.php?store_id=<?= $store_id ?>';
        });

        // Modal按鈕功能重設
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    </script>

    <?php include '../parts/html-foot.php' ?>