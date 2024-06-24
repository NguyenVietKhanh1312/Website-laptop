<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giới thiệu</title>
   <link rel="shortcut icon" href="./imgs/logo.png" type="image/x-icon">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="heading">
      <h3>Giới Thiệu</h3>
      <p><a href="home.php">Trang chủ</a> <span> / Giới thiệu</span></p>
   </div>


   <section class="about">

      <div class="row">

         <div class="image">
            <img src="./imgs/logo.png" alt="">
         </div>
      
         <div class="content">
            <h3>Chính sách mua hàng</h3>
            <!-- <p>Giao hàng toàn quốc, qúy khách hàng vui lòng thanh toán tiền trước, phí ship vui lòng thanh toán cho nhân viên bưu điện lúc nhận hàng.</p> -->
            <p>- Cam kết giá rẻ nhất thị trường.</p>
            <p>- Giao hàng miễn phí tại Tp Vinh.</p>
            <p>- Chính sách giao hàng cực nhanh.</p>
            <p>- Đổi trả hàng trong vòng 3 ngày.</p>
            <p>- Bảo hành uy tín, chuyên nghiệp.</p>

            <a href="./product.php" class="btn">Sản phẩm</a>
         </div>

      </div>

   </section>



   <section class="steps">

      <h1 class="title">Các bước mua hàng</h1>

      <div class="box-container">

         <div class="box">
            <img src="imgs/1.jpg" alt="">
            <h3>Chọn sản phẩm</h3>
            <p>Nhấn vào sản phẩm muốn mua, thêm vào giỏ hàng và điền thông tin thanh toán.</p>
         </div>

         <div class="box">
            <img src="imgs/2.jpg" alt="">
            <h3>Giao hàng nhanh</h3>
            <p>Giao hàng toàn quốc, quý khách vui lòng thanh toán khi nhận hàng.</p>
         </div>

         <div class="box">
            <img src="imgs/3.jfif" alt="">
            <h3>Kiểm tra sản phẩm</h3>
            <p>Chúc quý khách có một trải nghiệm tốt với sản phẩm</p>
         </div>

      </div>

   </section>



   <!-- <section class="reviews">

      <h1 class="title">Đội ngũ nhân viên</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="./imgs/khanh.png" alt="">
               <h3>Viet Khanh</h3>
               <p>Tổ trưởng gương mẫu luôn hết mình với công việc, đạt hiệu xuất làm việc xuất sắc.
                  Một trong những ứng cử viên cho chiếc ghế giám đốc điều hành tương lai.
               </p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section> -->





   <?php include 'components/footer.php'; ?>






   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>