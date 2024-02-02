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

    <!-- 成功的Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
            <button type="button" class="btn-close" id="btn-close-success" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-success" role="alert">
            編輯成功
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="continueEditingBtn1" data-bs-dismiss="modal">繼續編輯</button>
            <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
        </div>
        </div>
    </div>
    </div>
    
    <!-- 失敗的Modal -->
    <div class="modal fade" id="failModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
                <button type="button" class="btn-close" id="btn-close-fail" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                沒有更改
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="continueEditingBtn2" data-bs-dismiss="modal">繼續編輯</button>
                <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
            </div>
            </div>
        </div>
    </div>
    
    <?php include '../parts/scripts.php' ?>

    <!-- 編輯表單 -->
    <script>
    const myFailModal = new bootstrap.Modal(document.getElementById('failModal'));
    const mySuccessModal = new bootstrap.Modal(document.getElementById('successModal'));
    
    const {
      name: name_f,
      intro: intro_f,
      location: location_f,
      price: price_f,
      min_capacity: min_f,
      max_capacity: max_f
    } = document.form1;
    
    const sendForm = e => {
        e.preventDefault();
        name_f.style.border = '1px solid #CCC';
        name_f.nextElementSibling.innerHTML = "";
        intro_f.style.border = '1px solid #CCC';
        intro_f.nextElementSibling.innerHTML = "";
        location_f.style.border = '1px solid #CCC';
        location_f.nextElementSibling.innerHTML = "";
        price_f.style.border = '1px solid #CCC';
        price_f.nextElementSibling.innerHTML = "";
        min_f.style.border = '1px solid #CCC';
        min_f.nextElementSibling.innerHTML = "";
        max_f.style.border = '1px solid #CCC';
        max_f.nextElementSibling.innerHTML = "";
        
        // 取得原始資料
        const originalData = {
        name_f: "<?= addslashes($row['name']) ?>",
        intro_f: "<?= addslashes($row['intro']) ?>",
        location_f: "<?= addslashes($row['location']) ?>",
        price_f: <?= $row['price'] ?>,
        min_f: <?= $row['min_capacity'] ?>,
        max_f: <?= $row['max_capacity'] ?>,
        };

        // 取得表單資料
        const formData = {
        name_f: document.form1.name.value,
        intro_f: document.form1.intro.value,
        location_f: document.form1.location.value,
        price_f: parseInt(document.form1.price.value),
        min_f: parseInt(document.form1.min_capacity.value),
        max_f: parseInt(document.form1.max_capacity.value),
        };
        
        // 檢查是否有修改
        const isModified = Object.keys(originalData).some(key => originalData[key] !== formData[key]);
        
        // TODO: 資料送出之前, 要做檢查 (有沒有填寫, 格式對不對)
        let isPass = true; // 表單有沒有通過檢查
        
        // 驗證
        if (name_f.value.length < 2) {
          isPass = false;
          name_f.style.border = '1px solid red';
          name_f.nextElementSibling.innerHTML = "請輸入至少2個字的課程名稱";
        }
        
        if (name_f.value.length > 30) {
          isPass = false;
          name_f.style.border = '1px solid red';
          name_f.nextElementSibling.innerHTML = "課程名稱需小於30字";
        }
        
        if (intro_f.value.length < 2) {
          isPass = false;
          intro_f.style.border = '1px solid red';
          intro_f.nextElementSibling.innerHTML = "請輸入至少2個字的課程介紹";
        }
        
        if (intro_f.value.length > 1000) {
          isPass = false;
          intro_f.style.border = '1px solid red';
          intro_f.nextElementSibling.innerHTML = "課程介紹需小於1000字";
        }
        
        // TODO:之後修改驗證
        if (!location_f.value) {
          isPass = false;
          location_f.style.border = '1px solid red';
          location_f.nextElementSibling.innerHTML = "請輸入上課地點";
        }
        
        if (price_f.value.length < 1) {
          isPass = false;
          price_f.style.border = '1px solid red';
          price_f.nextElementSibling.innerHTML = "請輸入正確的定價";
        }
        
        // 先將 min_f 和 max_f 轉換為整數
        const minVal = parseInt(min_f.value);
        const maxVal = parseInt(max_f.value);

        // TODO: 之後修改驗證
        if (minVal < 1 || isNaN(minVal)) {
            isPass = false;
            min_f.style.border = '1px solid red';
            min_f.nextElementSibling.innerHTML = "請輸入正確的最小開課人數";
        }

        if (maxVal < 1 || isNaN(maxVal)) {
            isPass = false;
            max_f.style.border = '1px solid red';
            max_f.nextElementSibling.innerHTML = "請輸入正確的最大開課人數";
        }

        if (minVal > maxVal) {
            isPass = false;
            max_f.style.border = '1px solid red';
            max_f.nextElementSibling.innerHTML = "最大開課人數需大於最小開課人數";
        }

        if (isPass) {
        // 如果有修改且通過驗證，執行表單送出邏輯
        const fd = new FormData(document.form1);

        fetch('edit-api.php', {
            method: 'POST',
            body: fd, // content-type: multipart/form-data
            })
            .then(r => r.json())
            .then(result => {
            console.log(result);
            if (result.success) {
                // 如果成功，顯示成功的 Modal
                mySuccessModal.show();
            } else {
                // 如果失敗，顯示失敗的 Modal
                myFailModal.show();
                // TODO: 沒有顯示
            }
        })
            .catch(ex => console.log(ex))
        }
    }
    
    document.getElementById('btn-close-success').addEventListener('click', () => {
        window.location.href = 'edit.php?course_id=<?= $course_id ?>';
    });
    
    document.getElementById('btn-close-fail').addEventListener('click', () => {
        window.location.href = 'edit.php?course_id=<?= $course_id ?>';
    });
    document.getElementById('continueEditingBtn1').addEventListener('click', () => {
        window.location.href = 'edit.php?course_id=<?= $course_id ?>';
    });
    document.getElementById('continueEditingBtn2').addEventListener('click', () => {
        window.location.href = 'edit.php?course_id=<?= $course_id ?>';
    });
    
    </script>
    
    <?php include '../parts/html-foot.php' ?>