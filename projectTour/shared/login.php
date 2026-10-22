
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tours.</title>

   <!-- Swiper CSS link -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/login.css">
   <style>
      /* Style for the home button */
      .home-btn {
         position: absolute;
         top: 10px;
         left: 10px;
         background-color:#8e44ad; /* Green background */
         color: white; /* White text */
         padding: 10px 20px;
         text-decoration: none;
         border-radius: 5px;
         font-size: 16px;
         
      }
      .home-btn:hover {
         background-color: #522764; /* Darker green on hover */
      }
   </style>
</head>
<body>

<?php
session_start();
include('connection.php'); // Include the database connection



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['username'] ?? '';
    $upass = $_POST['password'] ?? '';

    if (empty($uname) || empty($upass)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        $cipher_pass = md5($upass); // Encrypt the password using MD5

        // Query to check if the username and password match
        $sql = "SELECT * FROM user WHERE username = '$uname' AND password = '$cipher_pass'";
        $result = mysqli_query($conn, $sql);

        

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result); // Fetch the row
            $_SESSION['login_status'] = true;
            $_SESSION['userid'] = $row['userid'];//store user id
            $_SESSION['username'] = $uname; // Store username in session
            $_SESSION['usertype'] = $row['usertype']; // Store usertype in session

            if ($row['usertype'] == 'admin') {
                header("Location: ../admin/home.php"); // Redirect to admin page
                exit();
            } elseif ($row['usertype'] == 'customer') {
                header("Location: ../customer/home.php"); // Redirect to customer page
                exit();
            }
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }

        mysqli_close($conn); // Close the database connection
    }
}
?>
<!-- Home button -->
<a href="../home.php" class="home-btn">Home</a>
<section class="login">
  <div class="login-container">
      <h2>login</h2>
      <form action="login.php" method="post">
          <div class="inputBox">
              <span>username</span>
              <input type="text" name="username" placeholder="enter your username" required>
          </div>

          <div class="inputBox">
              <span>password</span>
              <input type="password" name="password" placeholder="enter your password" required>
          </div>

          <button type="submit" class="btn">login</button>
      </form>

      <p>don't have an account? <a href="signup.php">sign up</a></p>
  </div>
</section>
</body>
</html>
