<?php
include "../shared/connection.php"; // Include your database connection
include "authguard.php"; // Include authentication guard
include "nav.php"; // Include navigation bar

// Fetch the package ID from the query string
if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Fetch the current package data
    $query = "SELECT * FROM package WHERE pack_id = $package_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $package = mysqli_fetch_assoc($result);

    if (!$package) {
        echo "<script>alert('Package not found.'); window.location.href='manage.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='manage.php';</script>";
    exit;
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tname = $_POST['tname'];
    $tdes = $_POST['tdes'];
    $timg = $_FILES['timg']['name'] ?? ''; // New uploaded image
    $timg_temp = $_FILES['timg']['tmp_name'];

    $upload_dir = '../images/'; // Directory to store the image
    $target_file = '';

    // Update query based on whether a new image is uploaded
    if (!empty($timg)) {
        $target_file = $upload_dir . basename($timg);

        if (move_uploaded_file($timg_temp, $target_file)) {
            $query = "UPDATE package SET pack_name='$tname', pack_desc='$tdes', pack_img='$timg' WHERE pack_id=$package_id";
        } else {
            echo "<script>alert('Image upload failed.');</script>";
        }
    } else {
        // If no new image is uploaded, update only name and description
        $query = "UPDATE package SET pack_name='$tname', pack_desc='$tdes' WHERE pack_id=$package_id";
    }

    // Execute the update query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Package updated successfully.'); window.location.href='manage.php';</script>";
    } else {
        echo "<script>alert('Error: Could not update the package.');</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Tour</title>
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/add.css"> <!-- Ensure correct path -->
</head>
<body>
<section class="add_tour">
   <form action="edit.php?id=<?php echo $package_id; ?>" method="POST" enctype="multipart/form-data">
      <div class="add_tour-container">
         <div class="inputBox">
            <span>Tour Name:</span>
            <input type="text" id="tname" name="tname" value="<?php echo htmlspecialchars($package['pack_name']); ?>" required>
         </div>
         <div class="inputBox">
            <span>Tour Description:</span>
            <textarea id="tdes" rows="5" name="tdes" required><?php echo htmlspecialchars($package['pack_desc']); ?></textarea>
         </div>
         <div class="inputBox">
            <span>Tour Image:</span>
            <input accept=".jpg,.png" id="timg" name="timg" type="file">
            <p>Current Image: <img src="../images/<?php echo htmlspecialchars($package['pack_img']); ?>" width="100" /></p>
         </div>
         <button class="btn">Update</button>
      </div>
   </form>
</section>
</body>
</html>
