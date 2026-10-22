<?php
 

 include "nav.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>

.contact-section {
    width: 80%;
    margin: 30px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

.contact-section h1 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 20px;
}

.contact-info {
    text-align: center;
    margin-bottom: 40px;
}

.contact-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.contact-form input,
.contact-form textarea {
    width: 80%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.contact-form textarea {
    height: 150px;
    resize: none;
}

.contact-form button {
    width: 80%;
    padding: 10px;
    background-color: #8e44ad;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.contact-form button:hover {
    background-color: #b458dc;
}

        </style>
</head>
<body>

    <section class="contact-section">
        <h1>Contact Us</h1>
    
        
        <form action="#" method="POST" class="contact-form">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="mobile" placeholder="Mobile Number" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <button type="submit">Send</button>
        </form>
    </section>






    

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