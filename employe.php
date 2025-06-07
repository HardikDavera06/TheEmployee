<?php
session_start();
require "nav.php";
require "config.php";
$Del = false;
$upN = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EMPLOYE ADMIN | EMPLOYE</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="employe.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sno = $_POST['sno'];
    $Name = $_POST['unm1'];
    $pass = $_POST['pwd1'];
    $date = $_POST['jd1'];
    $depa = $_POST['dep1'];
    $pac = $_POST['package1'];

    if (isset($_POST['sno'])) {
      if (isset($_POST['delete'])) { //* <----- Script For Delete The Employee ------->
        $id = $_POST['delete'];
        $delete = "DELETE FROM _emp_regi WHERE id = '$id'";
        $RUn = mysqli_query($con, $delete);
        if ($RUn)
          $Del = true;
        if ($Del == true) {
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
              toastr.success('Employe Deleted successfully', 'Admin!'); //*<--- Message For Performed Task Successfully ---->
            });
          </script>
          <?php
        }
      } else {
        if (isset($_POST['updateBtn'])) { //* <----- Script For Update The Employee -------> 
          $update = "UPDATE `_emp_regi` SET `Ename` = '$Name',`password` = '$pass',`Jdate` = '$date',`dep` = '$depa',`package` = '$pac' WHERE `_emp_regi`.`id` = '$sno'";
          $RUN = mysqli_query($con, $update);
          $upN = true;
          if (!$RUN)
            die("Not Working" . mysqli_error($con));
          if ($upN == true) {
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
                toastr.success('Information Updated successfully', 'Admin!'); //*<--- Message For Performed Task Successfully ---->
              });
            </script>
            <?php
          }
        }
      }
    }
  }
  ?>
  <!--//* Show Modal ------->
  <div class="modal fade" id="EDITmodal" aria-labelledby="EDITmodal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class=" modal-title fs-5 text-success" id="EDITmodal">Employe Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="dialog modal-body container">
          <form action="employe.php" method="post" class="form p-3 fw-semibold">
            <input type="hidden" name="sno" id="sno">

            <label for="unm1" class="text-dark"> Employe Name :</label>
            <input type="text" name="unm1" class=" inp form-control" id="unm1">

            <label for="pwd1" class="mt-3 text-dark"> Password :</label>
            <input type="text" name="pwd1" maxlength="8" minlength="6" class="inp form-control mt-1" id="pwd1">

            <label for="jd1" class="mt-3 text-dark"> Joing date :</label>
            <input type="date" name="jd1" class="inp form-control" id="jd1" value="<?php echo date('Y-m-j'); ?>"
              required>

            <label for="dep1" class="mt-3 text-dark"> Department :</label>
            <select name="dep1" id="dep1" class="inp form-control">
              <option value="Marketing">Marketing</option>
              <option value="Sales">Sales</option>
              <option value="Product">Product</option>
              <option value="Management">Management</option>
              <option value="Executive">Executive</option>
            </select>

            <label for="package1" class="mt-3 text-dark"> Package :</label>
            <input type="text" name="package1" maxlength="7" maxlength="4" class="inp form-control" id="package1">

            <button name="updateBtn" class="update_Btn fw-semibold my-3 mx-2 px-4 btn-sm rounded-2" id="editID">
              Edit
            </button>
            <button class="btn btn-danger btn-sm fw-3 rounded-2 " name="delete" id="editDelete"
              style="letter-spacing:1px;">
              Delete
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="tb container mt-5 mb-5">
      <h1 class="fw-semibold mb-1">Employes&nbsp; Detail</h1>
    </div>
    <table class="container table table-hover table-striped">
      <thead>
        <tr>
          <th>Serial No.</th>
          <th>Name</th>
          <th>Password</th>
          <th>Joing Date</th>
          <th>Department</th>
          <th>package</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!isset($_SESSION['admin_name'])) {
          ?>
        <tr>
          <td>1</td>
          <td>employee</td>
          <td>emp_pass</td>
          <td>2020-00-00</td>
          <td>emp_department</td>
          <td>emp_package</td>
          <td class="text-center">
            <button class="update_Btn fw-semibold fw-3 px-3 btn-sm rounded-2" id="editID">
              Edit
            </button>
            <button class="btn btn-danger btn-sm fw-3 rounded-2" id="editDelete" style="letter-spacing:1px;">
              Delete
            </button>
          </td>
        </tr>
        <?php } else {
          $admin_name = $_SESSION['admin_name'];
          $select = "SELECT * FROM `_emp_regi` where `admin`='$admin_name'";
          $Run1 = mysqli_query($con, $select);
          if (!$Run1)
            die("Not Working" . mysqli_error($con));
          $n = 1;
          while ($row = mysqli_fetch_assoc($Run1)) {
            ?>
        <tr>
          <td>
            <?php echo $n; ?>
          </td>
          <td>
            <?php echo $row['Ename']; ?>
          </td>
          <td>
            <?php echo $row['password']; ?>
          </td>
          <td>
            <?php echo $row['Jdate']; ?>
          </td>
          <td>
            <?php echo $row['dep']; ?>
          </td>
          <td>
            <?php echo $row['package']; ?>
          </td>
          <td class="text-center">
            <button class="editData btn" id="<?php echo $row['id']; ?>">Profile</button>
          </td>
        </tr>
        <?php
        $n++;
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <!--//* Source files for jqueryCDN and other CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script>
    //* dataTable jquery script */
    $(document).ready(function () {
      $("#myTable").DataTable();
    });

    //* <---- Edit feature ------> */
    edits = document.getElementsByClassName("editData");
    Array.from(edits).forEach((e) => {
      e.addEventListener("click", (y) => {
        tr = y.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[1].innerText;
        password = tr.getElementsByTagName("td")[2].innerText;
        jdate = tr.getElementsByTagName("td")[3].innerText;
        depart = tr.getElementsByTagName("td")[4].innerText;
        package = tr.getElementsByTagName("td")[5].innerText;
        unm1.value = name;
        pwd1.value = password;
        jd1.value = jdate;
        dep1.value = depart;
        package1.value = package;
        sno.value = y.target.id;
        editID.value = y.target.id;
        editDelete.value = y.target.id;
        //* <---- toggle for open modal -----> */
        $("#EDITmodal").modal("toggle");
      });
    });
  </script>

  <!--//* Include Footer -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" />

</body>

</html>