<?php
session_start();

unset($_SESSION['admin']);

# redirect 重新導向 
header('Location: login.php');