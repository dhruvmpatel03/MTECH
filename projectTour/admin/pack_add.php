<?php
include "../shared/connection.php"; // Include the database connection
include "authguard.php"; // Include authentication guard
include "nav.php"; // Include the navigation

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form inputs
    $tname = $_POST['tname'] ?? '';
    $tdes = $_POST['tdes'] ?? '';
    $timg = $_FILES['timg']['name'] ?? ''; // Get the uploaded file name
    $timg_temp = $_FILES['timg']['tmp_name']; // Get the temporary file path
    $upload_dir = '../images/'; // Directory to store the image

    // Check if any field is empty
    if (empty($tname) || empty($tdes) || empty($timg)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Move the uploaded image to the images folder
        $target_file = $upload_dir . basename($timg);
        
        if (move_uploaded_file($timg_temp, $target_file)) {
            // Prepare SQL query to insert data into the package table
            $sql = "INSERT INTO package (pack_name, pack_desc, pack_img, created_date) 
                    VALUES ('$tname', '$tdes', '$timg', NOW())";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Tour package added successfully.');</script>";
            } else {
                echo "<script>alert('Error: Could not add the tour package.');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the image.');</script>";
        }
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Tour</title>
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/add.css"> <!-- Ensure correct path -->
</head>
<body>
<section class="add_tour">
   <form action="pack_add.php" method="POST" enctype="multipart/form-data"> <!-- Ensure enctype is set -->
      <div class="add_tour-container">
         <div class="inputBox">
            <span>Tour Name:</span>
            <input type="text" id="tname" name="tname" placeholder="Enter tour Name" required>
         </div>
         <div class="inputBox">
            <span>Tour Description:</span>
            <textarea id="tdes" rows="5" name="tdes" placeholder="Tour Description" required></textarea>
         </div>
         <div class="inputBox">
            <span>Tour Image:</span>
            <input accept=".jpg,.png" id="timg" name="timg" type="file" required>
         </div>
         <button class="btn">Add</button>
      </div>
   </form>
</section>

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>

</body>
</html>