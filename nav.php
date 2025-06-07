<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nav1.css">
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>EMPLOYE ADMIN | NAVBAR</title>
</head>

<body>
    <?php
    $admin_name = '';
    $select = '';
    if (isset($_SESSION['admin_name'])) {
        $admin_name = $_SESSION['admin_name'];
        $select = "SELECT * FROM `_admin_regi` WHERE `name`='$admin_name'";
        $select_query = $con->query($select);
        $row1 = mysqli_fetch_assoc($select_query);
    }
    ?>
    <!--//* Modal For Display The Admin's Details -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class=" modal-title fs-5 text-success" id="editModal">Admin Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="dialog modal-body container">
                    <form method="post" action="nav.php" class="form p-3 fw-semibold">

                        <label for="AdName" class="text-dark"> Admin Name :</label>
                        <input type="text" name="AdName" value="<?php echo $row1['name']; ?>"
                            class=" nav-inp form-control" id="AdName" disabled>

                        <label for="CONTACT" class="mt-3 text-dark"> Contact Number</label>
                        <input type="text" name="CONTACT" maxlength="15" minlength="15"
                            value="<?php echo $row1['contact']; ?>" class="nav-inp form-control mt-1" id="CONTACT"
                            disabled>

                        <label for="mail" class="mt-3 text-dark"> E-Mail :</label>
                        <input type="text" name="mail" class="nav-inp form-control"
                            value="<?php echo $row1['email']; ?>" id="mail" disabled>

                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger mt-3"><a href="logout.php"
                                class="text-decoration-none text-light">Log Out</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav class="nav-head sticky-top py-2 shadow-sm rounded navbar navbar-expand-lg w-100">
        <div class=" container-fluid w-100">
            <a class="txt navbar-brand fw-semibold" href="index.php">NexGen</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="index2.php" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="registration.php" aria-current="page">Registration</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="employe.php" aria-current="page">Employes List</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="about.php" aria-current="page">About</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['admin_register'])) { //* <-- If Admin LoggedIn Then Show Admin's Details -->
                    ?>
                    <div class="mx-2 user-profile">
                        <div class="users name">
                            <span><?php echo $admin_name; ?></span>
                            <span>Admin</span>
                        </div>
                        <div>
                            <i class=" users fa-sharp fa-solid fa-circle-user fa-2xl" style="color: #7e22ce;"></i>
                        </div>
                    </div>
                    <?php
                } else { //* <--- If Not Login, Show The Login/Register Buttons ---->
                    ?>
                    <div class="login-register">
                        <a href="signin.php" class="login-nav-btn btn">Log In</a>
                        <a href="signup.php" class="regi-nav-btn btn ">Register</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>

    <script>
        users = document.getElementsByClassName('users');
        Array.from(users).forEach((e) => {
            e.addEventListener("click", (h) => {
                $("#editModal").modal("toggle");
            });
        });
    </script>

</body>

</html>