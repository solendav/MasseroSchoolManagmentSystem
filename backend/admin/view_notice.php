<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['ad_id'];

  if(isset($_POST['search'])) {
    $searchDate = $_POST['searchDate'];
    // Retrieve notices for the specified date
    $query = "SELECT * FROM notice WHERE DATE(created_date) = '$searchDate'  ORDER BY created_date DESC";
    $notice_rs = $mysqli->query($query);
    $notice_num = $notice_rs->num_rows;
} else {
    // Retrieve notices for the current page
    $query = "SELECT * FROM notice  ORDER BY created_date DESC";
    $notice_rs = $mysqli->query($query);
    $notice_num = $notice_rs->num_rows;
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Notice Board</title>   
<?php include('assets/inc/head.php');?>
<head>
<style>
        #notice-container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
        }

        #notice-container h2 {
            text-align: center;
        }

        #notice-container ul {
            list-style-type: none;
            padding: 5px;
        }

        #notice-container li {
            margin-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="date"] {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            padding: 8px 16px;
            border-radius: 3px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .notice-item {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius:5px;
        }

        .notice-item h3 {
            margin: 0;
        }

        .notice-item p {
            margin: 5px 0 0 0;
        }
    </style>
</head>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                                            <li class="breadcrumb-item active">View Patients</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                   
               

 

    <div id="notice-container">
        <h2>Notice Board</h2>
        <form method="post">
            <label for="searchDate">Search by Date:</label>
            <input type="date" id="searchDate" name="searchDate">
            <button type="submit" name="search">Search</button>
        </form>
        <ul id="notice-list">
            <?php
            // Database configuration
          
            // Create a new PDO instance
           
                // Retrieve notices from the database
              
                      if($notice_num > 0)
                      { 
                       while( $rows = $notice_rs->fetch_assoc()){
                        $toWhom = $rows['towhom'];
                        $title = $rows['title'];
                       
                        $discription = $rows['discription'];
                        $Date = $rows['created_date'];
                      echo"  <h4> For All $toWhom's</h4>
                        <li><h5  >LATEST NEWS ON - <spam style='color:blue;'>$Date</spam> <h5>
                            <div class='notice-item'>
                                
                                <h4 style='text-align:center;'> $title</h4>
                                <p> $discription</p>
                            </div>
                            <hr>
                        </li> ";
}

                      }else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                   
               
            
            
            ?>
        </ul>
    </div>


                                    
                                  <!-- end .table-responsive-->
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