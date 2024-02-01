<?php
require __DIR__ . '/pages/parts/db_connect.php';
$pageName = 'login';
$title = '登入';

// if (isset($_SESSION['admin'])) {
//     header('Location: ./manager_index.php');
//     exit;
// }
?>
<?php include __DIR__ . '/pages/parts/html-head.php' ?>


<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
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









    <div class="modal fade" id="loginwrongModal" tabindex="-1" role="dialog" aria-labelledby="loginwrongModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginwrongModal">登入結果</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</span>
                    </button>
                </div>
                <div class="modal-body alert alert-danger">帳號或密碼錯誤</div>
                <div class="modal-footer">

                    <a class="btn btn-primary" href="login.php">繼續</a>
                </div>
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
        
        function validatestore_account(store_account) {
            return store_account.trim() !== '';
        }

        function validatestore_password(store_password) {
            return store_password.trim() !== '';
        }

        const sendForm = e => {
            e.preventDefault();

            store_account_f.style.border = '1px solid #CCC';
            store_account_f.nextElementSibling.innerHTML = "";
            store_password_f.style.border = '1px solid #CCC';
            store_password_f.nextElementSibling.innerHTML = "";
            let isPass = true;



            if (store_account_f.value && !validatestore_account(store_account_f.value)) {
                isPass = false;
                store_account_f.style.border = '1px solid red';
                store_account_f.nextElementSibling.innerHTML = "請填寫正確的帳號";
            }

            if (store_password_f.value && !validatestore_password(store_password_f.value)) {
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
                        if (result.success) {
                            location.href = './manager_index.php';
                        } else {
                            myModal.show();
                        }
                    })
                    .catch(ex => console.log(ex))
            }


        }

        const myModal = new bootstrap.Modal(document.getElementById('loginwrongModal'))
    </script>
    <?php include __DIR__ . '/pages/parts/html-foot.php' ?>