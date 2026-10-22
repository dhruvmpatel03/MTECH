<?php
include "authguard.php"; // Ensures the user is authenticated
include "nav.php";       // Navigation bar (if applicable)
include "../shared/connection.php"; // Include the database connection

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
    <title>Customer Profile</title>
       <style>
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--white);
            box-shadow: var(--box-shadow);
            border-radius: 1rem;
        }

        .profile-container h2 {
            font-size: 3rem;
            color: #8e44ad;;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 1.6rem;
            color: var(--black);
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 1.2rem;
            font-size: 1.6rem;
            border: var(--border);
            border-radius: 0.5rem;
            color: var(--black);
            background: var(--light-bg);
        }

        .form-group input:readonly {
            background: var(--light-white);
        }
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
        </form>
    </div>
</body>
</html>
