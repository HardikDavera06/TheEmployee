<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYE ADMIN | REGISTRATION</title>
    <link rel="stylesheet" href="employe.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<?php
session_start();
include 'config.php';
include 'nav.php';
$inN = false;
$admin_name = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_employe'])) {  //* <---- Check Admin Is LoggedIn/Registered Or Not ---->
        if (isset($_SESSION['admin_register']) || isset($_SESSION['admin_login'])) {
            if (isset($_SESSION['admin_name']))
                $admin_name = $_SESSION['admin_name'];
            $eName = trim($_POST['unm']);
            $password = $_POST['pwd'];
            $Jdate = $_POST['jd'];
            $depart = $_POST['dep'];
            $package = trim($_POST['package']);

            //* <---- FOR CHECK DUPLICATE EMPLOYE ---->
            $select = "SELECT * FROM `_emp_regi` where `Ename`='$eName' AND `password`='$password' AND `admin`='$admin_name'";
            $run = mysqli_query($con, $select);
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
                        toastr.error('Employe Already Existed', 'Admin!');
                    });
                </script>
                <?php
            } else {
                //* <------ INSERT NEW EMPLOYES ------>
                $insert = "INSERT INTO `_emp_regi`(`Ename`, `password`, `Jdate`, `dep`, `package`,`admin`) VALUES ('$eName','$password','$Jdate','$depart','$package','$admin_name')";
                $Run = mysqli_query($con, $insert);
                $inN = true;
                if (!$Run)
                    die("Not Working" . mysqli_error($con));
                if ($inN == true) {
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
                            toastr.success('Employe Registerd Successfully', 'Admin!');
                        });
                    </script>
                    <?php
                }
            }
        } else { //* <---- If Not Logged/Registered Then Redirect To Signin ----->
            $_SESSION['redirect_for_false_crendentials'] = 0;
            ?>
            <script>
                window.location = "signin.php";
            </script>
            <?php
        }
    }
}
?>

<body>
    <div class="container mt-5">
        <form action="registration.php" method="post">
            <div class="title container mb-5">
                <h1 class="fw-semibold">Employe&nbsp; Registration</h1>
            </div>
            <label for="unm">&nbsp;Employe Name :</label>
            <input type="text" name="unm" class="in form-control mt-1 p-2" id="unm" placeholder="Enter Employe Name..."
                required>

            <label for="pwd" class="mt-3 ">&nbsp;Enter Password :</label>
            <input type="password" name="pwd" maxlength="8" minlength="6" class="in form-control mt-1 p-2" id="pwd"
                placeholder="Enter Password..." required>

            <label for="jd" class="mt-3 ">&nbsp;Enter Joing date :</label>
            <input type="date" name="jd" class="in form-control mt-1 p-2" id="jd" value="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>

            <label for="dep" class="mt-3 "> &nbsp;Entre Department :</label>
            <select name="dep" id="dep" class="in form-control mt-1 p-2">
                <option value="Marketing">Marketing</option>
                <option value="Sales">Sales</option>
                <option value="Product">Product</option>
                <option value="Management">Management</option>
                <option value="Executive">Executive</option>
            </select>

            <label for="package" class="mt-3">&nbsp;Enter Package :</label>
            <input type="text" name="package" class="in form-control mt-1 p-2" maxlength="7" maxlength="4" id="package"
                placeholder="Enter Package..." required>


            <input type="submit" value="Add Employee" name="add_employe" class="addEmp btn fw-semibold mt-3 mb-5">
            <input type="reset" value="Clear" class="btn btn-sm btn-outline-dark fw-semibold btn-light mt-3 mb-5">
        </form>
    </div>


    <!--//* Include Footer  -->
    <?php include "footer.php"; ?>

    <!--//*Source files for jqueryCDN and other CDN , toastr css-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>