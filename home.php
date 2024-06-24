<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';
include './convert_currency.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>
   <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>



   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

           

            <div class="swiper-slide slide">
               <div class="content">
                  <span>Mua sắm</span>
                  <h3>Laptop VietKhanh</h3>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/4.png" alt="">
               </div>
            </div>

            <!-- <div class="swiper-slide slide">
               <div class="content">
                  <span>Mua sắm</span>
                  <h3>Laptop VietKhanh</h3>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/5.png" alt="">
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="content">
                  <span>Mua sắm</span>
                  <h3>Laptop VietKhanh</h3>
                  <a href="./product.php" class="btn">Xem thêm</a>
               </div>
               <div class="image">
                  <img src="imgs/6.webp" alt="">
               </div>
            </div> -->

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="category">

      <h1 class="title">Thương hiệu</h1>

      <div class="box-container">

         <a href="category.php?category=asus" class="box">
            <img src="imgs/13.webp" alt="">
            <h3>asus</h3>
         </a>

         <a href="category.php?category=acer" class="box">
            <img src="imgs/16.webp" alt="">
            <h3>acer</h3>
         </a>

         <a href="category.php?category=razer" class="box">
            <img src="imgs/17.jfif" alt="">
            <h3>razer</h3>
         </a>

         <a href="category.php?category=Dell" class="box">
            <img src="imgs/14.jpg" alt="">
            <h3>dell</h3>
         </a>
         
      </div>

   </section>


   <section class="products">

      <h1 class="title">tất cả sản phẩm</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><?php echo currency_format($fetch_products['price']); ?></div>

                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Không có sản phẩm để hiển thị!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="./product.php" class="btn">Xem tất cả</a>
      </div>

   </section>



   <?php include 'components/footer.php'; ?>


   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".hero-slider", {
         loop: true,
         grabCursor: true,
         effect: "flip",
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });
   </script>

</body>

</html>