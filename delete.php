<?php
   $con = mysqli_connect("localhost","root","","_empadmin");
   if(!$con) die("Not connected".mysqli_connect_error());
   if(isset($_GET['id']))
   {
      $id = $_GET['id'];
      $delete = "DELETE FROM `_emp_regi` WHERE `id` = '$id'";
      $RUN = mysqli_query($con,$delete);
      if(!$RUN) die("not Working".mysqli_error($con));
      header("location:employe.php");
   }
?>