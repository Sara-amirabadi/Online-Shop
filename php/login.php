<?php
session_start();
$connect = mysqli_connect("localhost","root","","users_db");
if(!$connect){
    die("خطا در اتصال به دیتابیس");
}

if(isset($_POST['login'])){

    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];

    $query = mysqli_query($connect,"SELECT * FROM users WHERE mobile='$mobile'");
    $user = mysqli_fetch_assoc($query);

    echo '<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<title>نتیجه ورود</title>
</head>
<body style="text-align:center; margin-top:50px;">';

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_mobile'] = $user['mobile'];
        echo "<h2>ورود موفق </h2>";
        echo '<a href="../html/HAD.html"><button style="padding:10px 20px; margin-top:20px;">رفتن به صفحه اصلی</button></a>';
    }else{
        echo "<h2>شماره یا رمز اشتباه </h2>";
        echo '<a href="../html/login.html"><button style="padding:10px 20px; margin-top:20px;">بازگشت به صفحه ورود</button></a>';
    }

    echo '</body></html>';
}
?>
