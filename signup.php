<?php
session_start();
$signup = false;
$_SESSION['count_error'] = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EMPLOYE ADMIN | SIGN UP </title>
   <link rel="stylesheet" href="signup.css">
   <link rel="stylesheet" href="boot.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<?php
require "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $aname = trim($_POST['Anm']);
   $pwd = $_POST['pwd'];
   $rpwd = $_POST['Rpwd'];
   $Email = $_POST['email'];
   $coN = $_POST['contact'];

   //* <--- Check Admin Already Registered Or Not--> 
   $selct = "SELECT * FROM _admin_regi where `name`='$aname' AND `contact`='$coN' AND `email`='$Email'";
   $run = mysqli_query($con, $selct);
   $NumExitscheck = mysqli_num_rows($run);
   if ($NumExitscheck == 1) {
      ?>
      <script type="text/javascript">
         $(document).ready(function () {
            toastr.options = {
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
            toastr.error('Admin Already Existed', 'OOPS!');
         });
      </script>
      <?php
   } else {
      // * <--- Insert New Admin -->
      if ($pwd == $rpwd) {
         $Hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
         $Hashrpwd = password_hash($rpwd, PASSWORD_DEFAULT);
         $insert = "INSERT INTO `_admin_regi` (`name`, `password`, `re-type password`, `contact`, `email`) VALUES ('$aname', '$Hashpwd', '$Hashrpwd', '$coN', '$Email')";
         $run = mysqli_query($con, $insert);
         if (!$run)
            die("not working" . mysqli_error($con));
         if (mysqli_affected_rows($con) == 1) {
            header("location:index2.php");
            $_SESSION['admin_register'] = 1; //* <-- Use For Display Message On Page For Success Register
            $_SESSION['admin_name'] = $aname; //* Store The New Admin Name
         }
      } else {
         ?>
         <script type="text/javascript">
            $(document).ready(function () {
               toastr.options = {
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
               toastr.error('Passwords Do Not Match', 'ERROR!');
            });
         </script>
         <?php
      }
   }
}
if (isset($_SESSION['upto_count_error'])) { //* <--- Redirected From The signin Because Admin's Signin Limits Sre Over ---->
   if ($_SESSION['upto_count_error'] == 0) {
      ?>
      <script type="text/javascript">
         $(document).ready(function () {
            toastr.options = {
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
            toastr.error('Register Now,You entered wrong signIn credentials', 'Admin!');
         });
      </script>
      <?php
   }
   $_SESSION['upto_count_error']++; //* Increase Number, Because Message Show Only One Time
}
?>

<body>
   <div class="wrapper">
      <div class="title" title="SIGN UP">
         SIGN UP
      </div>
      <form action="signup.php" method="post">
         <div class="field" title="Add Admin name">
            <input type="text" id="Anm" name="Anm" required autofocus>
            <label for="Anm">Admin Name</label>
         </div>
         <div class="row">
            <div class="col-6">
               <div class="field" title="Add Password">
                  <input type="password" minlength="6" id="pwd" maxlength="8" id="pass" name="pwd" required>
                  <label for="pwd">Password</label>
               </div>
            </div>
            <div class="col-6">
               <div class="field" title="Add Password">
                  <input type="password" minlength="6" id="rpwd" maxlength="8" id="rpass" name="Rpwd" required>
                  <label for="rpwd">Confirm Password</label>
               </div>
            </div>
         </div>
         <div class="field" title="Add Email">
            <input type="email" name="email" id="email" required>
            <label for="email">Email</label>
         </div>

         <div class="row">
            <div class="col-md-3">
               <div class="field" title="Add contact">
                  <input type="text" name="contact" id="contact1" value="+91 " disabled>
               </div>
            </div>
            <div class="col-md-9">
               <div class="field" title="Add contact">
                  <input type="text" name="contact" id="contact" maxlength="10" id="contact" required>
                  <label for="contact">Contact Number</label>
               </div>
            </div>
         </div>

         <div class="field" title="click now">
            <input type="submit" value="SIGN UP">
         </div>
         <div class="signup-link" title="Sign in now">
            Already a member? <a href="signin.php">signIn now</a>
         </div>
      </form>
   </div>

   <!-- //* CDN for toastr -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" />
   <script>
      let contact = document.querySelector("#contact");
      let regContact = /[^0-9]/g;
      contact.addEventListener("input",()=>{
         contact.value = contact.value.replace(regContact,"");
      });   
   </script>
</body>

</html>