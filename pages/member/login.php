<?php require '../parts/db_connect.php';
$pageName = 'login';
$title = '登入';

if (isset($_SESSION['admin'])) {
    header('Location: ./index_.php');
    exit;
}

?>
<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
<style>
    .card-title,
    .form-label,
    .form-control,
    .btn {
        font-size: 2.5rem; 
    }

    /* form .mb-3 .form-text {
        color: red;
    } */
    .container {
    margin-top: 12rem; 
    }
    .card-title {
        color: blue;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title text-center">Member Login</h5>
                    <form name="form1" method="post" onsubmit="sendForm(event)">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary mx-auto d-block">Login</button>
                    </form>

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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Result</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Error!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>
<script>
    const {
        name: name_f,
        email: email_f,
        mobile: mobile_f,
    } = document.form1;

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    const sendForm = e => {
        e.preventDefault();

        email_f.style.border = '1px solid #CCC';
        email_f.nextElementSibling.innerHTML = "";



        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查


        /*
            if (email_f.value && !validateEmail(email_f.value)) {
            isPass = false;
            email_f.style.border = '1px solid red';
            email_f.nextElementSibling.innerHTML = "請填寫正確的 Email";
            }
        */

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
                        location.href = './index_.php';
                    } else {
                        myModal.show();
                    }
                })
                .catch(ex => console.log(ex))
        }


    }

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>