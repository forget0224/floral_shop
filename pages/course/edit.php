<?php require '../parts/db_connect.php';
$pageName = 'edit';
$title = '編輯課程';

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$sql = "SELECT * FROM course WHERE course_id=$course_id";

$row = $pdo->query($sql)->fetch();

if (empty($row)) {
  header('Location: list.php');
  exit; # 結束 php 程式
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">編輯課程</h1>
                    <p class="mb-4">請編輯您的課程資料</p>

                    <!-- 新增資料的卡片 -->
                    <div class="card_container d-flex justify-content-center">
                        <div class="card shadow mb-4 px-0 col-6">
                            <div class="card-body">
                            <h5 class="card-title">編輯資料</h5>
                                <form name="form1" method="post" onsubmit="sendForm(event)">
                                    <div class="mb-3">
                                    <label class="form-label">#</label>
                                    <input type="text" class="form-control" disabled value="<?= $row['course_id'] ?>">
                                    </div>
                                    <input type="hidden" name="course_id" value="<?= $row['course_id'] ?>">
                                    <div class="mb-3">
                                    <label for="name" class="form-label">課程名稱</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="intro" class="form-label">課程介紹</label>
                                    <textarea class="form-control" id="intro" name="intro" rows="5"><?= $row['intro'] ?></textarea>
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="location" class="form-label">上課地點</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?= $row['location'] ?>">
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="price" class="form-label">課程定價</label>
                                    <input type="number" class="form-control" id="price" name="price" step="100" min="0" max="30000" value="<?= $row['price'] ?>">
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="min_capacity" class="form-label">最小開課人數</label>
                                    <input type="number" class="form-control" id="min_capacity" name="min_capacity" value="<?= $row['min_capacity'] ?>">
                                    <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="max_capacity" class="form-label">最大開課人數</label>
                                    <input type="number" class="form-control" id="max_capacity" name="max_capacity" value="<?= $row['max_capacity'] ?>">
                                    <div class="form-text"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">修改</button>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
    
    <?php include '../parts/scripts.php' ?>

    <script>
    const sendForm = e => {
        e.preventDefault();

        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查

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

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    </script>
    
    <?php include '../parts/html-foot.php' ?>