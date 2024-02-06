<?php
require '../parts/db_connect.php';

if(isset($_POST['request'])){
    $request = $_POST['request'];

    $query = "SELECT course.*, store.store_name, store.store_address, course_category.category_name
              FROM course
              INNER JOIN store ON course.store_id = store.store_id
              INNER JOIN course_category ON course.category_id = course_category.category_id
              WHERE course.category_id = :request";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':request', $request, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if($count > 0) { ?>
        <div class="courseTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="courseTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-trash"></i></th>
                            <!-- <th class="text-nowrap">#</th> -->
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">課程名稱</th>
                            <th class="text-nowrap">課程介紹</th>
                            <th class="text-nowrap">課程分類</th>
                            <th class="text-nowrap">商家名稱</th>
                            <th class="text-nowrap">上課地點</th>
                            <!-- <th class="text-nowrap">課程定價</th> -->
                            <th class="text-nowrap">課程定價</th>
                            <th class="text-nowrap">最小人數</th>
                            <th class="text-nowrap">最大人數</th>
                            <th><i class="fa-solid fa-file-pen"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row) {
                            $course_id = $row['course_id'];
                            $name = $row['name'];
                            $intro = $row['intro'];
                            $category_name = $row['category_name'];
                            $store_name = $row['store_name'];
                            $location = $row['location'];
                            $price = $row['price'];
                            $min_capacity = $row['min_capacity'];
                            $max_capacity = $row['max_capacity'];
                        ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_one(<?= $row['course_id'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $course_id ?></td>
                            <td><?= $name ?></td>
                            <td class="text-justify"><?= $intro ?></td>
                            <td class="text-nowrap"><?= $category_name ?></td>
                            <td class="text-left"><?= $store_name ?></td>
                            <td class="text-left"><?= $location ?></td>
                            <td class="text-left"><?= $price ?></td>
                            <td class="text-left"><?= $min_capacity ?></td>
                            <td class="text-left"><?= $max_capacity ?></td>
                            <td><a href="edit.php?course_id=<?= $row['course_id'] ?>">
                                <i class="fa-solid fa-file-pen"></i>
                                </a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="h6 text-center">目前資料筆數:<?= $count ?></div>
            </div>
        </div>
    <?php } else {
        echo "<h6 class='text-danger text-center mt-3'>Sorry! no record Found</h6>";
    }
}
?>
