
<?php
use Dompdf\Css\Style;
	session_start();
	include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $ad_id = $_SESSION['ad_id'];

?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">
    
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                                            <li class="breadcrumb-item active">View Attendance</li>
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
                              
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                            <div class="col-xl-6">
                                            <label class="form-control-label">Date<span class="text-danger ml-2">*</span></label>
                                            <input type="date" class="form-control" name="Date" value="<?php echo $row['className'];?>"  ><br><br>
                                             </div>

                                             
                    
                                        <button type="submit" name="save" class="btn btn-primary">View Attendance</button>
                                           

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
             
                 
                
                <?php   
                if(isset($_POST['save'])){

                  $date=$_POST['Date'];
          echo"         <div class='card mb-4'>
                  <div class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>
                  <h4 class='page-title'>All Attendance in  $date </h4>
                  </div>
                  <div class='table-responsive p-3'>
    <table class='table align-items-center table-flush table-hover' id='dataTableHover'>
                    <thead class='thead-light'>
                      <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Admission Number</th>
                        <th>Class Name</th>
                        <th>Section</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                  
                    <tbody>
                 
                
                  <tbody>";
                  $query = "SELECT his_students.pat_fname,his_students.pat_lname ,tblattendance.admissionNo,tblclass.className,
                  tblclassarms.classArmName, tblattendance.status,tblattendance.dateTimeTaken
                   FROM tblattendance
                   INNER JOIN his_students ON his_students.admissionNumber=tblattendance.admissionNo
                   INNER JOIN tblclass ON tblclass.Id=tblattendance.classId
                   INNER JOIN tblclassarms ON tblclassarms.Id=tblattendance.classArmId
                   
                   WHERE tblattendance.dateTimeTaken='$date'
                   
                   ";
                  $rs = $mysqli->query($query);
                  if (!$rs){
                    echo "Error executing the query: " . mysqli_error($mysqli);
                  }
                  $num = $rs->num_rows;
                  $sn=0;
                 
                  if($num > 0)
                  { 
                    while ($rows = $rs->fetch_assoc())
                      {
                         $sn = $sn + 1;
                         
                         if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                        echo"
                          <tr>
                            <td>".$sn."</td>
                            <td>".$rows['pat_fname']." ".$rows['pat_lname']."</td>
                            <td>".$rows['admissionNo']."</td>
                            <td>".$rows['className']."</td>
                            <td>".$rows['classArmName']."</td>
                            <td style='background-color:".$colour."'>".$status."</td>
                            
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
                  
 
 
 
 
 
 
 
 
 
 
 
 
  }?>
              
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