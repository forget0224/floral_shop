<?php require '../parts/db_connect.php';
$pageName = 'list';
$title = "訂單列表";
$rows = [];
$sql = sprintf(
    " SELECT custom_orders.*,payment.payment_method AS payment_name FROM custom_orders LEFT JOIN payment ON custom_orders.payment_method = payment.payment_id"
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
?>
<?php include '../parts/html-head.php' ?>

<style>
    #dataTable_wrapper .row {
        width: 100%;
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
                    <h1 class="h3 mb-2 text-gray-800">代客送花</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">訂單列表</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                                cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th data-column="delete">
                                                            <a href="javascript:deleteSelected()"><i
                                                                    class="fa-solid fa-trash"></i></a>
                                                        </th>
                                                        <th data-column="index">#</th>
                                                        <th data-column="order_id">
                                                            訂單編號
                                                        </th>
                                                        <th data-column="order_date">訂購日期
                                                        </th>
                                                        <th data-column="delivery_date">配送日期 </th>

                                                        <th data-column="member_id">會員
                                                        </th>
                                                        <th data-column="store_id">店家
                                                        </th>
                                                        <th data-column="recipient_address">收件地址 </th>
                                                        <th data-column="payment_name">付款方式 </th>
                                                        <th data-column="edit"><i class="fa-solid fa-file-pen"></i></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach ($rows as $index => $r): ?>
                                                        <tr>


                                                            <td>
                                                                <input type="checkbox" class="deleteCheckbox"
                                                                    data-sid="<?= $r['sid'] ?>"
                                                                    data-order-id="<?= $r['order_id'] ?>" />
                                                            </td>
                                                            <td data-column="index">
                                                                <?= $index + 1 ?>

                                                            </td>

                                                            <td data-column="order_id">
                                                                <?= $r['order_id'] ?>

                                                            </td>
                                                            <td data-column="order_date">
                                                                <?= $r['order_date'] ?>
                                                            </td>
                                                            <td data-column="delivery_date">
                                                                <?= $r['delivery_date'] ?>
                                                            </td>
                                                            <td data-column="member_id">
                                                                <?= $r['member_id'] ?>
                                                            </td>
                                                            <td data-column="store_id">
                                                                <?= $r['store_id'] ?>
                                                            </td>
                                                            <td data-column="recipient_address">
                                                                <?= htmlentities($r['recipient_address']) ?>
                                                            </td>
                                                            <td data-column="payment_name">
                                                                <?= $r['payment_name'] ?>
                                                            </td>
                                                            <td><a
                                                                    href="edit.php?order_id=<?= htmlentities($r['order_id']) ?>">
                                                                    <i class="fa-solid fa-file-pen"></i>
                                                                </a></td>
                                                        </tr>
                                                    <?php endforeach ?>





                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>




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
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 9]
                }],
                pagingType: 'full_numbers',
                "language": {

                    "infoFiltered": "(總共有  _MAX_ 個項目)",
                    "searchPlaceholder": "請輸入搜尋內容",
                    "search": "搜尋:",
                    "lengthMenu": "顯示 _MENU_ 個項目",
                    "zeroRecords": "找不到符合的項目",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    },
                    "emptyTable": "沒有資料",
                    "info": "顯示第 _START_ 到 _END_ 總共 _TOTAL_ 個",
                    "infoEmpty": "沒有符合的項目",


                }
            });
            $('th[data-column="delete"]').removeClass().addClass("sorting_disabled");

        });


        function deleteSelected() {
            const checkboxes = document.getElementsByClassName("deleteCheckbox");
            const selectedIds = [];

            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    const sid = checkboxes[i].getAttribute('data-sid');
                    const order_id = checkboxes[i].getAttribute('data-order-id');
                    selectedIds.push({
                        sid,
                        order_id
                    });
                }
            }
            if (selectedIds.length === 0) {
                alert('請先選擇要刪除的項目。');
                return;
            }
            const confirmationMessage = `是否要刪除選中的項目?\n${selectedIds.map(item => `${item.order_id}`).join('\n')}`;
            if (confirm(confirmationMessage)) {
                const queryString = selectedIds.map(item => `sids[]=${item.sid}&order_ids[]=${item.order_id}`).join('&');
                location.href = `delete.php?${queryString}`;
            }
        }
    </script>

    <?php include '../parts/html-foot.php' ?>