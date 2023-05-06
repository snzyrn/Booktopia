
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TechZone</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- css file -->
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <!-- js file -->
    <script src='script.js'></script>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/c52eceab34.js" crossorigin="anonymous"></script>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body>
    <!-- header section starts -->
    <section class="header">
        <a href="index.php" class="logo">TechZone</a>
        <div class="search-container">
            <form method="GET" action="" name="form">
                <input type="text" name="name" placeholder="Search...">
                <button type="submit" name="submit" value="search" <i class="fa-solid fa-search"></i></button>
            </form>

        </div>
        <nav class="navbar">
            <a href="index.php">
                    <i class=" fa-solid fa-house"></i>
            </a>
            <a href="fav.php">
                    <i class=" fa-solid fa-heart"></i>
            </a>
            <a href="shop.php">
                    <i class=" fa-solid fa-basket-shopping"></i>
            </a>
            <a href="account/login_form.php">
                    <i class=" fa-solid fa-user"></i>
            </a>
        </nav>
    </section>
    <!-- header section ends  -->
    <!-- home section starts -->

    <!-- products section starts -->
    <!-- products section starts -->
    <section class="carousel">
        <div class="row">
            <?php
            // Veritabanı bilgileri
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "user_db";

            // Veritabanına bağlanma
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Bağlantı hatası kontrolü
            if ($conn->connect_error) {
                die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
            }

            // Ürün bilgilerini çekme
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            // Verileri kullanarak ürün kartlarını oluşturma
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-3 col-sm-6'>";
                    echo "<div class='thumb-wrapper'>";
                    echo "<span class='wish-icon'><i class='fa fa-heart-o'></i></span>";
                    echo "<div class='img-box'>";
                    echo "<img src='admin/img/" . $row['image'] . "' class='img-fluid' alt='" . $row['name'] . "'>";
                    echo "</div>";
                    echo "<div class='thumb-content'>";
                    echo "<h4>" . $row['name'] . "</h4>";
                    echo "<div class='star-rating'>";
                    echo "<ul class='list-inline'>";
                    echo "</ul>";
                    echo "</div>";
                    echo "<p class='item-price'><b>" . $row['price'] . " TL</b></p>";
                    echo "<a href='#' class='btn btn-primary'>Add to Cart</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Ürün bulunamadı.";
            }

            $conn->close();
            ?>
        </div>
    </section>


    <!-- products section ends -->


    <!-- home section ends -->
    <!-- footer section starts -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Quick Links</h3>    
                <a href="index.php"><i class="fa-solid fa-angle-right"></i> Home</a>
                <a href="fav.php"><i class="fa-solid fa-angle-right"></i> Favorites</a>
                <a href="shop.php"><i class="fa-solid fa-angle-right"></i> Shopping Basket</a>
                <a href="account/login_form.php"><i class="fa-solid fa-angle-right"></i> Account</a>
            </div>
            <div class="box">
                <h3>Extra Links</h3>    
                <a href="#"><i class="fa-solid fa-angle-right"></i> Ask Questions</a>
                <a href="#"><i class="fa-solid fa-angle-right"></i> About Us</a>
                <a href="#"><i class="fa-solid fa-angle-right"></i> Privacy Policy</a>
                <a href="#"><i class="fa-solid fa-angle-right"></i> Terms os Use</a>
            </div>
            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"><i class="fas fa-phone"></i> +123-456-789</a>
                <a href="#"><i class="fa-solid fa-envelope"></i> example@mail.com</a>
                <a href="#"><i class="fa-solid fa-location-dot"></i> Trabzon, Turkey - 616161</a>
            </div>
            <div class="box">
                <h3>Follow Us</h3>
                <a href="#"><i class="fa-brands fa-square-facebook"></i> Facebook</a>
                <a href="#"><i class="fa-brands fa-square-instagram"></i> Instagram</a>
                <a href="#"><i class="fa-brands fa-square-twitter"></i> Twitter</a>
                <a href="#"><i class="fa-brands fa-linkedin"></i> Linkedin</a>
            </div>
        </div>
        <div class="credit"> created by <span>Yaren Şenöz</span> | all rights reserved | </div>
    </section>
    <!-- footer section ends -->
</body>
</html>