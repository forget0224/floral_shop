<?php require __DIR__ . '/pages/parts/db_connect.php';
$pageName = 'login';
$title = '登入';

if (isset($_SESSION['admin'])) {
    header('Location: ./manager_index.php');
    exit;
}
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
                                        <div class="form-group">
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
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>

                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <!-- 彈跳視窗 帳密錯誤 -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">登入結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        帳號或密碼錯誤
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續</button>
                </div>
            </div>
        </div>
    </div> -->





    <div class="modal fade" id="loginwrongModal" tabindex="-1" role="dialog" aria-labelledby="loginwrongModal"
        aria-hidden="true">
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
            exampleInputEmail: email_f,
        } = document.form1;

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        const sendForm = e => {
            e.preventDefault();

            email_f.style.border = '1px solid #CCC';
            email_f.nextElementSibling.innerHTML = "";
            let isPass = true;



            if (email_f.value && !validateEmail(email_f.value)) {
                isPass = false;
                email_f.style.border = '1px solid red';
                email_f.nextElementSibling.innerHTML = "請填寫正確的 Email";
            }


            if (isPass) {
                // "沒有外觀" 的表單
                const fd = new FormData(document.form1);

                fetch('login-api.php', {
                    method: 'POST',
                    body: fd, // content-type: multipart/form-data
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