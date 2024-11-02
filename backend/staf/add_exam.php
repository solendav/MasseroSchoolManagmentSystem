
<?php
	session_start();
	include('assets/inc/config.php');
  if(isset($_POST['save'])){
    
    $session_id=$_POST['session_id'];
    $term=$_POST['term'];
    $classId=$_POST['classId'];
    
    $courseId=$_POST['course_id'];
    $exam_type=$_POST['exam_type'];
    
    //sql to insert captured values
    
    $query="INSERT INTO exam (exam_type, course_id, term, classId, session_id ) values(?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssss', $exam_type, $courseId, $term, $classId, $session_id);
    $stmt->execute();
    
    
    /*
    *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
    *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
    */ 
    //declare a varible which will be passed to alert function
    if($stmt)
    {
        $success = "exam Details Added";
    }
    else {
        $err = "Please Try Again Or Try Later";
    }
    
    
}
if (isset($_GET['exam_id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $exam_id= $_GET['exam_id'];
       
        $query=mysqli_query($mysqli,"select * from exam where exam_id ='$exam_id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
            
            $session_id=$_POST['session_id'];
            $term=$_POST['term'];
            $classId=$_POST['classId'];
        
           $courseId=$_POST['course_id'];
           $exam_type=$_POST['exam_type'];

            $query=mysqli_query($mysqli,"UPDATE exam set course_id='$courseId',classId = '$classId', session_id='$session_id',term='$term', exam_type='$exam_type'  where exam_id='$exam_id'");

            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"add_exam.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

  if (isset($_GET['exam_id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $exam_id= $_GET['exam_id'];
      

        $query = mysqli_query($mysqli,"DELETE FROM exam WHERE exam_id='$exam_id'");

        if ($query == TRUE) {

                echo "<script type = \"text/javascript\">
                window.location = (\"add_exam.php\")
                </script>";  
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Exam</a></li>
                                            <li class="breadcrumb-item active">Add Exam</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Exam</h4>
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
                  <div class="form-row">       
                        <div class="form-group col-md-6">       
                        <label class="form-control-label">Select Session<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM tblsessionterm";
                        $result = $mysqli->query($qry);   
                        $num = $result->num_rows;		
                        if ($num > 0){       
                          echo ' <select required name="session_id" class="form-control mb-3">';
                          echo'<option value="">--Select session--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['sessionName'].'</option>';
                              }    
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                        <div class="form-group col-md-6">       
                        <label class="form-control-label">Select Term<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM tblterm";
                        $result = $mysqli->query($qry);   
                        $num = $result->num_rows;		
                        if ($num > 0){       
                          echo ' <select required name="term" class="form-control mb-3">';
                          echo'<option value="">--Select term--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['termName'].'</option>';
                              }    
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                            </div>
                            <div class="form-row">       
                        <div class="form-group col-md-6">       
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
                        <div class="form-group col-md-6">       
                        <label class="form-control-label">Select Course<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM course ";
                        $result = $mysqli->query($qry);   
                        $num = $result->num_rows;		
                        if ($num > 0){       
                          echo ' <select required name="course_id" class="form-control mb-3">';
                          echo'<option value="">--Select course--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['course_id'].'" >'.$rows['course_name'].'</option>';
                              }    
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                            </div>

             <div class="form-row"> 
                    
                            
                     <div class="form-group col-md-6">
                         <label for="inputState" class="col-form-label">Exam Type</label>
                            <select id="inputState" required="required" name="exam_type" class="form-control">
                                <option>Choose</option>
                                <option>Mid Exam</option>
                                <option>Final Exam</option>
                            </select>
                     </div>
              </div>

                        
                   
                    <?php
                    if (isset($exam_id))
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
                <h4 class="page-title">All Exams</h4>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                      <th>#</th>
                         <th>Exam Type</th>
                         <th>Course Name</th>
                         <th>Class    </th>
                         <th>Term    </th>
                         <th>Session</th>
                         <th>Delete</th>
                      </tr>
                    </thead>
                  
                    <tbody>

                    <?php
                      $query = "SELECT  exam.exam_id, exam.exam_type, course.course_name, tblsessionterm.sessionName, tblclass.className, 
                         tblterm.termName 
                      FROM exam
                      INNER JOIN tblclass ON tblclass.Id = exam.classId
                      INNER JOIN tblsessionterm ON tblsessionterm.Id = exam.session_id
                      INNER JOIN course ON course.course_id = exam.course_id 
                      INNER JOIN tblterm ON tblterm.Id = exam.term";
                     // $query ="SELECT* from exam";
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
                                <td>".$rows['exam_type']."</td>
                                <td>".$rows['course_name']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['termName']."</td>
                                <td>".$rows['sessionName']."</td> 
                                <td><a href='?action=edit&exam_id=".$rows['exam_id']."'><i class='fas fa-fw fa-edit'></i>Edit</a>
                                <a href='?action=delete&exam_id=".$rows['exam_id']."'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
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

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

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