<?php
// require __DIR__ . '/admin-required.php';

require '../parts/db_connect.php';
$title = '編輯';

$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : 0;
$sql = "SELECT * FROM member WHERE member_id=$member_id";

$row = $pdo->query($sql)->fetch();

if (empty($row)) {
    header('Location: list.php');
    exit; # 結束 php 程式
}


?>
<?php include __DIR__ . '/parts/html-head.php'  ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
<style>
    /* .container {
    margin-top: 15rem; 
    } */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 150px; /* 可以根據需要調整上方距離 */
    }

    .text-lg {
        font-size: 20px;
    }
</style>
<div class="container">
    <div class="row table h3 pagination-container">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">編輯資料</h2>
                    <form name="form1" method="post" onsubmit="sendForm(event)">
                        <div class="mb-3">
                            <label class="form-label">編號</label>
                            <input type="text" class="form-control form-control-lg" disabled value="<?= $row['member_id'] ?>">
                        </div>
                        <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">電郵</label>
                            <input type="text" class="form-control form-control-lg" id="email" name="email" value="<?= $row['email'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">手機</label>
                            <input type="text" class="form-control form-control-lg" id="phone" name="phone" value="<?= $row['phone'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">城市</label>
                            <input type="text" class="form-control form-control-lg" id="city" name="city" value="<?= $row['city'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">區域</label>
                            <input type="text" class="form-control form-control-lg" id="district" name="district" value="<?= $row['district'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <textarea class="form-control form-control-lg" name="address" id="address" cols="30" rows="3"><?= $row['address'] ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary btn-lg">確認</button>
                            <a href="list.php" class="btn btn-secondary btn-lg">取消</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- 没有更改的提示模态框 -->
<div class="modal fade" id="noChangesModal" tabindex="-1" aria-labelledby="noChangesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="noChangesModalLabel">提示</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-lg">
                <div class="alert alert-success" role="alert">
                    您並未變更資料
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-lg">
                <div class="alert alert-success" role="alert">
                    編輯成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續編輯</button>
                <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'  ?>

<script>
    const originalData = {
        name: "<?= htmlentities($row['name']) ?>",
        email: "<?= $row['email'] ?>",
        phone: "<?= $row['phone'] ?>",
        city: "<?= $row['city'] ?>",
        district: "<?= $row['district'] ?>",
        address: "<?= $row['address'] ?>",
    };

    const {
        name: name_f,
        email: email_f,
        phone: phone_f,
        city: city_f,
        district: district_f,
        address: address_f,
    } = document.form1;

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validatephone(phone) {
        var re = /^09\d{2}-?\d{3}-?\d{3}$/;
        return re.test(phone);
    }


    const sendForm = e => {
        e.preventDefault();
        name_f.style.border = '1px solid #CCC';
        name_f.nextElementSibling.innerHTML = "";
        email_f.style.border = '1px solid #CCC';
        email_f.nextElementSibling.innerHTML = "";
        phone_f.style.border = '1px solid #CCC';
        phone_f.nextElementSibling.innerHTML = "";

        // 获取表单数据
        const formData = {
            name: name_f.value,
            email: email_f.value,
            phone: phone_f.value,
            city: city_f.value,
            district: district_f.value,
            address: address_f.value,
        };

        // 检查是否有更改
        const hasChanged = Object.keys(formData).some(key => formData[key] !== originalData[key]);

        if (!hasChanged) {
            // 数据未更改，显示提示模态框
            showNoChangesModal();
            return;
        }

        // 显示数据未更改的模态框
        function showNoChangesModal() {
            const noChangesModal = new bootstrap.Modal(document.getElementById('noChangesModal'));
            noChangesModal.show();
        }

        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查

        if (name_f.value.length < 2) {
            // alert("請填寫正確的姓名");
            isPass = false;
            name_f.style.border = '1px solid red';
            name_f.nextElementSibling.innerHTML = "請填寫正確的姓名";
        }

        if (email_f.value && !validateEmail(email_f.value)) {
            isPass = false;
            email_f.style.border = '1px solid red';
            email_f.nextElementSibling.innerHTML = "請填寫正確的 Email";
        }

        if (phone_f.value && !validatephone(phone_f.value)) {
            isPass = false;
            phone_f.style.border = '1px solid red';
            phone_f.nextElementSibling.innerHTML = "請填寫正確的手機號碼";
        }


        if (isPass) {
            // "沒有外觀" 的表單
            const fd = new FormData(document.form1);

            fetch('edit-api.php', {
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


    }

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
</script>
<?php include __DIR__ . '/parts/html-foot.php'  ?>