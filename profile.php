<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thông tin cá nhân</title>
   <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

 
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="user-details">

      <div class="user">
         <img src="imgs/20.jfif" alt="">
         <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
         <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
         <a href="update_profile.php" class="btn">Cập nhật thông tin</a>
         <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') {
                                                                           echo 'Vui lòng nhập địa chỉ';
                                                                        } else {
                                                                           echo $fetch_profile['address'];
                                                                        } ?></span></p>
         <a href="update_address.php" class="btn">Cập nhật địa chỉ</a>
      </div>

   </section>










   <?php include 'components/footer.php'; ?>







   <script src="js/script.js"></script>

</body>

</html>