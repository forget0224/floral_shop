<?php
if (empty($pageName)) {
    $pageName = "";
}
?>
<style>
    .navbar-nav .nav-link.active {
        background-color: rgb(13, 110, 253);
        border-radius: 10px;
        font-weight: 800;
        color: white;
    }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/floral_shop/manager_index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-seedling"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FLORAL SHOP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/floral_shop/manager_index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        頁面分類
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true"
            aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>代客送花</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">商品管理</h6>
                <a class="collapse-item" href="/floral_shop/pages/custom/product_list.php">商品列表</a>
                <a class="collapse-item" href="/floral_shop/pages/custom/product_list_add.php">快速新增</a>

                <!-- <h6 class="collapse-header">商品管理</h6>
                <a class="collapse-item" href="/floral_shop/pages/custom/template_list.php">範本列表</a> -->
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">訂單管理</h6>
                <a class="collapse-item" href="/floral_shop/pages/custom/list.php">訂單列表</a>
                <a class="collapse-item" href="/floral_shop/pages/custom/add.php">快速新增</a>


            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true"
            aria-controls="collapsePages2">
            <i class="fas fa-fw fa-folder"></i>
            <span>線上商城</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">商城管理 <i class="fa-solid fa-cart-arrow-down"></i></h6>
                <a class="collapse-item" href="/floral_shop/pages/product/list.php">商品列表</a>
                <a class="collapse-item" href="/floral_shop/pages/product/add.php">新增商品</a>
                <div class="collapse-divider"></div>
                <!-- <h6 class="collapse-header">小標題/分類</h6> -->
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true"
            aria-controls="collapsePages3">
            <i class="fas fa-fw fa-folder"></i>
            <span>合作課程</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">課程管理</h6>
                <a class="collapse-item" href="/floral_shop/pages/course/list.php">課程列表</a>
                <a class="collapse-item" href="/floral_shop/pages/course/add.php">新增課程</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="true"
            aria-controls="collapsePages4">
            <i class="fas fa-fw fa-folder"></i>
            <span>花與遊戲</span>
        </a>
        <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">小標題/分類</h6> -->
                <!-- <a class="collapse-item" href="login.php">Login</a> -->
                <!-- <div class="collapse-divider"></div> -->
                <h6 class="collapse-header text-center">ꕤFleurs et Jeuxꕤ</h6>
                <a class="collapse-item" href="/floral_shop/pages/intro/intro_flower.php">𓇚 花圖鑑</a>
                <a class="collapse-item" href="/floral_shop/pages/intro/intro_add.php">𓇬 新增花朵</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages5" aria-expanded="true"
            aria-controls="collapsePages5">
            <i class="fas fa-fw fa-folder"></i>
            <span>會員專區</span>
        </a>
        <div id="collapsePages5" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/floral_shop/pages/member/index_.php">首頁</a>
                <!-- <h6 class="collapse-header">Login Screens:</h6> -->
                <!-- <a class="collapse-item" href="/floral_shop/pages/member/login.php">Login</a> -->
                <!-- <a class="collapse-item" href="/floral_shop/pages/member/list.php">列表</a> -->
                <!-- <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a> -->
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages6" aria-expanded="true"
            aria-controls="collapsePages6">
            <i class="fas fa-fw fa-folder"></i>
            <span>店家專區</span>
        </a>
        <div id="collapsePages6" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">小標題/分類</h6> -->
                <!-- <a class="collapse-item" href="login.php">Login</a> -->
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">店家管理</h6>
                <a class="collapse-item" href="/floral_shop/pages/store/list.php">店家列表</a>
                <a class="collapse-item" href="/floral_shop/pages/store/add.php">店家新增</a>
                <!-- <a class="collapse-item" href="blank.html">Blank Page</a> -->
            </div>
        </div>
    </li>


    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="/floral_shop/img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
            and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
            Pro!</a>
    </div> -->

</ul>