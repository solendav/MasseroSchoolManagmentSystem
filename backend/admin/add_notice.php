
<?php
	session_start();
	include('assets/inc/config.php');
  if(isset($_POST['save'])){
    
    $towhom=$_POST['toWhom'];
    $title=$_POST['title'];
    $discription=$_POST['discription'];
    $date=date("m-d-Y");
    
    //sql to insert captured values
    
    $query="INSERT INTO notice (towhom, title, discription,created_date) values(?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('ssss', $towhom, $title, $discription,$date);
    $stmt->execute();
    
    
    /*
    *Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
    *echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
    */ 
    //declare a varible which will be passed to alert function
    if($stmt)
    {
        $success = "notice Details Added";
    }
    else {
        $err = "Please Try Again Or Try Later";
    }
    
    
}

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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">notice</a></li>
                                            <li class="breadcrumb-item active">Add notice</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add notice</h4>
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
                        <label class="form-control-label">To Whom<span class="text-danger ml-2"></span></label>
                        <select id="inputState" required="required" name="toWhom" class="form-control" placeholder="To Whom">
                                <option>Every one</option>
                                <option>Staf</option>
                                <option>Student</option>
                                
                            </select>
                        </div>
                       
                            </div>
                            <div class="form-row">       
                        <div class="form-group col-md-6">       
                        <label class="form-control-label">Title<span class="text-danger ml-2"></span></label>
                        <textarea name="title" id="discription" cols="80" rows="1" placeholder="Title"></textarea>
                        </div>
                        
                            </div>

             <div class="form-row"> 
                    
                            <div class="form-group col-md-6">       
                        <label class="form-control-label">Discription<span class="text-danger ml-2"></span></label>
                        <textarea name="discription" id="discription" cols="100" rows="10" placeholder="Discription..."></textarea>
                        </div>
                    
              </div>

                        
                   
                  
                    <button type="submit" name="save" class="btn btn-primary">Add Notice</button>
                  
                  </form>
                </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

               
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