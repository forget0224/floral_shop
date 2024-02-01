<?php require '../parts/db_connect.php';
$pageName = '頁面名';
$title = '頁面標題';
// 你該頁面前面的那些東東
$flower_id = isset($_GET['flower_id']) ? intval($_GET['flower_id']) : 0;

$sql = "DELETE FROM intro_flower WHERE flower_id = $flower_id ";

$pdo->query($sql);

// 將 deleteSuccess 設定為 true，表示刪除操作成功
$_SESSION['deleteSuccess'] = true;
# $_SERVER['HTTP_REFERER'] # 人從哪裡來

$goto = empty($_SERVER['HTTP_REFERER']) ? 'list.php' : $_SERVER['HTTP_REFERER'];

header('Location: '. $goto);
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
                    <!-- 頁面整塊貼上!!!!!! -->

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

    <?php include '../parts/html-foot.php' ?>