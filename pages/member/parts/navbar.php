<?php
if (empty($pageName)) {
    $pageName = "";
}
?>

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">flower<span>.</span></a>

    <nav class="navbar">
        <a href="../../../../floral_shop/manager_index.php">首頁</a>
        <a <?= $pageName == 'list' ? 'active' : '' ?>href="./list.php">列表</a>
        <a <?= $pageName == 'add' ? 'active' : '' ?>href="./add.php">新增</a>
        <!-- <a href="#products">products</a>
        <a href="#contact">contact</a> -->
    </nav>

    <div class="icons">
        <a href="#" class="fas fa-heart"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
        <!-- <ul class="navbar-nav mb-2 mb-lg-0"> -->
    <?php if (isset($_SESSION['admin'])) : ?>
        <!-- <li class="nav-item"> -->
            <!-- <a href="#" class="fas fa-user"><?= $_SESSION['admin']['name'] ?></a> -->
            <!-- <a href="#" class="fas fa-user"><?= $_SESSION['admin'] ?></a> -->
        <!-- </li>
        <li class="nav-item"> -->
            <a class="nav-link fa-solid fa-right-from-bracket" href="./logout.php"></a>
        <!-- </li> -->
    <?php else : ?>
        <!-- <li class="nav-item"> -->
            <a href="./login.php" class="fas fa-user nav-link <?= $pageName == 'login' ? 'active' : '' ?>"></a>
        <!-- </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link <?= $pageName == 'register' ? 'active' : '' ?>" href="./register.php">註冊</a>
        </li> -->
    <?php endif ?>
        <!-- </ul> -->

    </div>
    
</header>


