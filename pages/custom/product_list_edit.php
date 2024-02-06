<?php require '../parts/db_connect.php';
$pageName = 'product_edit';
$title = '修改商品';


// $sql = "SELECT MIN(member_id) AS min_member_id, MAX(member_id) AS max_member_id,
//                MIN(store_id) AS min_store_id, MAX(store_id) AS max_store_id
//         FROM member, store";

// $stmt = $pdo->query($sql);


// $result = $stmt->fetch(PDO::FETCH_ASSOC);


// if ($result) {
//     $minMemberId = $result['min_member_id'];
//     $maxMemberId = $result['max_member_id'];
//     $minStoreId = $result['min_store_id'];
//     $maxStoreId = $result['max_store_id'];
// } else {

//     $minMemberId = 1;
//     $maxMemberId = 100;
//     $minStoreId = 1;
//     $maxStoreId = 100;
// }



$store_id = isset($_GET['store_id']) ? $_GET['store_id'] : '';
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';

$sql = "SELECT custom_product_list.*, color_list.*, custom_stock_status.*, store.store_name, custom_products.product_name 
FROM custom_product_list 
LEFT JOIN color_list ON custom_product_list.product_color = color_list.color_list_id 
LEFT JOIN custom_stock_status ON custom_product_list.product_stock = custom_stock_status.stock_id 
LEFT JOIN store ON custom_product_list.store_id = store.store_id 
LEFT JOIN custom_products ON custom_product_list.product_id = custom_products.product_id 
WHERE custom_product_list.store_id = :store_id AND custom_product_list.product_id = :product_id;
";
$stmt = $pdo->prepare($sql);
$stmt->execute([':store_id' => $store_id, ':product_id' => $product_id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql_colors = "SELECT * FROM color_list";
$stmt_colors = $pdo->query($sql_colors);
$colors_options = $stmt_colors->fetchAll(PDO::FETCH_ASSOC);


$sql_stock_status = "SELECT * FROM custom_stock_status";
$stmt_stock_status = $pdo->query($sql_stock_status);
$stock_status_options = $stmt_stock_status->fetchAll(PDO::FETCH_ASSOC);
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
                    <div class="card" style="width: 900px;">
                        <div class="card-body">
                            <h5 class="card-title">修改資料</h5>
                            <form name="form1" method="post" id="form1">
                                <div class="mb-3">
                                    <label for="store_id" class="form-label">店家</label>
                                    <input name="store_id" class="form-control"
                                        value="<?= !empty($results) ? $results[0]['store_id'] . '-' . $results[0]['store_name'] : '' ?>"
                                        disabled>
                                    <input type="hidden" name="store_id" id="store_id" value="<?= $store_id ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="product_id" class="form-label">商品名稱</label>
                                    <input name="product_id" class="form-control"
                                        value="<?= !empty($results) ? $results[0]['product_name'] : '' ?>" disabled>
                                    <input type="hidden" name="product_id" id="product_id" value="<?= $product_id ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="products_url" class="form-label">圖片url</label>
                                    <input type="text" class="form-control" id="products_url" name="products_url"
                                        value="<?= htmlentities($results[0]['products_url']) ?>">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <img src="<?= htmlentities($results[0]['products_url']) ?>" alt=""
                                        class="w-50 product_img" onerror="handleImageError()">
                                </div>
                                <div class="mb-3">
                                    <div class="color-group" id="colorGroup">
                                        <?php foreach ($results as $result): ?>
                                            <div class="form-group color-item row" data-sid="<?= $result['sid'] ?>">
                                                <div class="col-sm-1 col-md-4 color-box">
                                                    <label class="form-label" for="colors">顏色</label>
                                                    <select class="form-control" name="product_color[]">
                                                        <?php foreach ($colors_options as $color_option): ?>
                                                            <option value="<?= $color_option['color_list_id'] ?>"
                                                                <?= ($color_option['color_list_id'] == $result['product_color']) ? 'selected' : '' ?>>
                                                                <?= $color_option['color_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-1 col-md-3 color-box">
                                                    <label class="form-label" for="prices">價格</label>
                                                    <input type="number" class="form-control" name="product_price[]" min="1"
                                                        value="<?= $result['product_price'] ?>">
                                                </div>

                                                <div class="col-sm-1 col-md-4 color-box">
                                                    <label class="form-label" for="stocks">上架狀態</label>
                                                    <select class="form-control" name="product_stock[]">
                                                        <?php foreach ($stock_status_options as $stock_option): ?>
                                                            <option value="<?= $stock_option['stock_id'] ?>"
                                                                <?= ($stock_option['stock_id'] == $result['product_stock']) ? 'selected' : '' ?>>
                                                                <?= $stock_option['stock_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-1">
                                                    <button type="button" class="btn btn-danger btn-icon-split removeColor">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>


                                    </div>
                                    <div style="width:800px;">
                                        <a href="javascript:;" class="btn btn-info " id="addColor">
                                            <span class="">
                                                <i class="fa-solid fa-circle-plus"></i>
                                            </span>
                                            <span class="text">新增顏色</span>
                                        </a>
                                    </div>
                                </div>

                                <style>
                                    #addColor {
                                        border: #36b9cc 2px dashed;
                                        background: transparent;
                                        color: #36b9cc;
                                        display: block;
                                        width: 600px;
                                        margin: 0 auto;
                                    }

                                    .color-box {
                                        display: flex;
                                        align-items: center;
                                        text-align: center;
                                    }

                                    .color-box label {
                                        margin: 0;
                                        width: 60px;
                                    }

                                    .color-box:nth-child(3) label {
                                        margin: 0;
                                        width: 120px;
                                    }
                                </style>

                                <button type="submit" class="btn btn-primary">修改</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">修改結果</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success logMessage" role="alert">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">繼續修改</button>
                    <a type="button" class="btn btn-primary" href="product_list.php">到列表頁</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../parts/scripts.php' ?>

    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.20.0/jquery.validate.min.js"></script> -->

    <style>
        label.error {
            font-size: 16px;
            color: red;
        }
    </style>

    <script>

        const productsUrlInput = document.getElementsByName('products_url')[0];
        const productImage = document.querySelector('.product_img');


        productsUrlInput.addEventListener('input', () => {

            productImage.src = productsUrlInput.value;
        });


        const handleImageError = () => {
            // 圖片載入錯誤時，設置為預設的圖片
            productImage.src = 'img/placehold.png';
        };
        // const minStoreId = < ? = $minStoreId ? > ;
        // const maxStoreId = < ? = $maxStoreId ? > ;



        // $.validator.addMethod("checkStoreId", function (value, element) {
        //     var storeId = parseFloat(value);
        //     return storeId >= minStoreId && storeId <= maxStoreId;
        // }, "請輸入有效的店家編號");

        // $.validator.addMethod("notZero", function (value, element) {
        //     return parseFloat(value) !== 0;
        // }, "請選擇不為 0 的數值");




        //products_url  product_color  product_price  product_stock
        // $("#form1").validate({
        //     rules: {
        //         product_color: "required",
        //         product_price: { required: true, number: true, notZero: true, },
        //         product_stock: {
        //             required: true,

        //         },
        //         store_id: {
        //             required: true,
        //             // number: true,
        //             notZero: true,
        //             checkStoreId: true
        //         },

        //         payment_method: {
        //             required: "#payment_method:selected"
        //         },
        //     },
        //     messages: {
        //         product_color: {
        //             required: '請選擇顏色',
        //         },
        //         product_price: {
        //             required: "請輸入價格",
        //             maxlength: '最多輸入4位數'
        //         },

        //         store_id: {
        //             required: "請輸入店家編號",
        //             number: '店家編號需為數字',
        //             notZero: '請輸入不為0的數字'

        //         },

        //         payment_method: {
        //             required: "請輸入付款方式"
        //         },
        //     }
        // });








        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))

        function createColorItem() {
            const colorItem = document.createElement('div');
            colorItem.classList.add('form-group', 'color-item', 'row');
            colorItem.setAttribute('data-sid', '')
            colorItem.innerHTML = `
            <div class="col-sm-12 col-md-4 color-box">
                                                <label for="product_color" class="form-label">顏色</label>
                                                <select class="form-control" name="product_color[]" id="product_color">

                                                    <option value="0" selected disabled>請選擇顏色</option>

                                                    <?php

                                                    $sql_option = "SELECT * FROM color_list";
                                                    $stmt_option = $pdo->query($sql_option);
                                                    $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_option as $results) {
                                                        $color_list_id = $results['color_list_id'];
                                                        $color_name = $results['color_name'];
                                                        echo "<option value=\"$color_list_id\">$color_name</option>";
                                                    }
                                                    ?>
                                                </select>


                                            </div>
                                            <div class="col-sm-12 col-md-3 color-box">
                                                <label class="form-label" for="product_price">價格</label>
                                                <input type="number" class="product_price form-control"
                                                    name="product_price[]" min="1">
                                            </div>
                                            <div class="col-sm-12 col-md-4 color-box">
                                                <label class="form-label" for="product_stock">上架狀態</label>
                                                <select class="form-control" name="product_stock[]" id="product_stock">
                                                    <option value="0" selected disabled>請選擇上架狀態</option>

                                                    <?php

                                                    $sql_option = "SELECT * FROM custom_stock_status";
                                                    $stmt_option = $pdo->query($sql_option);
                                                    $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_option as $results) {
                                                        $stock_id = $results['stock_id'];
                                                        $stock_name = $results['stock_name'];
                                                        echo "<option value=\"$stock_id\">$stock_name</option>";
                                                    }
                                                    ?>

                                                </select>




                                            </div>
                                            <div class="col-sm-12 col-md-1 ">
    <button type="button" class="btn btn-danger btn-icon-split removeColor">
        <span class="icon text-white-50 ">
            <i class="fas fa-trash"></i>
        </span>
    </button>
</div>
        `;

            colorGroup.appendChild(colorItem);
        }



        document.addEventListener('DOMContentLoaded', function () {
            const addColorButton = document.getElementById('addColor');
            const colorGroup = document.getElementById('colorGroup');
            const deleteList = [];

            addColorButton.addEventListener('click', function () {
                createColorItem();
            });

            colorGroup.addEventListener('click', function (e) {
                if (e.target.closest('.removeColor')) {
                    e.preventDefault();

                    const colorItem = e.target.closest('.color-item');
                    if (colorItem) {
                        const dataSid = colorItem.dataset.sid;


                        if (dataSid !== "") {
                            deleteList.push(dataSid);
                        }

                        colorItem.remove();
                        console.log(deleteList);
                    } else {
                        console.error('.color-item not found');
                    }
                }
            });

            const sendForm = e => {
                const formData = {
                    product_id: $('#product_id').val(),
                    products_url: $('#products_url').val(),
                    store_id: $('#store_id').val(),
                    product_color: $('select[name="product_color[]"]').map(function () {
                        return $(this).val();
                    }).get(),
                    product_price: $('input[name="product_price[]"]').map(function () {
                        return $(this).val();
                    }).get(),
                    product_stock: $('select[name="product_stock[]"]').map(function () {
                        return $(this).val();
                    }).get()
                };

                const maxLength = formData.product_color.length;

                e.preventDefault();

                formData.product_id = Array(maxLength).fill(formData.product_id);
                formData.store_id = Array(maxLength).fill(formData.store_id);
                formData.products_url = Array(maxLength).fill(formData.products_url);

                const fd = new FormData(document.form1);

                $('.form-group').each(function () {
                    const sid = $(this).data('sid');
                    fd.append('sid[]', sid);
                });


                deleteList.forEach(sid => {
                    fd.append('deleteList[]', sid);
                });


                for (let index = 0; index < maxLength; index++) {
                    fd.append(`product_id[${index}]`, formData.product_id[index]);
                    fd.append(`store_id[${index}]`, formData.store_id[index]);
                    fd.append(`products_url[${index}]`, formData.products_url[index]);
                    fd.append(`product_color[${index}]`, formData.product_color[index]);
                    fd.append(`product_price[${index}]`, formData.product_price[index]);
                    fd.append(`product_stock[${index}]`, formData.product_stock[index]);
                }

                console.log(fd);

                fetch('product_list_edit-api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(r => r.json())
                    .then(result => {
                        console.log({ result });
                        if (result.success) {
                            populateModalBody(result.logMessages);

                            myModal.show();
                        }
                    })
                    .catch(ex => console.log(ex));
            };

            document.form1.addEventListener('submit', sendForm);
        });



        function populateModalBody(logMessages) {

            const modalBody = document.querySelector('.logMessage');


            modalBody.innerHTML = '';


            const ul = document.createElement('ul');


            if (logMessages && logMessages.length > 0) {
                logMessages.forEach(message => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    ul.appendChild(li);
                });
            } else {

                const li = document.createElement('li');
                li.textContent = '沒有任何變更。';
                ul.appendChild(li);
            }

            modalBody.appendChild(ul);
        }




    </script>
    <?php include '../parts/html-foot.php' ?>