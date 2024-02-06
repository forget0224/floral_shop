<?php require '../parts/db_connect.php';
$pageName = 'list';
$title = '課程列表';

$perPage = 10;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    // redirect
    header('Location: ?page=1');
    exit;
}

$order = isset($_GET['order']) ? $_GET['order'] : 'desc';

$t_sql = "SELECT COUNT(1) FROM course";

$row = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM);

// print_r($row);
$totalRows = $row[0]; # 取得總筆數
$totalPages = 0; # 預設值
$rows = []; # 預設值
if ($totalRows > 0) {
    $totalPages = ceil($totalRows / $perPage); # 計算總頁數

    if ($page > $totalPages) {
        // redirect
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf("
    SELECT course.*, store.store_name, store.store_address, course_category.category_name
    FROM course
    INNER JOIN store ON course.store_id = store.store_id
    INNER JOIN course_category ON course.category_id = course_category.category_id");

    // 加入排序邏輯
    if (isset($_GET['orderBy'])) {
      $orderField = $_GET['orderBy'];
      $orderType = ($order === 'desc') ? 'DESC' : 'ASC';
      $sql .= " ORDER BY course.$orderField $orderType";
    } else {
      // 若未指定排序條件，預設以 course_id DESC 排序
      $sql .= " ORDER BY course.course_id DESC";
    }

    // 加入 LIMIT 子句
    $sql .= " LIMIT " . (($page - 1) * $perPage) . ", $perPage";
    
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">課程列表</h1>
                    <p class="mb-4">在這個令人心動的課程列表中，融合豐富多元的學習體驗，讓你開啟精彩旅程，挑戰自我，迎接知識的奇妙冒險！</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary d-flex flex-row justify-content-between align-items-center">
                                <!-- Pagination start -->
                                <!-- 最前頁 -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination mb-0">
                                        <li class="page-item">
                                            <a class="page-link" href="?page=1&orderBy=<?= $_GET['orderBy'] ?? 'course_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>">
                                            <i class="fa-solid fa-angles-left"></i>
                                            </a>
                                        </li>
                                        
                                        <!-- 上一頁 -->
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page-1 ?>&orderBy=<?= $_GET['orderBy'] ?? 'course_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>">
                                            <i class="fa-solid fa-angle-left"></i>
                                            </a>
                                        </li>
                                        <!-- 中間頁 -->
                                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                                            if ($i >= 1 and $i <= $totalPages) : ?>
                                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>&orderBy=<?= $_GET['orderBy'] ?? 'course_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>">
                                                <?= $i ?>
                                                </a>
                                            </li>
                                        <?php endif;
                                        endfor; ?>
                                        <!-- 下一頁 -->
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page+1 ?>&orderBy=<?= $_GET['orderBy'] ?? 'course_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>">
                                            <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </li>                                       
                                        
                                        <!-- 最末頁 -->
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $totalPages ?>&orderBy=<?= $_GET['orderBy'] ?? 'course_id' ?>&order=<?= $_GET['order'] ?? 'desc' ?>">
                                            <i class="fa-solid fa-angles-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="d-flex flex-row justify-content-between">
                                    <!-- Topbar Search -->
                                    <div class="d-none d-sm-inline-block form-inline ml-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                        <input type="text" id="courseSearch" name="courseSearch" class="form-control bg-white border small" placeholder="Search for..."
                                            aria-label="Search" aria-describedby="basic-addon2">
                                    </div>
                                    <!-- Dropdown Select -->
                                    <select class="form-select ml-3 mw-100" name="courseFilter" id="courseFilter" aria-label="Default select example">
                                        <option selected value="">請選擇課程分類</option>
                                        <option value="1">花藝基礎課程</option>
                                        <option value="2">植栽相關課程</option>
                                        <option value="3">節慶主題課程</option>
                                        <option value="4">進階商業課程</option>
                                    </select>
                                </div>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="courseTable">
                                <table class="table table-bordered table-striped" id="courseTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><i class="fa-solid fa-trash"></i></th>
                                            <th class="text-nowrap">#
                                                <a href="?page=<?= $page ?>&orderBy=course_id&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'course_id' && isset($_GET['order']) && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                                                <i class="fa <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'course_id' && $_GET['order'] === 'asc') ? 'fa-arrow-up-wide-short' : 'fa-arrow-down-wide-short' ?>"></i>
                                                </a>
                                            </th>
                                            <!-- 檢查排序 -->
                                            <?php # var_dump($_GET); ?>
                                            <th class="text-nowrap">課程名稱</th>
                                            <th class="text-nowrap">課程介紹</th>
                                            <th class="text-nowrap">課程分類</th>
                                            <th class="text-nowrap">商家名稱</th>
                                            <th class="text-nowrap">上課地點</th>
                                            <th class="text-nowrap">課程定價
                                                <a href="?page=<?= $page ?>&orderBy=price&order=<?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'price' && isset($_GET['order']) && $_GET['order'] === 'asc') ? 'desc' : 'asc' ?>">
                                                <i class="fa <?= (isset($_GET['orderBy']) && $_GET['orderBy'] === 'price' && $_GET['order'] === 'asc') ? 'fa-arrow-up-wide-short' : 'fa-arrow-down-wide-short' ?>"></i>
                                                </a>
                                            </th>
                                            <th class="text-nowrap">最小人數</th>
                                            <th class="text-nowrap">最大人數</th>
                                            <th><i class="fa-solid fa-file-pen"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rows as $r) : ?>
                                        <tr>
                                        <td>
                                            <a href="javascript: delete_one(<?= $r['course_id'] ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        <td class="numberOrder"><?= $r['course_id'] ?></td>
                                        <td><?= $r['name'] ?></td>
                                        <td class="text-justify"><?= $r['intro'] ?></td>
                                        <td class="text-nowrap"><?= $r['category_name'] ?></td>
                                        <td class="text-left"><?= $r['store_name'] ?></td>
                                        <td class="text-left"><?= $r['location'] ?></td>
                                        <td class="text-left priceOrder"><?= htmlentities($r['price']) ?></td>
                                        <td class="text-left"><?= $r['min_capacity'] ?></td>
                                        <td class="text-left"><?= $r['max_capacity'] ?></td>
                                        <td><a href="edit.php?course_id=<?= $r['course_id'] ?>">
                                            <i class="fa-solid fa-file-pen"></i>
                                            </a></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="h6 text-center">目前資料筆數:<?= $totalRows ?></div>
                            </div>
                            <!-- 結果 -->
                            <div id="searchResult"></div>
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

    <!-- 刪除的Modal -->
    <div class="modal fade" id="deleteSuccess" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">刪除結果</h1>
                    <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">刪除成功</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 刪除的script -->
    <script>
    function delete_one(course_id) {
        if (confirm(`是否要刪除編號為 ${course_id} 的資料?`)) {
        // 使用 jQuery 的 AJAX 進行非同步請求
        $.ajax({
            url: `delete.php?course_id=${course_id}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
            console.log(result);
            if (result.success) {
                // 刪除成功後顯示 Modal
                $('#deleteSuccess').modal('show');
                
                // 刪除成功後，等待一段時間再重新導向
                setTimeout(function() {
                location.href = 'list.php';
                }, 2000);
            } else {
                // 刪除失敗的處理
                console.error('刪除失敗');
            }
            },
            error: function(xhr, status, error) {
            // 錯誤處理
            console.error('AJAX 錯誤:', status, error);
            }
        });
        }
    }
    document.getElementById('btn-close').addEventListener('click', () => {
        window.location.href = 'list.php';
    });
    </script>
    
    <!-- 搜尋框 -->
    <script>
        $(document).ready(function(){
            
            $("#courseSearch").keyup(function(){
                
                let input = $(this).val();
                //alert(input);
                
                if(input != ""){
                    $.ajax({
                        url:"courseSearch.php",
                        method:"POST",
                        data:{input:input},
                        
                        success:function(data){
                            $("#searchResult").html(data);
                            $("#courseTable").css("display","none");
                            $("#searchResult").css("display","block");
                        }
                    });
                }else{
                    $("#courseTable").css("display","block");
                    $("#searchResult").css("display","none");
                }
            })
            
        })
    </script>
    
    <!-- 課程分類 -->
    <script>
    $(document).ready(function(){
        $("#courseFilter").on('change', function(){
            let value = $(this).val();
            // alert(value);
            
            // 檢查選到的值是不是預設值
            if (!value){
                window.location.reload();
            } else {
                // 如果不是預設值
                $.ajax({
                url:"courseFilter.php",
                method:"POST",
                data:'request=' + value,
                beforeSend:function(){
                    $("#searchResult").html("<span>Working...</span>");
                },
                success:function(data){
                    $("#searchResult").html(data);
                    $("#courseTable").css("display","none");
                }
            })
            }
        });
    });
    </script>
    
    <!-- 價格排序 -->
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function(){
           const priceFilterIcon = document.getElementById('priceFilter');
           const priceHeader = document.getElementById('priceHeader');
           
        // 初始排序狀態
        let ascending = true;
        
        priceFilterIcon.addEventListener('click', function(event){
            event.preventDefault();
            
            // 切換箭頭方向
            ascending = !ascending;
            
            if (ascending){
                priceFilterIcon.innerHTML = '<i class="fa-solid fa-arrow-down-wide-short"></i>'
            }else{
                priceFilterIcon.innerHTML = '<i class="fa-solid fa-arrow-up-wide-short"></i>'
            }
            sortTableByPrice(ascending);
            
        });
        function sortTableByPrice(ascending){
            // 在這裡實現根據價格排序的邏輯，可以使用JavaScript的Array.sort()
            const tableBody = document.querySelector('tbody');
            const rows = Array.from(tableBody.getElementsByTagName('tr'));

            rows.sort((a, b) => {
                const priceA = parseFloat(a.getElementsByTagName('td')[7].textContent);
                const priceB = parseFloat(b.getElementsByTagName('td')[7].textContent);

                return ascending ? priceA - priceB : priceB - priceA;
            });

            // 清空表格
            tableBody.innerHTML = '';

            // 重新插入排序後的行
            rows.forEach(row => {
                tableBody.appendChild(row);
            });
        }
    });
    </script> -->
    
    <?php include '../parts/html-foot.php' ?>