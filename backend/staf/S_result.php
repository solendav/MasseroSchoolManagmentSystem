<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  //$aid=$_SESSION['ad_id'];
  $staf_id = $_SESSION['staf_id']
?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
                <?php include('assets/inc/nav.php');?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">result</a></li>
                                            <li class="breadcrumb-item active">View result</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Result Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >
                                            <div class="form-group mr-2" style="display:none">
                                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                                        <option value="">Show all</option>
                                                        <option value="Discharged"></option>
                                                        <option value="OutPatients"></option>
                                                        <option value="InPatients"></option>
                                                    </select>
                                                </div>
                                            <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr><th>#</th>
                                      <th>Student Name</th>
                                        <th>Class</th>
                                        <th>course</th>
                                        <th>Mid 50%</th>
                                        <th>Final 50%</th>
                                        <th>total 100%</th>
                                       
                                      </tr></thead>
                                            
                                      <?php
                          /*
                              *get details of alStudents
                              *
                          */
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
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                 <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>