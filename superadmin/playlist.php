<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>video playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">RSL Solution</a>

      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <img src="images/pic-1.jpg" class="image" alt="">
         <!-- <h3 class="name">Super Admin name</h3> -->
         <p class="role">Super Admin</p>
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
           
            <a href="../index.php" class="option-btn">logout</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <!-- <h3 class="name">Super Admin name</h3> -->
      <p class="role">Super Admin</p>
      <a href="profile.php" class="btn">view profile</a>
   </div>

</div>

<section class="playlist-details">

   <h1 class="heading">playlist details</h1>

   <div class="row">

      <div class="column">
         <form action="" method="post" class="save-playlist">
            <button type="submit"><i class="far fa-bookmark"></i> <span>save playlist</span></button>
         </form>
   
         <div class="thumb">
            <img src="images/thumb-1.png" alt="">
            <span>10 videos</span>
         </div>
      </div>
      <div class="column">

         <div class="details">
            <h3>complete HTML tutorial</h3>

            <p>
               This is a complete course on how to build websites using the HTML language.
               It includes all the
               basic elements of HTML such as headings, paragraphs, images and links.
               The course also covers advanced topics like forms, tables, lists etc.
               All this in an easy to follow manner with detailed explanations for each concept.
            </p>

         </div>
      
      </div>
   </div>

</section>

<section class="playlist-videos">

   <h1 class="heading">playlist videos</h1>

   <div class="box-container">

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-1.png" alt="">
         <h3>complete HTML tutorial (part 01)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-2.png" alt="">
         <h3>complete HTML tutorial (part 02)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-3.png" alt="">
         <h3>complete HTML tutorial (part 03)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-4.png" alt="">
         <h3>complete HTML tutorial (part 04)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-5.png" alt="">
         <h3>complete HTML tutorial (part 05)</h3>
      </a>

      <a class="box" href="watch-video.html">
         <i class="fas fa-play"></i>
         <img src="images/post-1-6.png" alt="">
         <h3>complete HTML tutorial (part 06)</h3>
      </a>

   </div>

</section>

<script src="js/script.js"></script>

<?php include 'sidebar.php'; ?>
   
</body>
</html>