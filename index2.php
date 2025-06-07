<?php 
   session_start();
   include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>EMPLOYE ADMIN | HOME</title>
</head>

<body>
   <?php
      if(isset($_SESSION['admin_register'])){
         if($_SESSION['admin_register']==1){
            ?>
               <script type="text/javascript">
                  $(document).ready(function() {
                     toastr.options={
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "show",
                        "hideMethod": "hide"
                     }
                     toastr.success('New Admin Registered!' ,'Successfully');
                  });
               </script>
            <?php
            $_SESSION['admin_register']++;
         }
      }
      if(isset($_SESSION['admin_login'])){
         if($_SESSION['admin_login'] == 1){
         ?>
               <script type="text/javascript">
                  $(document).ready(function() {
                     toastr.options={
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "show",
                        "hideMethod": "hide"
                     }
                     toastr.success('Admin LoggedIn!' ,'Successfully');
                  });
               </script>
            <?php
            $_SESSION['admin_login']++;
         }
      }
   ?>
   <div class="header-text">
      <div class="text">
         <p>Wel Come to <b>NexGen</b></p>
         <p class="subconten"> We provide a software for handle admin or back-end works , Gives sorting features or
               another and
               improve funcationality to manage your bulk amount of data.</p>
      </div>
      <div class="imag">
         <img src="admin-removebg.png" class="admin" alt="adminImg" height="550" width="550">
      </div>
   </div>

   <!--//* Include Footer  -->
   <?php include "footer.php"; ?>

   <!--//*Source files for jqueryCDN and other CDN , toastr css-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" />

</body>

</html>