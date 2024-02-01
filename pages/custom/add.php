<?php require '../parts/db_connect.php';
$pageName = 'add';
$title = '新增';


$sql = "SELECT MIN(member_id) AS min_member_id, MAX(member_id) AS max_member_id,
               MIN(store_id) AS min_store_id, MAX(store_id) AS max_store_id
        FROM member, store";

$stmt = $pdo->query($sql);


$result = $stmt->fetch(PDO::FETCH_ASSOC);


if ($result) {
    $minMemberId = $result['min_member_id'];
    $maxMemberId = $result['max_member_id'];
    $minStoreId = $result['min_store_id'];
    $maxStoreId = $result['max_store_id'];
} else {

    $minMemberId = 1;
    $maxMemberId = 100;
    $minStoreId = 1;
    $maxStoreId = 100;
}


?>
<?php include '../parts/html-head.php' ?>



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
                <div class="container">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">新增資料</h5>
                            <form name="form1" method="post" onsubmit="sendForm(event)" id="form1">

                                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">


                                <div class="mb-3">
                                    <label for="order_date" class="form-label">訂購日期</label>
                                    <input type="datetime-local" class="form-control" id="order_date" name="order_date">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="delivery_date" class="form-label">配送日期</label>
                                    <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="member_id" class="form-label">會員資料</label>
                                    <input type="text" class="form-control" id="member_id" name="member_id">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="store_id" class="form-label">店家資料</label>
                                    <input type="text" class="form-control" id="store_id" name="store_id">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient_address" class="form-label">收件地址</label>
                                    <textarea class="form-control" name="recipient_address" id="recipient_address"
                                        cols="30" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">付款方式</label>
                                    <select id="payment_method" name="payment_method">
                                        <option value="1">刷卡</option>
                                        <option value="2">LINEPAY</option>
                                        <option value="3">現金</option>
                                    </select>



                                    <div class="form-text"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">新增</button>
                            </form>

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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">新增結果</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        新增成功
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="add.php">繼續新增</a>
                    <a type="button" class="btn btn-primary" href="list.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../parts/scripts.php' ?>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.20.0/jquery.validate.min.js"></script>

    <style>
        label.error {
            font-size: 16px;
            color: red;
        }
    </style>

    <script>
        const minMemberId = <?= $minMemberId ?>;
        const maxMemberId = <?= $maxMemberId ?>;
        const minStoreId = <?= $minStoreId ?>;
        const maxStoreId = <?= $maxStoreId ?>;

        $.validator.addMethod("checkMemberId", function (value, element) {
            var memberId = parseFloat(value);
            return memberId >= minMemberId && memberId <= maxMemberId;
        }, "請輸入有效的會員編號");

        $.validator.addMethod("checkStoreId", function (value, element) {
            var storeId = parseFloat(value);
            return storeId >= minStoreId && storeId <= maxStoreId;
        }, "請輸入有效的店家編號");

        $.validator.addMethod("notZero", function (value, element) {
            return parseFloat(value) !== 0;
        }, "請選擇不為 0 的數值");
        $("#form1").validate({
            rules: {
                order_date: "required",
                delivery_date: "required",
                member_id: {
                    required: true,
                    number: true,
                    notZero: true,
                    checkMemberId: true
                },
                store_id: {
                    required: true,
                    number: true,
                    notZero: true,
                    checkStoreId: true
                },
                recipient_address: {
                    required: true,
                    maxlength: 30
                },
                payment_method: {
                    required: "#payment_method:selected"
                },
            },
            messages: {
                order_date: {
                    required: '請輸入訂購日期',
                },
                delivery_date: {
                    required: "請輸入配送日期"
                },
                member_id: {
                    required: "請輸入會員編號",
                    number: '會員編號需為數字',
                    notZero: '請輸入不為0的數字'
                },
                store_id: {
                    required: "請輸入店家編號",
                    number: '店家編號需為數字',
                    notZero: '請輸入不為0的數字'

                },
                recipient_address: {
                    required: "請輸入地址",
                    maxlength: '最多輸入五十個字元'
                },
                payment_method: {
                    required: "請輸入付款方式"
                },
            }
        });






        const sendForm = e => {
            e.preventDefault();
            let isPass = true; // 表單有沒有通過檢查
            // 補驗證
            if ($("#form1").valid()) {
                // "沒有外觀" 的表單
                const fd = new FormData(document.form1);

                fetch('add-api.php', {
                    method: 'POST',
                    body: fd,
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
    <?php include '../parts/html-foot.php' ?>