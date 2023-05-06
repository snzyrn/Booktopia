<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = mysqli_query($conn, " SELECT * FROM `user_form` WHERE email = '$email' && password = '$pass' ");

   if(mysqli_num_rows($select) > 0){

      $error[] = 'user already exist!';

   }else{
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')");
         $error[] = 'registered!';
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="login.css">
   <!-- fontawesome -->
   <script src="https://kit.fontawesome.com/c52eceab34.js" crossorigin="anonymous"></script>

</head>
<body>
<!-- header section starts -->
<section class="header">
        <a href="../index.php" class="logo">Booktopia</a>
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
            <a href="login_form.php">
                    <i class=" fa-solid fa-user" style="color: #0d0d0d;"></i>
            </a>
        </nav>
    </section>
    <!-- header section ends  -->
   
<div class="form-container">

   <form action="" method="post">
      <h3>register</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login Now</a></p>
   </form>

</div>

</body>
</html>