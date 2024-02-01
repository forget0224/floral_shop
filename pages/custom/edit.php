<?php require '../parts/db_connect.php';
$pageName = 'edit';
$title = '編輯';

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$sql_orders = "SELECT * FROM custom_orders WHERE order_id = :order_id";
$stmt_orders = $pdo->prepare($sql_orders);
$stmt_orders->bindParam(':order_id', $order_id, PDO::PARAM_STR);
$stmt_orders->execute();
$row = $stmt_orders->fetch(PDO::FETCH_ASSOC);

if (empty($row)) {
    header('Location: list.php');
    exit;
}

$sql_numRange = "SELECT MIN(member_id) AS min_member_id, MAX(member_id) AS max_member_id,
               MIN(store_id) AS min_store_id, MAX(store_id) AS max_store_id
        FROM member, store";

$stmt_numRange = $pdo->query($sql_numRange);


$result = $stmt_numRange->fetch(PDO::FETCH_ASSOC);


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



// function write_to_console($data)
// {

//     $console = 'console.log(' . json_encode($data) . ');';
//     $console = sprintf('<script>%s</script>', $console);
//     echo $console;
// }

// write_to_console($row);
// write_to_console($order_id);

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
                            <h5 class="card-title">編輯資料</h5>
                            <form name="form1" method="post" onsubmit="sendForm(event)" id="form1">
                                <div class="mb-3">
                                    <label class="form-label" for="order_id">訂單編號</label>
                                    <input type="text" class="form-control" id="order_id" disabled name="order_id"
                                        value="<?= $row['order_id'] ?>">
                                </div>
                                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">

                                <div class="mb-3">
                                    <label for="order_date" class="form-label">訂購日期</label>
                                    <input type="datetime" class="form-control" id="order_date" name="order_date"
                                        value="<?= $row['order_date'] ?>" disabled>
                                </div>
                                <input type="hidden" name="order_date" value="<?= $row['order_date'] ?>">
                                <div class="mb-3">
                                    <label for="delivery_date" class="form-label">配送日期</label>
                                    <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                                        value="<?= $row['delivery_date'] ?>">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="member_id" class="form-label">會員資料</label>
                                    <input type="text" class="form-control" id="member_id" name="member_id"
                                        value="<?= $row['member_id'] ?>">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="store_id" class="form-label">店家資料</label>
                                    <input type="text" class="form-control" id="store_id" name="store_id"
                                        value="<?= $row['store_id'] ?>">
                                    <div class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient_address" class="form-label">收件地址</label>
                                    <textarea class="form-control" name="recipient_address" id="recipient_address"
                                        cols="30" rows="3"><?= $row['recipient_address'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">付款方式</label>
                                    <select id="payment_method" name="payment_method">
                                        <option value="1" <?php echo ($row['payment_method'] == 1) ? 'selected' : ''; ?>>
                                            信用卡
                                        </option>
                                        <option value="2" <?php echo ($row['payment_method'] == 2) ? 'selected' : ''; ?>>
                                            LINEPAY
                                        </option>
                                        <option value="3" <?php echo ($row['payment_method'] == 3) ? 'selected' : ''; ?>>
                                            現金
                                        </option>
                                    </select>
                                </div>
                                <div class="form-text"></div>
                                <button type="submit" class="btn btn-primary">儲存</button>
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
    <!-- modal -->



    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">編輯結果</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body  alert-success">編輯成功</div>
                <div class="modal-footer">

                    <a class="btn btn-primary" href="list.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">編輯結果</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body  alert-warning">沒有變更</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">繼續編輯</button>
                    <a class="btn btn-primary" href="list.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>





    <?php include '../parts/scripts.php' ?>
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

        let formModified = false;
        const successModal = new bootstrap.Modal(document.getElementById('successModal'))
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'))
        const sendForm = e => {
            e.preventDefault();

            if ($("#form1").valid()) {
                const fd = new FormData(document.form1);
                fetch('edit-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                    .then(result => {
                        console.log({
                            result
                        });
                        if (result.success) {
                            successModal.show();
                        } else if (result.error) {
                            errorModal.show();
                        }
                    })
                    .catch(ex => console.log(ex))
                formModified = true;
            }


        }

        window.addEventListener('beforeunload', (event) => {
            if (!formModified) {
                event.preventDefault();
            }
        });

    </script>
    <?php include '../parts/html-foot.php' ?>