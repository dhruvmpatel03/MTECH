<head>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <style>
      /* Style for dropdown */
      .dropdown {
         position: relative;
         display: inline-block;
      }

      .dropdown-btn {
         display: inline-block;
         color: black;
         text-decoration: none;
         padding: 10px 20px;
         font-size: 16px;
      }

      .dropdown-content {
         display: none;
         position: absolute;
         background-color: white;
         min-width: 160px;
         box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
         z-index: 1;
      }

      .dropdown-content a {
         color: white;
         padding: 12px 16px;
         text-decoration: none;
         display: block;
         font-size: 14px;
      }

      .dropdown-content a:hover {
         background-color: purple;
      }

      .dropdown:hover .dropdown-content {
         display: block;
      }

      /* Optional: to add a down arrow icon to 'My Account' */
      .dropdown-btn i {
         margin-left: 5px;
      }

      /* General styling for header */
      .header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 20px;
         background-color: #f0f0f0;
      }

      .navbar a {
         margin: 0 15px;
         text-decoration: none;
         color: black;
         font-size: 18px;
      }

      #menu-btn {
         display: none;
         font-size: 24px;
         cursor: pointer;
      }

      /* Responsive styling */
      @media (max-width: 768px) {
         .navbar {
            display: none;
            flex-direction: column;
            background-color: white;
            position: absolute;
            top: 80px;
            right: 20px;
            width: 100%;
            z-index: 1;
            text-align: center;
         }

         .navbar.active {
            display: flex;
         }

         #menu-btn {
            display: block;
         }

         .dropdown-content {
            position: static;
            min-width: 100%;
         }

         .dropdown-content a {
            text-align: left;
         }

         .header {
            position: relative;
            justify-content: space-between;
         }

         .dropdown {
            display: block;
            width: 100%;
         }

         .dropdown-btn {
            width: 100%;
            text-align: left;
            padding-left: 20px;
         }
      }
   </style>
</head>

<body>
   <!-- header section starts  -->
   <section class="header">
      <a href="home.php" class="logo">travel.</a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="package.php">package</a>
         <a href="book.php">book</a>

         <!-- Dropdown menu for 'My Account' -->
         <div class="dropdown">
            <a href="#" class="dropdown-btn">my account <i class="fas fa-caret-down"></i></a>
            <div class="dropdown-content">
               <a href="profile.php">profile</a>
               <a href="my_booking.php">my bookings</a>
               <a href="changepass.php">change password</a>
               <a href="../shared/logout.php">logout</a>
            </div>
         </div>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>
   </section>
   <!-- header section ends -->

   <!-- JavaScript to toggle the mobile menu -->
   <script>
      const menuBtn = document.getElementById('menu-btn');
      const navbar = document.querySelector('.navbar');

      menuBtn.addEventListener('click', () => {
         navbar.classList.toggle('active');
      });
   </script>
</body>
