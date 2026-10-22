<style>
   /* Reset and global styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f0f0;
}

/* Sidebar styling */
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #8e44ad;
    position: fixed;
    padding-top: 20px;
}

.sidebar h2 {
    color: white;
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 15px;
    position: relative; /* Required for positioning the drop-right menu */
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
}

.sidebar ul li:hover {
    background-color: #ba62df;
}

/* Dropdown menu styling */
.sidebar ul li.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu {
   display: none;
    position: absolute;
    top: 0;
    left: 100%; /* This makes the menu appear to the right */
    background-color: #ba62df;
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: 200px; /* Adjust width as needed */
    z-index: 1;
}

.dropdown-menu li a {
    padding: 10px 15px;
    display: block;
    color: white;
    text-decoration: none;
}

.dropdown-menu li a:hover {
    background-color: #dba0f0;
}
.main-content {
    margin-left: 250px;
    padding: 20px;
}
.header {
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 20px;
    text-align: right;
}

.header a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
}


</style>
<div class="sidebar">
        <h2>Travel.</h2>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li class="dropdown">
            <a href="pack_add.php">New Package</a>
            <ul class="dropdown-menu">
                <li><a href="pack_add.php">Add Package</a></li>
                <li><a href="manage.php">Manage Package</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="allbook.php">Booking</a>
            <ul class="dropdown-menu">
                <li><a href="allbook.php">All Booking</a></li>
                <li><a href="approve.php">Approved Booking</a></li>
                <li><a href="cancel.php">Cancelled Booking</a></li>
            </ul>
        </li>
        <li><a href="reguser.php">Reg Users</a></li>
        
    </ul>
    </div>
    <div class="main-content">
        <div class="header">
            <a href="profile.php">Profile</a>
            <a href="changepass.php">Change Password</a>
            <a href="../shared/logout.php">Logout</a>
        </div>