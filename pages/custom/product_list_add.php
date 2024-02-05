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
                    <div class="card" style="width: 900px;">

                        <div class="card-body">
                            <h5 class="card-title">新增資料</h5>
                            <form name="form1" method="post" onsubmit="sendForm(event)" id="form1">


                                <div class="mb-3">
                                    <label for="store_id" class="form-label">店家</label>
                                    <input list="store_options" name="store_id" id="store_id" class="form-control">
                                    <datalist id="store_options">
                                        <?php


                                        $sql_store = "SELECT * FROM store";
                                        $stmt_store = $pdo->query($sql_store);
                                        $stores = $stmt_store->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($stores as $store) {
                                            echo "<option value=\"{$store['store_id']}-{$store['store_name']}\"></option>";
                                        }
                                        ?>
                                    </datalist>
                                    <div class="form-text"></div>


                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">商品名稱</label>
                                        <select class="form-control" name="product_id[]" id="product_id">

                                            <option value="0" selected disabled>請選擇商品名稱</option>

                                            <?php

                                            $sql_option = "SELECT * FROM custom_products";
                                            $stmt_option = $pdo->query($sql_option); // Use $sql_option instead of $sql
                                            $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result_option as $row) {
                                                $product_id = $row['product_id']; // Replace 'color_list_id' with your actual column name
                                                $product_name = $row['product_name']; // Replace 'color_name' with your actual column name
                                                echo "<option value=\"$product_id\">$product_name</option>";
                                            }
                                            ?>
                                        </select>


                                    </div>


                                </div>



                                <div class="mb-3">
                                    <label for="products_url" class="form-label">圖片url</label>
                                    <input type="text" class="form-control" id="products_url" name="products_url">
                                    <div class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <img src="img/placehold.png" alt="" class="w-50 product_img"
                                        onerror="handleImageError()">
                                </div>



                                <div class="mb-3">


                                    <div class="color-group" id="colorGroup">


                                        <div class="form-group color-item row">

                                            <div class="col-sm-12 col-md-4 color-box">
                                                <label for="product_color" class="form-label">顏色</label>
                                                <select class="form-control" name="product_color[]" id="product_color">

                                                    <option value="0" selected disabled>請選擇顏色</option>

                                                    <?php

                                                    $sql_option = "SELECT * FROM color_list";
                                                    $stmt_option = $pdo->query($sql_option);
                                                    $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_option as $row) {
                                                        $color_list_id = $row['color_list_id'];
                                                        $color_name = $row['color_name'];
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
                                                    foreach ($result_option as $row) {
                                                        $stock_id = $row['stock_id'];
                                                        $stock_name = $row['stock_name'];
                                                        echo "<option value=\"$stock_id\">$stock_name</option>";
                                                    }
                                                    ?>

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
                    <a type="button" class="btn btn-secondary" href="product_list_add.php">繼續新增</a>
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

            productImage.src = 'img/placehold.png';
        };
        const minStoreId = <?= $minStoreId ?>;
        const maxStoreId = <?= $maxStoreId ?>;



        $.validator.addMethod("checkStoreId", function (value, element) {
            var storeId = parseFloat(value);
            return storeId >= minStoreId && storeId <= maxStoreId;
        }, "請輸入有效的店家編號");

        $.validator.addMethod("notZero", function (value, element) {
            return parseFloat(value) !== 0;
        }, "請選擇不為 0 的數值");




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






        const sendForm = e => {

            const formData = {
                product_id: $('#product_id').val(),
                products_url: $('#products_url').val(),
                store_id: parseInt($('#store_id').val().match(/\d+/)?.[0] || null),
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


            console.log(formData)

            const fd = new FormData(document.form1);




            for (let index = 0; index < maxLength; index++) {
                fd.append(`product_id[${index}]`, formData.product_id[index]);
                fd.append(`store_id[${index}]`, formData.store_id[index]);
                fd.append(`products_url[${index}]`, formData.products_url[index]);
                fd.append(`product_color[${index}]`, formData.product_color[index]);
                fd.append(`product_price[${index}]`, formData.product_price[index]);
                fd.append(`product_stock[${index}]`, formData.product_stock[index]);
            }




            fetch('product_list_add-api.php', {
                method: 'POST',
                body: fd,
            })
                .then(r => r.json())
                .then(result => {
                    console.log({ result });
                    if (result.success) {
                        myModal.show();
                    }
                })
                .catch(ex => console.log(ex));


        }

        const myModal = new bootstrap.Modal(document.getElementById('exampleModal'))


        document.addEventListener('DOMContentLoaded', function () {

            const addColorButton = document.getElementById('addColor');
            const colorGroup = document.getElementById('colorGroup');

            addColorButton.addEventListener('click', function () {
                createColorItem();
            });

            colorGroup.addEventListener('click', function (e) {
                if (e.target.closest('.removeColor')) {
                    e.preventDefault();

                    const colorItem = e.target.closest('.color-item');
                    if (colorItem) {
                        colorItem.remove();
                    } else {
                        console.error('.color-item not found');
                    }
                }
            });



            function createColorItem() {
                const colorItem = document.createElement('div');
                colorItem.classList.add('form-group', 'color-item', 'row');

                colorItem.innerHTML = `
            <div class="col-sm-12 col-md-4 color-box">
                                                <label for="product_color" class="form-label">顏色</label>
                                                <select class="form-control" name="product_color[]" id="product_color">

                                                    <option value="0" selected disabled>請選擇顏色</option>

                                                    <?php

                                                    $sql_option = "SELECT * FROM color_list";
                                                    $stmt_option = $pdo->query($sql_option); // Use $sql_option instead of $sql
                                                    $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_option as $row) {
                                                        $color_list_id = $row['color_list_id']; // Replace 'color_list_id' with your actual column name
                                                        $color_name = $row['color_name']; // Replace 'color_name' with your actual column name
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
                                                    $stmt_option = $pdo->query($sql_option); // Use $sql_option instead of $sql
                                                    $result_option = $stmt_option->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result_option as $row) {
                                                        $stock_id = $row['stock_id']; // Replace 'color_list_id' with your actual column name
                                                        $stock_name = $row['stock_name']; // Replace 'color_name' with your actual column name
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
        })
    </script>
    <?php include '../parts/html-foot.php' ?>