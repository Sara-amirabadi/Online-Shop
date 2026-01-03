<?php
$connect = mysqli_connect("localhost","root","","users_db");
if(!$connect){
    die("خطا در اتصال به دیتابیس");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name  = mysqli_real_escape_string($connect, $_POST['name']);
    $color = mysqli_real_escape_string($connect, $_POST['color']);
    $size  = mysqli_real_escape_string($connect, $_POST['size']);
    $qty   = (int)$_POST['qty'];
    $price = (int)$_POST['price'];

    $check = mysqli_query($connect,"
        SELECT id FROM cart_items 
        WHERE name='$name' AND color='$color' AND size='$size'
    ");


        mysqli_query($connect,"
            INSERT INTO cart_items (name,color,size,qty,price)
            VALUES ('$name','$color','$size',$qty,$price)
        ");
    

    header("Location: add_to_cart.php");
    exit;
}

if(isset($_GET['delete_id'])){
    $id = (int)$_GET['delete_id'];
    mysqli_query($connect,"DELETE FROM cart_items WHERE id=$id");
    header("Location: add_to_cart.php");
    exit;
}

if(isset($_GET['clear_cart'])){
    mysqli_query($connect,"DELETE FROM cart_items");
    header("Location: add_to_cart.php");
    exit;
}

if(isset($_GET['qty_id']) && isset($_GET['type'])){
    $id = (int)$_GET['qty_id'];

    if($_GET['type'] == 'plus'){
        mysqli_query($connect,"UPDATE cart_items SET qty = qty + 1 WHERE id=$id");
    }

    if($_GET['type'] == 'minus'){
        mysqli_query($connect,"UPDATE cart_items SET qty = qty - 1 WHERE id=$id AND qty > 1");
    }

    header("Location: add_to_cart.php");
    exit;
}

$result = mysqli_query($connect,"SELECT * FROM cart_items");
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>سبد خرید</title>
    <link rel="stylesheet" href="../css/Cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<header class="topbar">

    <div class="logo">
        <img src="../image/logo (1).png" alt="logo">
    </div>

    <nav class="menu">
        <a href="../html/HAD.html"><img src="../image/house.png">خانه</a>
        <a href="#contact-us"><img src="../image/note-2.png">درباره ما</a>
        <a href="../html/product.html"><img src="../image/briefcase.png">محصولات</a>
        <a href="#contact-us"><img src="../image/Phone call.png">تماس با ما</a>
    </nav>

    <div class="icons">
        <a href="../html/login.html">
            <img class="iconuser" src="../image/user.png" alt="user">
        </a>

    </div>

</header>

<div class="container">

    <div class="steps-container">
        <div class="step active">
            <div class="circle" style="border-color:#2bb0a6;">
                <img src="../image/image 41.png">
            </div>
            <div class="label">سبد خرید</div>
        </div>

        <div class="step">
            <div class="circle">
                <img src="../image/image 46.png">
            </div>
            <div class="label">اطلاعات ارسال</div>
        </div>

        <div class="step">
            <div class="circle">
                <img src="../image/image 44.png">
            </div>
            <div class="label">پرداخت</div>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>شرح کالا</th>
                    <th>تعداد</th>
                    <th>قیمت واحد</th>
                    <th>قیمت کل</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $total = 0;
            while($row = mysqli_fetch_assoc($result)):
                $rowTotal = $row['qty'] * $row['price'];
                $total += $rowTotal;
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>
                        <?= $row['name'] ?><br>
                        <small>رنگ: <?= $row['color'] ?> | سایز: <?= $row['size'] ?></small>
                    </td>
                    <td>
                        <a href="add_to_cart.php?qty_id=<?= $row['id'] ?>&type=plus">➕</a>
                        <?= $row['qty'] ?>
                        <a href="add_to_cart.php?qty_id=<?= $row['id'] ?>&type=minus">➖</a>
                    </td>
                    <td><?= number_format($row['price']) ?> ریال</td>
                    <td><?= number_format($rowTotal) ?> ریال</td>
                    <td>
                        <a href="add_to_cart.php?delete_id=<?= $row['id'] ?>"
                           onclick="return confirm('محصول حذف شود؟')">حذف؟</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="cart-total">
        <strong>جمع کل:</strong>
        <?= number_format($total) ?> ریال
    </div>

    <div style="margin-top:20px;">
        <a href="add_to_cart.php?clear_cart=1"
           onclick="return confirm('کل سبد خرید حذف شود؟')"
           style="color:red;">🧹 حذف کل سبد خرید</a>
    </div>

    <form action="../html/Shipping.html">
        <button class="next-btn">ثبت و مرحله بعد</button>
    </form>

</div>

<footer class="site-footer" id="contact-us">

    <div class="footer-inner">

        <div class="footer-col">
            <h4>مردانه</h4>
            <ul>
                <li><a href="#">پیراهن مردانه</a></li>
                <li><a href="#">تی‌شرت مردانه</a></li>
                <li><a href="#">شلوار مردانه</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>زنانه</h4>
            <ul>
                <li><a href="#">پیراهن زنانه</a></li>
                <li><a href="#">تاپ زنانه</a></li>
                <li><a href="#">مانتو زنانه</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>بچگانه</h4>
            <ul>
                <li><a href="#">نوزاد</a></li>
                <li><a href="#">دخترانه</a></li>
                <li><a href="#">پسرانه</a></li>
            </ul>
        </div>

        <div class="footer-col contact">
            <h4>تماس با ما</h4>
            <p>تهران، خیابان مثال، پلاک ۱۲</p>
            <p>۰۹۱۲-۱۲۳-۴۵۶۷</p>
            <p>email@example.com</p>
        </div>

    </div>

    <div class="footer-bottom">
        <div class="follow">
            ما را دنبال کنید:
            <div class="social-icons">
                <img src="../image/instagram.png">
                <img src="../image/whatsapp.png">
                <img src="../image/sms.png">
            </div>
        </div>
        <div class="copyright">
            © ۱۴۰۳ تمامی حقوق محفوظ است
        </div>
    </div>

</footer>

</body>
</html>

<?php mysqli_close($connect); ?>
