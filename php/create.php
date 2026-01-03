<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "users_db";

$connect = mysqli_connect($host, $user, $pass);
if (!$connect) {
    die("خطا در اتصال به MySQL");
}

$sql_db = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if (!mysqli_query($connect, $sql_db)) {
    die("خطا در ساخت دیتابیس");
}
mysqli_select_db($connect, $dbname);
$sql_users = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mobile VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if (mysqli_query($connect, $sql_users)) {
    echo "جدول users با موفقیت ساخته شد <br>";
} else {
    echo "خطا در ساخت جدول users: " . mysqli_error($connect) . "<br>";
}

$sql_cart = "
CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    color VARCHAR(50),
    size VARCHAR(10),
    qty INT NOT NULL,
    price INT NOT NULL,
    total_price INT AS (qty *price) STORED,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if (mysqli_query($connect, $sql_cart)) {
    echo "جدول cart_items با موفقیت ساخته شد <br>";
} else {
    echo "خطا در ساخت جدول cart_items: " . mysqli_error($connect) . "<br>";
}
$sql_cart = "
CREATE TABLE  IF NOT EXISTS shipping_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    mobile VARCHAR(20),
    province VARCHAR(50),
    city VARCHAR(50),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;"
;
if (mysqli_query($connect, $sql_cart)) {
    echo "جدول shipping_info با موفقیت ساخته شد <br>";
} else {
    echo "خطا در ساخت جدول shipping_info: " . mysqli_error($connect) . "<br>";
}
mysqli_close($connect);
?>
