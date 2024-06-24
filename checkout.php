<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      if ($address == '') {
         $message[] = 'Vui lòng thêm địa chỉ của bạn!';
      } else {

         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'Đặt hàng thành công!';
      }
   } else {
      $message[] = 'Giỏ hàng của bạn không có gì!';
   }
}
include './convert_currency.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>
   <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>Thủ tục thanh toán</h3>
      <p><a href="home.php">Trang chủ</a> <span> / Thanh toán</span></p>
   </div>

   <section class="checkout">

      <h1 class="title">Thanh toán đơn hàng</h1>

      <form action="" method="post">

         <div class="cart-items">
            <h3>Tên sản phẩm</h3>
            <?php
            $grand_total = 0;
            $cart_items[] = '';
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . currency_format($fetch_cart['price']) . ' x ' . $fetch_cart['quantity'] . ')';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
                  <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price"><?php echo currency_format($fetch_cart['price']); ?> x <?= $fetch_cart['quantity']; ?></span></p>

            <?php
               }
            } else {
               echo '<p class="empty">Giỏ hàng của bạn không có gì!</p>';
            }
            ?>
            <p class="grand-total"><span class="name">Tổng cộng :</span><span class="price"><?php echo currency_format($grand_total); ?></span></p>
            <a href="cart.php" class="btn">Xem giỏ hàng</a>
         </div>

         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
         <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
         <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
         <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

         <div class="user-info">
            <h3>Thông tin của bạn</h3>
            <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>
            <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
            <h3>Địa chỉ giao hàng</h3>
            <p><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') {
                                                               echo 'Vui lòng nhập địa chỉ của bạn!';
                                                            } else {
                                                               echo $fetch_profile['address'];
                                                            } ?></span></p>
            <a href="update_address.php" class="btn">Cập nhật địa chỉ</a>
            <select name="method" class="box" required>
               <option value="" disabled selected>Chọn phương thức thanh toán --</option>
               <option value="Thanh toán khi nhận hàng">Thanh toán sau khi nhận hàng</option>

            </select>
            <input type="submit" value="Đặt Hàng" class="btn <?php if ($fetch_profile['address'] == '') {
                                                                  echo 'disabled';
                                                               } ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
         </div>

      </form>

   </section>









   <?php include 'components/footer.php'; ?>






   <script src="js/script.js"></script>

</body>

</html>