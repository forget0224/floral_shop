<?php require '../parts/db_connect.php';
$pageName = 'productlist';
$title = "商品列表";

$rows = [];

// $perPage = 20; //幾筆資料
// $totalPages = ceil($totalRows / $perPage); //總頁數
// $totalPages = 0; # 預設值

// if ($totalRows > 0) {
//     $totalPages = ceil($totalRows / $perPage); # 計算總頁數

//     if ($page > $totalPages) {
//         // redirect
//         header('Location: ?page=' . $totalPages);
//         exit;
//     }
// }
// 執行顏色查詢

$sql = sprintf(
    "SELECT 
        custom_product_list.*,
        product_name, 
        GROUP_CONCAT(custom_product_list.product_color) AS colors,
        GROUP_CONCAT(custom_product_list.sid) AS sids,
        GROUP_CONCAT(custom_product_list.product_stock) AS stocks,
        custom_stock_status.stock_name AS stock,
        store.store_name AS store,
        GROUP_CONCAT(custom_product_list.product_price) AS prices
    FROM 
        custom_product_list
    LEFT JOIN 
        color_list ON custom_product_list.product_color = color_list.color_list_id
    LEFT JOIN
        custom_stock_status ON custom_product_list.product_stock = custom_stock_status.stock_id
    LEFT JOIN
        store ON custom_product_list.store_id = store.store_id
    LEFT JOIN
        custom_products ON custom_product_list.product_id = custom_products.product_id
    GROUP BY
        custom_product_list.product_id,  store"
);
// $stmt = $pdo->query($sql);
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();







$sql_color = "SELECT color_list.* FROM color_list";
$stmt_color = $pdo->query($sql_color);
$rows_color = $stmt_color->fetchAll(PDO::FETCH_ASSOC);

$colorListQueryResult = [];

foreach ($rows_color as $row) {
    $colorListQueryResult[] = [
        'color_list_id' => $row['color_list_id'],
        'color_name' => $row['color_name'],
        'color_english' => $row['color_english'],
    ];
}



$colorJson = json_encode($colorListQueryResult);
$colorsOptions = fetchColorOptions();


$storesOptions = fetchStoresOptions();


$productsOptions = fetchProductsOptions();


function fetchColorOptions()
{
    global $pdo;

    $sql = "SELECT color_list_id, color_name FROM color_list WHERE color_list_id IN (SELECT DISTINCT product_color FROM custom_product_list)";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function fetchStoresOptions()
{
    global $pdo;

    $sql = "SELECT store_id, store_name FROM store WHERE store_id IN (SELECT DISTINCT store_id FROM custom_product_list)";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function fetchProductsOptions()
{
    global $pdo;

    $sql = "SELECT product_id, product_name FROM custom_products WHERE product_id IN (SELECT DISTINCT product_id FROM custom_product_list)";
    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>
<?php include '../parts/html-head.php' ?>

<style>
    p {
        font-size: 14px;
        margin-bottom: 0;
    }

    .color-circles {
        display: flex;
    }

    .color-circle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 5px;
        border: 1px solid black;
    }

    .product_img_box {

        width: 250px;
        height: 165px;
    }

    .bg-red {
        background-color: red;
    }

    .bg-orange {
        background-color: orange;
    }

    .bg-yellow {
        background-color: yellow;
    }

    .bg-green {
        background-color: green;
    }

    .bg-blue {
        background-color: blue;
    }

    .bg-purple {
        background-color: purple;
    }

    .bg-pink {
        background-color: pink;
    }

    .bg-brown {
        background-color: brown;
    }

    .bg-grey {
        background-color: grey;
    }

    .bg-black {
        background-color: black;
    }

    .bg-white {
        background-color: white;
    }

    .bg-other {
        background-color: bisque;
    }

    .color-circle.active {
        border: 2px solid #007bff;

    }

    #searchContainer {
        display: flex;
        align-items: center;
        overflow: hidden;
        width: 0;
        transition: width 1s;
    }

    #searchContainer.active {
        width: 200px;
    }

    #searchIcon {
        cursor: pointer;
    }

    .searchInputContainer {
        flex: 1;
        margin-left: 8px;
        opacity: 0;
        transition: opacity 1s;
    }

    #searchContainer.active .searchInputContainer {
        opacity: 1;
    }

    #filterSection h6 {
        border-bottom: 0.1rem solid #858796 !important
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


                    <div class="card shadow mb-4 dataTables_wrapper dt-bootstrap4 " id="dataTable_wrapper">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">商品列表</h6>
                            <div class="d-flex">

                                <div id="searchContainer" class="dataTables_search px-3">
                                    <span class="icon text-black-50">
                                        <i id="searchIcon" class="fas fa-search text-black-50"></i>
                                    </span>
                                    <div class="searchInputContainer">
                                        <input type="search" class="form-control form-control-sm" placeholder="Search"
                                            id="searchInput" aria-controls="productTable">
                                    </div>
                                </div>




                                <div class="btn ml-2" id="openFilterBtn" data-toggle="modal" data-target="#filterModal">
                                    <span class="icon text-black-50">
                                        <i class="fas fa-light fa-filter"></i>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <div class="row">


                            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog"
                                aria-labelledby="filterModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="filterModalLabel">篩選</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="filterSection">
                                            <div class="row mt-3">
                                                <div class="col-sm-12 col-md-4">
                                                    <h6 class="border-bottom-secondary">顏色</h6>

                                                    <?php
                                                    foreach ($colorsOptions as $color) {
                                                        $colorName = htmlspecialchars($color['color_name']);
                                                        echo '<input type="checkbox" name="color_filter[]" data-color-id="' . $color['color_list_id'] . '" value="' . $colorName . '"> ' . $colorName . '<br>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <h6 class="border-bottom-secondary">店家</h6>

                                                    <?php
                                                    foreach ($storesOptions as $store) {
                                                        $storeName = htmlspecialchars($store['store_name']);
                                                        echo '<input type="checkbox" name="store_filter[]" data-store-id="' . $store['store_id'] . '" value="' . $storeName . '"> ' . $storeName . '<br>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <h6 class="border-bottom-secondary">商品</h6>

                                                    <?php
                                                    foreach ($productsOptions as $product) {
                                                        $productName = htmlspecialchars($product['product_name']);
                                                        echo '<input type="checkbox" name="product_filter[]" data-product-id="' . $product['product_id'] . '" value="' . $productName . '"> ' . $productName . '<br>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-primary" id="completeFilterBtn"
                                                data-dismiss="modal">完成</button>

                                            <button type="button" class="btn btn-secondary"
                                                id="cancelFilterBtn">全部取消</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">



                                <div class="row" id="productTable">




                                    <?php foreach ($rows as $r): ?>
                                        <div class="col-12 col-md-6 col-xl-3 cardBox" data-store-id=<?= $r['store_id'] ?>
                                            data-product-id=<?= $r['product_id'] ?>>
                                            <div class="shadow mb-4 card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">
                                                        <?= $r['store'] ?>
                                                    </h6>
                                                    <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                            aria-labelledby="dropdownMenuLink">
                                                            <div class="dropdown-header">選單標題</div>
                                                            <a class="dropdown-item editProduct" href="javascript:;">編輯</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item deleteProduct"
                                                                href="javascript:;">刪除</a>
                                                            <!-- <a class="dropdown-item" href="#">其他操作</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="product_img_box overflow-hidden">
                                                        <!-- <img src="/floral_shop/img/slide2.jpg" alt="" class="w-100"> -->
                                                        <img src="<?= !empty($r['products_url']) ? htmlspecialchars($r['products_url']) : 'img/placehold.png' ?>"
                                                            alt="" class="img-fluid object-fit-cover product_img">

                                                    </div>

                                                    <div class="my-2">
                                                        <h7 class="product-name">
                                                            <?= $r['product_name'] ?>
                                                        </h7>
                                                        <div class="my-2">
                                                            <h7>商品顏色</h7>
                                                            <div class="color-circles">
                                                                <?php
                                                                $colors = explode(',', $r['colors']);
                                                                $prices = explode(',', $r['prices']);
                                                                $sids = explode(',', $r['sids']);
                                                                $stocks = explode(',', $r['stocks']);


                                                                $colorMap = json_decode($colorJson, true);

                                                                foreach ($colors as $key => $colorIndex):

                                                                    $colorName = isset($colorMap[$colorIndex - 1]['color_english']) ? $colorMap[$colorIndex - 1]['color_english'] : 'Unknown Color';
                                                                    ?>
                                                                    <div class="color-circle bg-<?= strtolower(trim($colorName)) ?> <?= $key === 0 ? 'active' : '' ?>"
                                                                        data-price="<?= $prices[$key] ?>"
                                                                        data-sid="<?= $sids[$key] ?>"
                                                                        data-color="<?= $colors[$key] ?>"
                                                                        data-stock="<?= $stocks[$key] ?>" role="button">
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>

                                                        <div class="my-2">
                                                            <h7>商品價格</h7>
                                                            <div class="price-display">
                                                                <?= $prices[0] ?>元
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="card-footer text-right stock-display <?= (1 != $r['product_stock']) ? 'bg-warning' : '' ?>">
                                                    <?= $r['stock'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>




                                    <!-- row end  -->
                                </div>



                            </div>
                            <!-- <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">顯示第 1
                                    到 10 總共 21 個</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_full_numbers" id="dataTable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item first disabled" id="dataTable_first"><a
                                                href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                                                class="page-link">&lt;&lt;</a></li>
                                        <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                            <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0"
                                                class="page-link">&lt;</a>
                                        </li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="dataTable" data-dt-idx="2" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                data-dt-idx="3" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                data-dt-idx="4" tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item next" id="dataTable_next"><a href="#"
                                                aria-controls="dataTable" data-dt-idx="5" tabindex="0"
                                                class="page-link">&gt;</a></li>
                                        <li class="paginate_button page-item last" id="dataTable_last"><a href="#"
                                                aria-controls="dataTable" data-dt-idx="6" tabindex="0"
                                                class="page-link">&gt;&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
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

                    $('th[data-column="delete"]').removeClass().addClass("sorting_disabled");

                    $('.color-circle').first().addClass('active');
                    $('.color-circle').click(function () {



                        $(this).closest('.cardBox').find('.color-circle').removeClass('active');
                        $(this).addClass('active');
                        const price = $(this).data('price');
                        const stock = $(this).data('stock');


                        $(this).closest('.cardBox').find('.price-display').text(price + '元');
                        $(this).closest('.cardBox').find('.stock-display').text(stock);


                        if (stock != 1) {
                            $(this).closest('.cardBox').find('.stock-display').addClass('bg-warning').text('未上架');
                        } else {
                            $(this).closest('.cardBox').find('.stock-display').removeClass('bg-warning').text('上架中');
                        }
                    });



                    $("#searchInput").on("input", filterProducts);

                });
                $('.deleteProduct').click(function () {
                    deleteProduct(this);
                });
                $('.editProduct').click(function () {
                    editProduct(this);
                });

                let searchResults = []; // 保存搜索結果的變數
                const updateFilters = function () {
                    const selectedColors = getSelectedValues('color_filter[]', 'data-color-id');
                    const selectedStores = getSelectedValues('store_filter[]', 'data-store-id');
                    const selectedProducts = getSelectedValues('product_filter[]', 'data-product-id');

                    // 使用保存的搜索結果進行篩選，如果搜索結果為空，則使用所有的產品卡片
                    const productsToFilter = searchResults.length > 0 ? searchResults : $("#productTable .cardBox");

                    productsToFilter.each(function () {
                        const product = $(this);
                        const storeId = product.attr('data-store-id');
                        const productId = product.attr('data-product-id');
                        const productName = product.find('.product-name').text().toLowerCase();
                        const allCircles = product.find('.color-circle');
                        const isVisible = (
                            (selectedColors.length === 0 || Array.from(allCircles).some(circle => selectedColors.includes(circle.dataset.color.toLowerCase()))) &&
                            (selectedStores.length === 0 || selectedStores.includes(storeId)) &&
                            (selectedProducts.length === 0 || selectedProducts.includes(productId))
                        );

                        product.css('display', isVisible ? 'block' : 'none');
                    });
                };
                const filterProducts = function () {
                    const searchText = $("#searchInput").val().toLowerCase();
                    const productContainer = $("#productTable");
                    const productCards = productContainer.find(".cardBox");

                    productCards.each(function () {
                        const cardContent = $(this).text().toLowerCase();

                        if (cardContent.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    // 更新搜索結果
                    searchResults = productCards.filter(':visible');
                    updateFilters();
                };
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');

                checkboxes.forEach(function (checkbox) {
                    checkbox.addEventListener('change', updateFilters);
                });

                const searchInput = document.getElementById('searchInput');
                searchInput.addEventListener('input', updateFilters);




                // 點擊篩選按鈕，顯示篩選區塊
                const openFilterBtn = document.getElementById('openFilterBtn');
                const filterSection = document.getElementById('filterSection');




                openFilterBtn.addEventListener('click', () => {
                    filterSection.style.display = 'block';
                });


                const completeFilterBtn = document.getElementById('completeFilterBtn');
                completeFilterBtn.addEventListener('click', () => {
                    filterSection.style.display = 'none';
                });

                // 點擊取消按鈕，取消所有:checked
                const cancelFilterBtn = document.getElementById('cancelFilterBtn');
                cancelFilterBtn.addEventListener('click', () => {
                    const checkboxes = document.querySelectorAll('#filterSection input[type="checkbox"]');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    updateFilters();
                });

                function getSelectedValues(checkboxName, dataAttributeName) {
                    const selectedCheckboxes = document.querySelectorAll(`input[name="${checkboxName}"]:checked`);
                    return Array.from(selectedCheckboxes).map(checkbox => checkbox.getAttribute(dataAttributeName));
                }

                // let itemsPerPage = parseInt($('#datatable_length').val()); 
                // let totalItems = 100; 
                // let totalPages = Math.ceil(totalItems / itemsPerPage); 


                // renderPagination(1, totalPages); 


                // $('#datatable_length').on('change', function () {
                //     itemsPerPage = parseInt($(this).val()); 
                //     totalPages = Math.ceil(totalItems / itemsPerPage); 
                //     renderPagination(1, totalPages); 
                // });


                // function renderPagination(currentPage, totalPages) {

                //     $('.pagination').empty();


                //     totalItems = 100; 
                //     totalPages = Math.ceil(totalItems / itemsPerPage);


                //     for (let i = currentPage - 5; i <= currentPage + 5; i++) {
                //         if (i >= 1 && i <= totalPages) {

                //         }
                //     }


                // }
                const handleImageError = (element) => {
                    element.src = 'img/placehold.png';
                };


                $('.product_img').on('error', function () {
                    handleImageError(this);
                });

                function deleteProduct(element) {

                    const cardBox = $(element).closest('.cardBox');

                    const store = cardBox.find('.font-weight-bold').text().trim();
                    const flower = cardBox.find('.product-name').text().trim();
                    const activeColor = cardBox.find('.color-circles .color-circle.active');
                    const colorId = activeColor.data('color');
                    const colorMap = <?= $colorJson ?>;
                    const colorName = colorMap[colorId - 1].color_name;
                    const sid = activeColor.data('sid');
                    const confirmationMessage = `是否要刪除 ${store}:${colorName}${flower}`;
                    if (confirm(`你確定要刪除該店家的這朵花的資料嗎?\n${confirmationMessage}`)) {
                        console.log('confirmmmm')
                        location.href = `productdelete.php?sid=${sid}`;
                    }

                }

                function editProduct(element) {
                    const cardBox = $(element).closest('.cardBox');
                    const store_id = cardBox.data('store-id');
                    const product_id = cardBox.data('product-id');
                    console.log(store_id, product_id)
                    location.href = `product_list_edit.php?store_id=${store_id}&product_id=${product_id}`;
                }
                $("#searchIcon").click(function () {
                    $("#searchContainer").toggleClass("active");
                    if ($("#searchContainer").hasClass("active")) {
                        $("#searchInput").focus();
                    }
                });
            </script>

            <?php include '../parts/html-foot.php' ?>