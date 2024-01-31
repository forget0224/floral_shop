<?php 
// list 變成一個網址殼 
// 內容拆成兩個頁面，以判斷的形式 include其中一個


// 都需要session狀態來判斷權限 =>給予甚麼頁面呈現
session_start();

if (isset($_SESSION['admin'])) {
    include 'list-admin.php';
} else {
    include 'list-no-admin.php';
}


