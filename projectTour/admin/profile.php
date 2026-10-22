<?php
include "authguard.php"; // Ensures the user is authenticated
include "nav.php";       // Navigation bar (if applicable)
include "../shared/connection.php"; // Include the database connection

//session_start();

// Get the logged-in admin's userid from the session
$userid = $_SESSION['userid']; // Assuming 'admin_id' is stored in session after login

// Fetch the admin's profile data from the database
$query = "SELECT * FROM user WHERE userid = '$userid'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin_data = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Admin not found.'); window.location.href = 'home.php';</script>";
    exit;
}

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_name = mysqli_real_escape_string($conn, $_POST['adminName']);
    $username = mysqli_real_escape_string($conn, $_POST['userName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Update admin profile in the database
    $update_query = "UPDATE user SET 
                        username = '$username', 
                        email = '$email' 
                     WHERE userid = '$userid'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profile updated successfully.'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile.');</script>";
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
    <title>Admin Profile</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container for Profile */
        .profile-container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #8e44ad;
            margin-bottom: 20px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f5f5f5;
            color: #333;
            font-size: 16px;
        }

        input[readonly] {
            background-color: #e9ecef;
        }

        /* Submit Button
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #8e44ad;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #b356da;
        } */

    </style>
</head>
<body>

    <div class="profile-container">
        <h2>Admin Profile</h2>
        
        <form action="profile.php" method="post">
            <div class="form-group">
                <label for="adminName">Admin Name</label>
                <input type="text" id="adminName" name="adminName" value="<?php echo htmlspecialchars($admin_data['username']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="userName">User Name</label>
                <input type="text" id="userName" name="userName" value="<?php echo htmlspecialchars($admin_data['username']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin_data['email']); ?>" readonly>
            </div>

        
            <div class="form-group">
                <label for="regDate">Admin Registration Date</label>
                <input type="text" id="regDate" name="regDate" value="<?php echo htmlspecialchars($admin_data['created_date']); ?>" readonly>
            </div>

            <!-- <div class="form-group">
                <button type="submit" class="submit-btn">Update Profile</button>
            </div> -->
        </form>
    </div>

</body>
</html>
