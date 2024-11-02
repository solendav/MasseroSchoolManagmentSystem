
<?php
	session_start();
	include('assets/inc/config.php');
  $staf_id = $_SESSION['staf_id'];
  if(isset($_POST['save'])){
    
    $classId=$_POST['classId'];
    $classArmName=$_POST['classArmName'];
    $courseName=$_POST['course_name'];
    $courseCode=$_POST['course_code'];
    
    //sql to insert captured values
    $query="INSERT INTO course (course_name,  course_code, classArmId, classId) values(?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('ssss', $courseName,  $courseCode, $classArmName, $classId);
    $stmt->execute();
    /*
    *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
    *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
    */ 
    //declare a varible which will be passed to alert function
    if($stmt)
    {
        $success = "Student Details Added";
    }
    else {
        $err = "Please Try Again Or Try Later";
    }
    
    
}
if (isset($_GET['course_id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $course_id= $_GET['course_id'];

        $query=mysqli_query($mysqli,"select * from tblclassarms where Id ='$course_id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
          $classId=$_POST['classId'];
          $classArmName=$_POST['classArmName'];
          $courseName=$_POST['course_name'];
          $courseCode=$_POST['course_code'];

            $query=mysqli_query($mysqli,"update course set classId = '$classId', classArmId='$classArmName',course_name='$courseName',course_code='$courseCode' where course_id='$course_id'");

            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"course.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

  if (isset($_GET['course_id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $course_id= $_GET['course_id'];

        $query = mysqli_query($mysqli,"DELETE FROM tblclassarms WHERE course_id='$course_id'");

        if ($query == TRUE) {

                echo "<script type = \"text/javascript\">
                window.location = (\"course.php\")
                </script>";  
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
         }
      
  }
    

//---------------------------------------EDIT-------------------------------------------------------------









?>
<!--End Server Side-->
<!--End Patient Registration-->
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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Class Arms</a></li>
                                            <li class="breadcrumb-item active">Create Class Arms</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Create Class Arms</h4>
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
                    <div class="form-group row mb-3">       
                        <div class="col-xl-6">       
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $mysqli->query($qry);   
                        $num = $result->num_rows;		
                        if ($num > 0){       
                          echo ' <select required name="classId" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['className'].'</option>';
                              }    
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Class Arm Name<span class="text-danger ml-2">*</span></label>
                        <?php
                          $qry = "SELECT * FROM tblclassarms ";
                          
                        
                        $result = $mysqli->query($qry);   
                        $num = $result->num_rows;		
                        if ($num > 0){       
                          echo ' <select required name="classArmName" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['classArmName'].'</option>';
                              }    
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                    </div>
                    <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Course Name</label>
                                                    <input type="text" required="required" name="course_name" class="form-control" id="inputEmail4" placeholder="Course name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Course code</label>
                                                    <input required="required" type="text" name="course_code" class="form-control"  id="inputPassword4" placeholder="course code">
                                                </div>
                                            </div>
                                            <?php
                    if (isset($course_id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <button type="submit" name="save" class="btn btn-primary">Add exam</button>
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
                <h4 class="page-title">All Courses</h4>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                      <th>#</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                         <th>Class      </th>
                        <th>Class Arm    </th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                  
                    <tbody>

                    <?php
                      $query = "SELECT  course.course_id, course.course_name, course.course_code, tblclassarms.classArmName, tblclass.className
                      FROM course
                      INNER JOIN tblclass ON tblclass.Id = course.classId
                      INNER JOIN tblclassarms ON tblclassarms.Id = course.classArmId
                      INNER JOIN his_staf ON his_staf.classId = course.classId
                      where his_staf.staf_id='$staf_id'
                      ";
                     // $query ="SELECT* from course";
                      $rs = $mysqli->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['course_name']."</td>
                                <td>".$rows['course_code']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['classArmName']."</td> 
                                <td><a href='?action=edit&course_id=".$rows['course_id']."'><i class='fas fa-fw fa-edit'></i>Edit</a>
                                <a href='?action=delete&course_id=".$rows['course_id']."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div>
          <!--Row-->

       

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