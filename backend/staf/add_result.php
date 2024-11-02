
<?php
	session_start();
	include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $staf_id = $_SESSION['staf_id'];
  if(isset($_POST['save'])){
    $className=$_POST['className'];
    $course_id=$_POST['course_id'];
    $pat_id=$_POST['pat_id'];
    $midresult=$_POST['midresult'];
    $finalresult=$_POST['finalresult'];
    
    
   
    
    //sql to insert captured values
    // $w="SELECT * FROM tblresult";
    // $w = mysqli_query($mysqli, $query);
    
    // if(pat_id==$pat_id && course_id==$course_id){
    //   echo'same input';
    // } 
    $query="INSERT INTO sresult (pat_id,class_name,course_id, midresult, finalresult ) values(?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssss', $pat_id, $className, $course_id, $midresult, $finalresult);
    $stmt->execute();
    
    
    /*
    *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
    *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
    */ 
    //declare a varible which will be passed to alert function
    if($stmt)
    {
        $success = "result Details Added";
    }
    else {
        $err = "Please Try Again Or Try Later";
    }
    
    
}
if (isset($_GET['result_id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $result_id= $_GET['result_id'];
       
        
        // $query=mysqli_query($mysqli,"select * from sresult where result_id ='$result_id'");
        // $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
          $className=$_POST['className'];
          $course_id=$_POST['course_id'];
          $pat_id=$_POST['pat_id'];
          $midresult=$_POST['midresult'];
          $finalresult=$_POST['finalresult'];
           

            $query=mysqli_query($mysqli,"UPDATE sresult SET pat_id ='$pat_id' ,class_name='$className', course_id = '$course_id', midresult='$midresult',finalresult='$finalresult'  where result_id='$result_id'");

            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"add_result.php\")
                </script>"; 
                $statusMsg ="UPDATED SECCESSFULY";
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

if (isset($_GET['result_id']) && isset($_GET['action']) && $_GET['action'] === "delete") {
  $result_id = $_GET['result_id'];

  $query = "DELETE FROM sresult WHERE result_id = $result_id";
  $result = $mysqli->query($query);

  if ($result) {
      echo "<script type='text/javascript'>
              window.location.href = 'add_result.php';
            </script>";
      exit;
  } else {
      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error occurred!</div>";
  }
}

    

//---------------------------------------EDIT-------------------------------------------------------------

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Result</a></li>
                                            <li class="breadcrumb-item active">Add Result</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Result</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="header-title">Fill all fields</h3><br><br>
                                             
                  <form method="post">     
                  <div class="form-group row mb-3">
                  <div class="col-xl-6">
                      <label class="form-control-label">Select admissionNumber<span class="text-danger ml-2">*</span></label>
                      <?php
                    $qry = "SELECT * FROM his_students
                            INNER JOIN his_staf ON his_staf.classId = his_students.classId
                            WHERE his_staf.staf_id = '$staf_id' AND his_students.classId = his_staf.classId
                            ORDER BY his_students.admissionNumber ASC";

                    $result = $mysqli->query($qry);
                    $num = $result->num_rows;
                    if ($num > 0) {
                        echo ' <select required name="pat_id" id="admissionNumber" class="form-control mb-3" onchange="updateAdmissionNumberTitle()">';
                        echo '<option value="">--Select admissionNumber--</option>';
                        while ($rows = $result->fetch_assoc()) {
                            echo '<option value="' . $rows['pat_id'] . '">' . $rows['admissionNumber'] . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>

                  </div>
                  <div class="col-xl-6">
                      
  <?php
    $qry = "SELECT tblclass.className FROM his_students
            INNER JOIN his_staf ON his_staf.classId = his_students.classId
            INNER JOIN tblclass ON tblclass.Id=his_students.classId
            WHERE his_staf.staf_id = '$staf_id'";

    $result = $mysqli->query($qry);
    $num = $result->num_rows;

    if ($num >0) {
        while ($rows = $result->fetch_assoc()) {
            echo '<input type="hidden" name="className" id="className" class="form-control mb-3" value="' . $rows['className'] . '">';
            break;
        }
    }
  ?>
                      
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label class="form-control-label">Select course<span class="text-danger ml-2">*</span></label>
                      <?php
    $qry = "SELECT * FROM course
            JOIN his_staf ON his_staf.staf_dept = course.course_name
           
            WHERE his_staf.staf_id = '$staf_id'";

    $result = $mysqli->query($qry);
    $num = $result->num_rows;

    if ($num >0) {
        while ($rows = $result->fetch_assoc()) {
           echo '<input type="hidden" name="course_id" id="course_id" class="form-control mb-3" value="' . $rows['course_id'] . '" >';
            echo '<input type="text" name="" id="course_id" class="form-control mb-3" value="' . $rows['course_name'] . '" readonly>';
            break;
        }
    }
  ?>
                  </div>
                  <div class="form-group col-md-6">
                      <label class="form-control-label">mid result<span class="text-danger ml-2">*</span></label>
                      <input type="number" name="midresult" id="midresult" class="form-control mb-3" required max="50">
                  </div>
                  <div class="form-group col-md-6">
                      <label class="form-control-label">final result<span class="text-danger ml-2">*</span></label>
                      <input type="number" name="finalresult" id="finalresult" class="form-control mb-3" required max="50">
                  </div>
              </div>

      
  
  <?php
  if (isset($result_id))
  {
    ?>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    } else {           
    ?>
    <button type="submit" name="save" class="btn btn-primary">Save</button>
    <?php
    }         
    ?>
</form>
       
</div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="page-title">All Results</h4>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                    <tr><th>#</th>
                                      <th>Student Name</th>
                                        <th>Class</th>
                                        <th>course</th>
                                        <th>Mid 50%</th>
                                        <th>Final 50%</th>
                                        <th>total 100%</th>
                                        <th>Action</th>
                                      </tr></thead>
                    
          
                    <?php
                          
                              $query = "SELECT sresult.result_id, sresult.midresult, his_students.pat_fname,his_students.pat_lname,  sresult.class_name,
                              course.course_name, sresult.finalresult
                              FROM sresult
                              INNER JOIN his_students ON sresult.pat_id = his_students.pat_id
                              
                              INNER JOIN course ON course.course_id=sresult.course_id
                              
                              ORDER BY sresult.pat_id ASC
                              -- WHERE tblresult.classId=
                              ";
                              
                    $result = mysqli_query($mysqli, $query);     
                    $sn=0;  
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            // Create the table header
                        
                            
                            // Iterate over each row of data
                            while ($row = mysqli_fetch_assoc($result)) {

                              $mid = $row['midresult'];
                              $final = $row['finalresult'];
                              $sum=$mid+$final;
                              $sn = $sn + 1;
                                // Display each row in a table format
                                echo " <tbody><tr>
                                        <td>".$sn."</td>
                                        <td>".$row['pat_fname']." ".$row['pat_fname']."</td>
                                        
                                        <td>".$row['class_name']."</td>
                                        <td>".$row['course_name']."</td>
                                        <td>".$row['midresult']."</td>
                                        <td>".$row['finalresult']."</td>
                                        <td>$sum</td>
                                        <td><a href='?action=edit&result_id=".$row['result_id']."'><i class='fas fa-fw fa-edit'></i>Edit</a>
                                        <a href='?action=delete&result_id=".$row['result_id']."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                                    
                                      </tr></tbody>";
                            }
                    
                            // Close the table
                           
                            
                        } 
                        
                        else {
                          echo   
                          "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                        }
                    } else {
                        echo "Error executing the query: " . mysqli_error($mysqli);
                    
                    }?>
                     
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div> <!-- end card-box -->
          </div> <!-- end col -->
          <!--Row-->

       

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include('assets/inc/footer.php');?>
      <!-- Footer -->
    </div>
  </div>

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