<?php
$connect = mysqli_connect("localhost", "root", "", "users_db");
if (!$connect) {
    die("خطا در اتصال به دیتابیس");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($connect, $_POST['last_name']);
    $mobile     = mysqli_real_escape_string($connect, $_POST['mobile']);
    $province   = mysqli_real_escape_string($connect, $_POST['province']);
    $city       = mysqli_real_escape_string($connect, $_POST['city']);
    $address    = mysqli_real_escape_string($connect, $_POST['address']);

    $query = "
        INSERT INTO shipping_info 
        (first_name, last_name, mobile, province, city, address)
        VALUES 
        ('$first_name', '$last_name', '$mobile', '$province', '$city', '$address')
    ";

    if (mysqli_query($connect, $query)) {
        header("Location: ../html/Pay.html");
        exit;
    } else {
        echo "خطا در ذخیره اطلاعات: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>
