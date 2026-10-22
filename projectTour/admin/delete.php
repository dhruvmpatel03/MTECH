<?php
include "../shared/connection.php"; // Include your database connection
include "authguard.php"; // Include authentication guard

// Fetch the package ID from the query string
if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Fetch the current package data to delete the image
    $query = "SELECT pack_img FROM package WHERE pack_id = $package_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $package = mysqli_fetch_assoc($result);

    // Delete the package's image file if it exists
    if ($package && !empty($package['pack_img'])) {
        $image_path = "../images/" . $package['pack_img'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the image file from the server
        }
    }

    // Delete the package from the database
    $query = "DELETE FROM package WHERE pack_id = $package_id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Package deleted successfully.'); window.location.href='manage.php';</script>";
    } else {
        echo "<script>alert('Error: Could not delete the package.'); window.location.href='manage.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='manage.php';</script>";
}

// Close the database connection
mysqli_close($conn);
?>
