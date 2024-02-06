<?php require '../parts/db_connect.php';

if(isset($_POST['input'])){
    
    $input = $_POST['input'];
    
    // 檢查搜尋資料
    // var_dump($input);
    
    $query = "SELECT course.*, store.store_name, store.store_address, course_category.category_name
                FROM course
                INNER JOIN store ON course.store_id = store.store_id
                INNER JOIN course_category ON course.category_id = course_category.category_id
                WHERE course.name LIKE CONCAT('%', :input, '%')
                OR course.intro LIKE CONCAT('%', :input, '%')
                OR course_category.category_name LIKE CONCAT('%', :input, '%')
                OR store.store_name LIKE CONCAT('%', :input, '%')
                OR course.location LIKE CONCAT('%', :input, '%')
                OR course.price LIKE CONCAT('%', :input, '%')
                OR course.min_capacity LIKE CONCAT('%', :input, '%')
                OR course.max_capacity LIKE CONCAT('%', :input, '%')";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':input', $input . '%', PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    
    if(count($result) > 0){ ?>
        <div class="courseTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="courseTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-trash"></i></th>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">課程名稱</th>
                            <th class="text-nowrap">課程介紹</th>
                            <th class="text-nowrap">課程分類</th>
                            <th class="text-nowrap">商家名稱</th>
                            <th class="text-nowrap">上課地點</th>
                            <th class="text-nowrap">課程定價</th>
                            <th class="text-nowrap">最小人數</th>
                            <th class="text-nowrap">最大人數</th>
                            <th><i class="fa-solid fa-file-pen"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($result as $r): ?>
                        <?php
                        $course_id = $r['course_id'];
                        $name = $r['name'];
                        $intro = $r['intro'];
                        $category_name = $r['category_name'];
                        $store_name = $r['store_name'];
                        $location = $r['location'];
                        $price = $r['price'];
                        $min_capacity = $r['min_capacity'];
                        $max_capacity = $r['max_capacity'];
                        ?>
                        <tr>
                        <td>
                            <a href="javascript: delete_one(<?= $r['course_id'] ?>)">
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
                        <td><a href="edit.php?course_id=<?= $r['course_id'] ?>">
                            <i class="fa-solid fa-file-pen"></i>
                            </a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="h6 text-center">目前資料筆數:<?= $count ?></div>
            </div>
        </div>
        <?php
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
    }
}

// echo "Hey";
?>