<?php 
    include "nav.php";
    include "shared/connection.php"; // Include the database connection

    // Fetch packages from the database
    $query = "SELECT * FROM package LIMIT 3"; // Limit to 3 for homepage display
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
   <title>Home</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- home section starts -->
<section class="home">
   <div class="swiper home-slider">
      <div class="swiper-wrapper">
         <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>travel around the world</h3>
               <a href="shared/login.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>discover new places</h3>
               <a href="shared/login.php" class="btn">discover more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>explore, discover, travel</span>
               <h3>make your tour worthwhile</h3>
               <a href="shared/login.php" class="btn">discover more</a>
            </div>
         </div>
      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
   </div>
</section>
<!-- home section ends -->

<!-- services section starts -->
<section class="services">
   <h1 class="heading-title"> Our Services </h1>

   <div class="box-container">
      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>adventure</h3>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>tour guide</h3>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>trekking</h3>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>camp fire</h3>
      </div>

      <div class="box">
         <img src="images/icon-5.png" alt="">
         <h3>off road</h3>
      </div>

      <div class="box">
         <img src="images/icon-6.png" alt="">
         <h3>camping</h3>
      </div>
   </div>
</section>
<!-- services section ends -->

<!-- home about section starts -->
<section class="home-about">
   <div class="image">
      <img src="images/about-img.jpg" alt="">
   </div>

   <div class="content">
      <h3>about us</h3>
      <p>At travel, we specialize in creating unforgettable travel experiences tailored to your unique desires. Since [Year], our dedicated team has been committed to providing expert advice, personalized itineraries, and exceptional service. Discover your next adventure with us and let us turn your travel dreams into reality.</p>
      <a href="about.php" class="btn">read more</a>
   </div>
</section>
<!-- home about section ends -->

<!-- home packages section starts (Dynamic Packages) -->
<section class="home-packages">
   <h1 class="heading-title"> Our Packages </h1>
   <div class="box-container">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
         <div class="box">
            <div class="image">
               <img src="images/<?php echo htmlspecialchars($row['pack_img']); ?>" alt="">
            </div>
            <div class="content">
               <h3><?php echo htmlspecialchars($row['pack_name']); ?></h3>
               <p><?php echo htmlspecialchars($row['pack_desc']); ?></p>
               <a href="shared/login.php" class="btn">Book Now</a>
            </div>
         </div>
      <?php endwhile; ?>
   </div>
   <div class="load-more"> <a href="shared/login.php" class="btn">Load More</a> </div>
</section>
<!-- home packages section ends -->

<!-- home offer section starts -->
<section class="home-offer">
   <div class="content">
      <h3>upto 50% off</h3>
      <p>Take advantage of our limited-time offer and save big on your next adventure. Whether you're looking for a relaxing getaway or an exciting excursion, now is the perfect time to book your dream trip at unbeatable prices.</p>
      <a href="shared/login.php" class="btn">book now</a>
   </div>
</section>
<!-- home offer section ends -->

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

<!-- swiper js link -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="js/script.js"></script>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
