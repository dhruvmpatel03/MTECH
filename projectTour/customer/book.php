<?php
include "../shared/connection.php";
include "authguard.php";
include "nav.php";

// Assuming you store the username in the session after login
$username = $_SESSION['username'];

// Fetch the userid from the user table using the username
$query = "SELECT userid FROM user WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user was found in the database
if ($user) {
    $userid = $user['userid'];
} else {
    echo "User not found!";
    exit;
}

// Fetch packages for the dropdown menu
$query = "SELECT pack_id, pack_name FROM package";
$result = mysqli_query($conn, $query);

if (isset($_POST['send'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving = $_POST['leaving'];

    // Server-side validation (optional but recommended)
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($location) || empty($guests) || empty($arrivals) || empty($leaving)) {
        echo "All fields are required!";
        exit;
    }

    // SQL query to insert the booking data into the `book` table, including the userid
    $query = "INSERT INTO book (name, email, phone, address, location, userid, guests, arrivals, leaving, created_at) 
              VALUES ('$name', '$email', '$phone', '$address', '$location', '$userid', '$guests', '$arrivals', '$leaving', NOW())";

    // Executing the query
    if (mysqli_query($conn, $query)) {
        // Success message
        echo "<script>alert('Booking successful!')</script>";
        header('Location: ../customer/home.php'); // Redirect to a confirmation page
    } else {
        // Error message
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Your head content -->
</head>
<body>

<div class="heading" style="background:url(../images/header-bg-3.png) no-repeat">
   <h1>book now</h1>
</div>

<!-- booking section starts -->
<section class="booking">
   <h1 class="heading-title">book your trip!</h1>

   <form action="" method="post" class="book-form">
      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" placeholder="enter your name" name="name">
         </div>
         <div class="inputBox">
            <span>email :</span>
            <input type="email" placeholder="enter your email" name="email">
         </div>
         <div class="inputBox">
            <span>phone :</span>
            <input type="number" placeholder="enter your number" name="phone">
         </div>
         <div class="inputBox">
            <span>address :</span>
            <input type="text" placeholder="enter your address" name="address">
         </div>
         <div class="inputBox">
            <span>where to :</span>
            <select name="location">
                <option value="">Select destination</option>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['pack_id'] . "'>" . $row['pack_name'] . "</option>";
                }
                ?>
            </select>
         </div>
         <div class="inputBox">
            <span>how many :</span>
            <input type="number" placeholder="number of guests" name="guests">
         </div>
         <div class="inputBox">
            <span>arrivals :</span>
            <input type="date" name="arrivals">
         </div>
         <div class="inputBox">
            <span>leaving :</span>
            <input type="date" name="leaving">
         </div>
      </div>

      <input type="submit" value="submit" class="btn" name="send">
   </form>
</section>
<!-- booking section ends -->

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

</body>
</html>
