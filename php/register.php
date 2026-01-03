<?php
session_start();

$connect = mysqli_connect("localhost","root","","users_db");
if(!$connect){
    die("خطا در اتصال به دیتابیس");
}

if(isset($_POST['register'])){

    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($connect,"SELECT * FROM users WHERE mobile='$mobile'");
    if(mysqli_num_rows($check) > 0){
        echo '<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head><meta charset="UTF-8"><title>ثبت نام</title></head>
<body style="text-align:center; margin-top:50px;">
<h2>این شماره قبلاً ثبت شده است </h2>
<a href="../html/register.html"><button style="padding:10px 20px; margin-top:20px;">بازگشت به ثبت نام</button></a>
</body>
</html>';
        exit;
    }

    $query = "INSERT INTO users (mobile, password) VALUES ('$mobile','$hashed_password')";
    if(mysqli_query($connect,$query)){
        echo '<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head><meta charset="UTF-8"><title>ثبت نام موفق</title></head>
<body style="text-align:center; margin-top:50px;">
<h2>ثبت نام با موفقیت انجام شد </h2>
<a href="../html/login.html"><button style="padding:10px 20px; margin-top:20px;">ورود به حساب کاربری</button></a>
</body>
</html>';
    }else{
        echo "خطا در ثبت نام";
    }
}
?>
