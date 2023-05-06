<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = trim($_POST['product_name']);// htmlspecialchars fonksiyonu özel karakterleri yok ediyor, strip_tags da html etiketlerini kaldırıyor
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = '/Applications/XAMPP/xamppfiles/htdocs/Booktopia/admin/img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Please Fill Out All';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'New Product Added Successfully';
      }else{
         $message[] = 'Could not Add the Product';
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
   <!-- css file -->
   <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
   <!-- fontawesome -->
   <script src="https://kit.fontawesome.com/c52eceab34.js" crossorigin="anonymous"></script>
   <title>Admin Page</title>

</head>
<body>
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
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="error-msg">'.$message.'</span>';
   }
}

?>
     
<div class="container">
   <div class="admin-product-form-container">
      <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data"> 
      <!-- $_SERVER["PHP_SELF"] ifadesini formun action özelliği -> XSS attack -->
      <h3>Add a New Product</h3>
      <input type="text" placeholder="enter product name" name="product_name" class="box">
      <input type="number" placeholder="enter product price" name="product_price" class="box">
      <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
      <input type="submit" name="add_product" class="btn" value="Add">
      </form>
   </div>
</div>

</body>
</html>