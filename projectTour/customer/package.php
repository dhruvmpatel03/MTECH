<?php
include "authguard.php";
include "nav.php";
include "../shared/connection.php"; // Include the database connection

// Fetch all packages from the database
$query = "SELECT * FROM package";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<p>Error fetching packages.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
 

<div class="heading" style="background:url(../images/header-bg-2.png) no-repeat">
    <h1>Packages</h1>
</div>

<!-- packages section starts  -->
<section class="packages">
    <h1 class="heading-title">Top Destinations</h1>
    <div class="box-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="box">
                <div class="image">
                    <img src="../images/<?php echo htmlspecialchars($row['pack_img']); ?>" alt="">
                </div>
                <div class="content">
                    <h3><?php echo htmlspecialchars($row['pack_name']); ?></h3>
                    <p><?php echo htmlspecialchars($row['pack_desc']); ?></p>
                    <a href="book.php" class="btn">Book Now</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="load-more"><span class="btn">Load More</span></div>
</section>
<!-- packages section ends -->


<!-- footer section starts -->
<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>quick links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> home</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about</a>
         <a href="#"> <i class="fas fa-angle-right"></i> package</a>
         <a href="#"> <i class="fas fa-angle-right"></i> book</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <a href="#"> <i class="fas fa-phone"></i> +91 8596741236 </a>
         <a href="#"> <i class="fas fa-phone"></i> +91 7456893215 </a>
         <a href="#"> <i class="fas fa-envelope"></i> tour&travel@gmail.com </a>
         <a href="#"> <i class="fas fa-map"></i> surat, india - 394107 </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>
   </div>

   <div class="credit"> created by <span>Dhruv & Anvi</span> | all rights reserved! </div>
</section>
<!-- footer section ends -->









<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

<?php
mysqli_close($conn);
?>
