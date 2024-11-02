
<?php
	session_start();
	include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $staf_id = $_SESSION['staf_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">

  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>
    <!--Head-->
    <?php include('assets/inc/head.php');?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="his_staf_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                                            <li class="breadcrumb-item active">take Attendance </li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">  
                                       
                                <div class="card-body">        
                  <form method="post">     
                 
  <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1><br>
  <h4 style="color:red; text-align: right;"> check the box to take Ateendance</h4><br>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
      <tr>
        <th>Student Name</th>
        <th>Admission Number</th>
        <th>Class Name</th>
        <th>Section</th>
        <th>Present</th>
      </tr>
      <?php
      // Check if the form was submitted
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Display a success message
        echo "<p>Attendance submitted!</p>";
      }

      // Retrieve data from the table "his_Students"
      $sql = "SELECT his_students.admissionNumber, tblclass.className, tblclassarms.classArmName, his_students.pat_fname, his_students.pat_lname
              FROM his_students
              INNER JOIN tblclass ON tblclass.Id = his_students.classId
              INNER JOIN tblclassarms ON tblclassarms.Id = his_students.classArmId
              INNER JOIN his_staf ON his_staf.classId = his_students.classId
              WHERE his_staf.staf_id = ?";

      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s", $staf_id);
      $stmt->execute();
      $result = $stmt->get_result();

      // Display the data in the table with checkboxes
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $admissionNumber = $row["admissionNumber"];
          echo '<tr>';
          echo '<td>' . $row["pat_fname"] . ' ' . $row["pat_lname"] . '</td>';
          echo '<td>' . $row["admissionNumber"] . '</td>';
          echo '<td>' . $row["className"] . '</td>';
          echo '<td>' . $row["classArmName"] . '</td>';

          // Check if the checkbox is checked
          $checked = isset($_POST["attendance"][$admissionNumber]) ? 'checked' : '';

          echo '<td><input type="checkbox" name="attendance[' . $admissionNumber . ']" value="1" ' . $checked . '></td>';
          echo '</tr>';

          // Check if the form was submitted
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Prepare the SQL statement
            $stmt = $mysqli->prepare("INSERT INTO tblattendance (admissionNo, classId, classArmId, status, dateTimeTaken) VALUES (?,?,?,?,?)");

            // Fetch classId and classArmId from his_Students table
            $fetchStmt = $mysqli->prepare("SELECT classId, classArmId FROM his_students WHERE admissionNumber = ?");
            $fetchStmt->bind_param("s", $admissionNumber);
            $fetchStmt->execute();
            $fetchStmt->bind_result($classId, $classArmId);
            $fetchStmt->fetch();
            $fetchStmt->close();

            // Determine the status value based on whether the checkbox is checked or not
            $statusValue = isset($_POST["attendance"][$admissionNumber]) ? 1 : 0;

            // Get the current date and time
            $currentDateTime = date("Y-m-d");

            $stmt->bind_param("sssis", $admissionNumber, $classId, $classArmId, $statusValue, $currentDateTime);
            $stmt->execute();
            $stmt->close();
          }
        }
      } else {
        echo '<tr><td colspan="5">No students found.</td></tr>';
      }

     
      ?>
      
    </table>

    <button type="submit"class="btn btn-primary">Take Attendance</button>
  </form>
  
                </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

               

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include('assets/inc/footer.php');?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!--Load CK EDITOR Javascript-->
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>
       
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>