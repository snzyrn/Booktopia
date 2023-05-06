<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'config.php';

session_start();

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $pass = md5($_POST['password']);

   $select = mysqli_prepare($conn, "SELECT * FROM user_form WHERE email = ? AND password = ?");
   mysqli_stmt_bind_param($select, "ss", $email, $pass);
   mysqli_stmt_execute($select);
   $result = mysqli_stmt_get_result($select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:../admin/admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="login.css">
   <!-- fontawesome -->
   <script src="https://kit.fontawesome.com/c52eceab34.js" crossorigin="anonymous"></script>

</head>
<body>
<!-- header section starts -->
    <section class="header">
        <a href="../index.php" class="logo">TechZone</a>
        <nav class="navbar">
            <a href="../index.php">
                    <i class=" fa-solid fa-house" style="color: #0d0d0d;"></i>
            </a>
            <a href="fav.php">
                    <i class=" fa-solid fa-heart" style="color: #0d0d0d;"></i>
            </a>
            <a href="shop.php">
                    <i class=" fa-solid fa-basket-shopping" style="color: #0d0d0d;"></i>
            </a>
            <a href="#">
                    <i class=" fa-solid fa-user" style="color: #0d0d0d;"></i>
            </a>
        </nav>
    </section>
    <!-- header section ends  -->
   
<div class="form-container">

   <form action="" method="post">
      <h3>login</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
   </form>

</div>

</body>
</html>