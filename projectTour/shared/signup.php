<?php
session_start(); // Start a session

include('connection.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['username'] ?? '';
    $uemail = $_POST['email'] ?? '';
    $upass1 = $_POST['pass1'] ?? '';
    $upass2 = $_POST['pass2'] ?? '';
    $usertype = $_POST['usertype'] ?? '';

    if (empty($uname) || empty($uemail) || empty($upass1) || empty($upass2) || empty($usertype)) {
        echo "Please fill in all fields.";
        die;
    }

    if ($upass1 !== $upass2) {
        echo "Passwords do not match.";
        die;
    }

    // Check if the username already exists in the database
    $check_sql = "SELECT * FROM user WHERE username = '$uname'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
    } else {
        $cipher_pass = md5($upass1); // Encrypt the password using MD5

        $sql = "INSERT INTO user (username, email, password, usertype) VALUES ('$uname', '$uemail', '$cipher_pass', '$usertype')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $uname; // Store username in session
            header("location:../shared/login.php");
            echo "<script>alert('Registration successful!'); window.location.href = '../shared/login.php';</script>";
        
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn); // Close the database connection
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign Up</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/signup.css">
   
</head>
<body>


<section class="signup">
<form action="signup.php" method="POST" onsubmit="return validate()">
  <div class="signup-container">

      <h2>Sign Up</h2>

      <div class="inputBox">
          <span>Username</span>
          <input type="text" name="username" placeholder="Enter your username" required>
      </div>

      <div class="inputBox">
          <span>Email</span>
          <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="inputBox">
          <span>Password</span>
          <input type="password" name="pass1" id="pass1" placeholder="Enter your password" required>
      </div>

      <div class="inputBox">
          <span>Confirm Password</span>
          <input type="password" name="pass2" id="pass2" placeholder="Confirm your password" required>
      </div>

      <div class="inputBox">
          <span>User Type</span>
          <select name="usertype" class="sel" style="backgroun-color:purple" required>
             
              <option value="customer">customer</option>
          </select>
      </div>

      <button class="btn">Sign Up</button>

      <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</form>
</section>

<script>
function validate() {
    var pass1obj = document.getElementById("pass1");
    var pass2obj = document.getElementById("pass2");

    if (pass1obj.value === pass2obj.value) {
        return true;
    } else {
        alert("Passwords didn't match");
        return false;
    }
}
</script>
</body>
</html>
