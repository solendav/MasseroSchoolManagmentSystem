<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $staf_id=$_SESSION['staf_id'];
  $staf_number = $_SESSION['staf_number'];

?>
<!DOCTYPE html>
<html lang="en">
    
    <!--Head Code-->
    <?php include("assets/inc/head.php");?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('assets/inc/sidebar.php');?>
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
                                    
                                    <h4 style="text-align:center;"class="page-title">Masero Secondary School Managment System</h4><br>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        

                        <div class="row">
                            <!--Start OutPatients-->
                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="">
                                                <i class="fas fa-users fa-2x text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    //code for summing up number of out patients 
                                                    $result ="SELECT count(*) FROM his_students  ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($student);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $student;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Students</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Out Patients-->


                            <!--Start InPatients-->
                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="">
                                                <i class="fas fa-chalkboard fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    /* 
                                                     * code for summing up number of assets,
                                                     */ 
                                                    $result ="SELECT count(*) FROM tblclass ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($class);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $class;?></span></h3>
                                                <a href="his_staf_account.php"> <p class="text-muted mb-1 text-truncate">class</p> </a>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end widget-rounded-circle-->
                            </div>
                            <!--End InPatients-->

                            <!--Start Pharmaceuticals-->
                            <div class="col-md-6 col-xl-4">
                            <a href="viewAttendance.php"> 
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="">
                                                <i class="fas fa-calendar fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    /* 
                                                     * code for summing up number of pharmaceuticals,
                                                     */ 
                                                    $result ="SELECT count(*) FROM tblattendance ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($att);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $att;?></span></h3>
                                                <p class="text-muted mb-1 text-truncate">Attendance</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div></a> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Pharmaceuticals-->
                            <div class="col-md-6 col-xl-4">
                            <a href="his_staf_account.php"> 
                                <div class="widget-rounded-circle card-box">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="">
                                            <i class=" fas fa-book fa-2x text-warning "></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <?php
                                                    /* 
                                                     * code for summing up number of pharmaceuticals,
                                                     */ 
                                                    $result ="SELECT count(*) FROM exam ";
                                                    $stmt = $mysqli->prepare($result);
                                                    $stmt->execute();
                                                    $stmt->bind_result($phar);
                                                    $stmt->fetch();
                                                    $stmt->close();
                                                ?>
                                                <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $phar;?></span></h3>
                                                  <p class="text-muted mb-1 text-truncate">Exam schedule</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div></a> <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Pharmaceuticals-->
                        
                            
                        
                        </div>

                        <div class="row">

                        <!--Start Vendors-->
                       
                        <div class="col-md-6 col-xl-6">
                                <a href="his_staf_account.php">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="">
                                                <i class=" fas fa-user fa-2x text-warning "></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">My Profile</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </a> <!-- end widget-rounded-circle-->
                            </div> 
                           <!-- end col--> 
                            <!--End Vendors-->  

                            <!--Start Corporation Assets-->
                            <div class="col-md-6 col-xl-6">
                                <a href="his_staf_view_payrolls.php">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="">
                                                <i class="mdi mdi-cash fa-2x refund "></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 class="text-dark mt-1"></span></h3>
                                                    <p class="text-muted mb-1 text-truncate">My Payroll</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </a>     <!-- end widget-rounded-circle-->
                            </div> <!-- end col-->
                            <!--End Corporation Assets-->
                        </div>
                        

                        
                        <!--Recently Employed Employees-->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Students</h4>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover table-centered m-0">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Student Name</th>
                                                <th data-hide="phone">admission Number</th>
                                                <th data-hide="phone">Student Address</th>
                                                <th data-hide="phone">Student Phone</th>
                                                <th data-hide="phone"> Age</th>
                                                <th data-hide="phone"> Gender</th>
                                                <th data-hide="phone">Class </th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *get details of allStudents
                                                *
                                            */
                                             
                                                $ret = "SELECT his_students.pat_fname,his_students.pat_lname,his_students.admissionNumber,his_students.pat_addr,his_students.pat_phone,
                                               his_students.pat_age ,tblclass.className,his_students.s_gender,his_students.pat_id
                                                FROM his_students
                                                INNER JOIN tblclass ON tblclass.Id = his_students.classId";
                                                
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>

                                                <tbody>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?></td>
                                                    <td><?php echo $row->admissionNumber;?></td>
                                                    <td><?php echo $row->pat_addr;?></td>
                                                    <td><?php echo $row->pat_phone;?></td>
                                                    <td><?php echo $row->pat_age;?> Years</td>
                                                    <td><?php echo $row->s_gender;?></td>
                                                    <td><?php echo $row->className;?></td>
                                                    
                                                    <td><a href="his_staf_view_single_Student.php?pat_id=<?php echo $row->pat_id;?>&&admissionNumber=<?php echo $row->admissionNumber;?>&&pat_name=<?php echo $row->pat_fname;?>_<?php echo $row->pat_lname;?>" class="badge badge-success"><i class="mdi mdi-eye"></i> View</a></td>
                                                </tr>
                                                </tbody>
                                            <?php  $cnt = $cnt +1 ; }?>
                                        </table>
                                    </div>
                                </div>
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

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="dripicons-cross noti-icon"></i>
                </a>
                <h5 class="m-0 text-white">Settings</h5>
            </div>
            <div class="slimscroll-menu">
                <!-- User box -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                        <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                    </div>
            
                    <h5><a href="javascript: void(0);">Geneva Kennedy</a> </h5>
                    <p class="text-muted mb-0"><small>Admin Head</small></p>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h5 class="pl-3">Basic Settings</h5>
                <hr class="mb-0" />

                <div class="p-3">
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox1" type="checkbox" checked>
                        <label for="Rcheckbox1">
                            Notifications
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox2" type="checkbox" checked>
                        <label for="Rcheckbox2">
                            API Access
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox3" type="checkbox">
                        <label for="Rcheckbox3">
                            Auto Updates
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-2">
                        <input id="Rcheckbox4" type="checkbox" checked>
                        <label for="Rcheckbox4">
                            Online Status
                        </label>
                    </div>
                    <div class="checkbox checkbox-primary mb-0">
                        <input id="Rcheckbox5" type="checkbox" checked>
                        <label for="Rcheckbox5">
                            Auto Payout
                        </label>
                    </div>
                </div>

                <!-- Timeline -->
                <hr class="mt-0" />
                <h5 class="px-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
                <hr class="mb-0" />
                <div class="p-3">
                    <div class="inbox-widget">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-2.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-3.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-4.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                            <p class="inbox-item-text">Nice to meet you</p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-5.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/user-6.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                        </div>
                    </div> <!-- end inbox-widget -->
                </div> <!-- end .p-3-->

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
        <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.time.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.selection.js"></script>
        <script src="assets/libs/flot-charts/jquery.flot.crosshair.js"></script>

        <!-- Dashboar 1 init js-->
        <script src="assets/js/pages/dashboard-1.init.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>