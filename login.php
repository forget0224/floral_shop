<?php
require __DIR__ . '/pages/parts/db_connect.php';
$pageName = 'login';
$title = '登入';

if (isset($_SESSION['admin'])) {
    header('Location: manager_index.php');
    exit;
}
?>
<?php include __DIR__ . '/pages/parts/html-head.php' ?>

<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>

<body class="bg-gradient-primary min-vh-100 d-flex align-items-center">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image-flower"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">請先登入</h1>
                                    </div>
                                    <form class="user" name="form1" method="post" onsubmit="sendForm(event)">
                                        <!-- <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address...">
                                            <div class="form-text"></div>


                                        </div> -->
                                        <div class="mb-3">
                                            <label for="store_account" class="form-label">帳號</label>
                                            <input type="text" class="form-control" id="store_account" name="store_account">
                                            <div class="form-text"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="store_password" class="form-label">密碼</label>
                                            <input type="password" class="form-control" id="store_password" name="store_password">
                                            <div class="form-text"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">登入</button>


                                        <!-- <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address...">
                                            <div class="form-text"></div>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" id="password"
                                                name="password">
                                            <div class="form-text"></div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button> -->


                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>










    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">登入結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        登入成功
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <a type="button" class="btn btn-primary" href="/floral_shop/manager_index.php">確認</a>
                </div> -->
            </div>
        </div>
    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <?php include __DIR__ . '/pages/parts/scripts.php' ?>
    <script>
        const {
            store_account: store_account_f,
            store_password: store_password_f,
        } = document.form1;

        const sendForm = e => {
            e.preventDefault();

            store_account_f.style.border = '1px solid #CCC';
            store_account_f.nextElementSibling.innerHTML = "";
            store_password_f.style.border = '1px solid #CCC';
            store_password_f.nextElementSibling.innerHTML = "";

            let isPass = true;

            if (store_account_f.value.trim().length === 0) {
                isPass = false;
                store_account_f.style.border = '1px solid red';
                store_account_f.nextElementSibling.innerHTML = "請填寫帳號";
            } else if (store_account_f.value.trim().length < 4) {
                isPass = false;
                store_account_f.style.border = '1px solid red';
                store_account_f.nextElementSibling.innerHTML = "請填寫正確的帳號";
            }

            if (store_password_f.value.trim().length === 0) {
                isPass = false;
                store_password_f.style.border = '1px solid red';
                store_password_f.nextElementSibling.innerHTML = "請填寫密碼";
            } else if (store_password_f.value.trim().length < 5) {
                isPass = false;
                store_password_f.style.border = '1px solid red';
                store_password_f.nextElementSibling.innerHTML = "請填寫正確的密碼";
            }

            if (isPass) {
                const fd = new FormData(document.form1);
                fetch('login-api.php', {
                        method: 'POST',
                        body: fd,
                    }).then(r => r.json())
                    .then(result => {
                        console.log({
                            result
                        });
                        // 如果登入成功，顯示 modal 並在一定時間後重新導向到 manager_index.php
                        if (result.success) {
                            myModal.show();
                            setTimeout(() => {
                                window.location.href = '/floral_shop/manager_index.php';
                            }, 1500); // 3000 毫秒，即 3 秒後自動重新導向
                        }
                    })
                    .catch(ex => console.log(ex))
            }
        }

        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
    </script>
    <?php include __DIR__ . '/pages/parts/html-foot.php' ?>