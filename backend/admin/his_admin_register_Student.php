<!--Server side code to handle  Student Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_Student']))
		{
			$pat_fname=$_POST['pat_fname'];
			$pat_lname=$_POST['pat_lname'];
			$admissionNumber=$_POST['admissionNumber'];
            $pat_phone=$_POST['pat_phone'];
            $classId=$_POST['classId'];
            $pat_addr=$_POST['pat_addr'];
            $stu_pwd=$_POST['pat_pwd'];
            $ustu_pwd=$_POST['upat_pwd'];
            $pat_age = $_POST['pat_age'];
            $pat_dob = $_POST['pat_dob'];
            $s_gender = $_POST['s_gender'];
            $classArmId = $_POST['classArmId'];
            //sql to insert captured values
            if($stu_pwd = $ustu_pwd){
			$query="INSERT INTO his_students (pat_fname,  pat_lname, pat_age, stu_pwd, pat_dob, admissionNumber, pat_phone,  pat_addr, classId, classArmId, s_gender) values(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssssssss', $pat_fname,  $pat_lname, $pat_age,$stu_pwd, $pat_dob, $admissionNumber, $pat_phone,  $pat_addr, $classId, $classArmId, $s_gender);
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
        }else{
            $err = "Password Does'nt Mutch!!";
            
        }
       
		}
?>
<!--End Server Side-->
<!--End Student Registration-->
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                                            <li class="breadcrumb-item active">Add Student</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Student Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Student Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputEmail4" placeholder="Student's First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Last Name</label>
                                                    <input required="required" type="text" name="pat_lname" class="form-control"  id="inputPassword4" placeholder="Student`s Last Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Date Of Birth</label>
                                                    <input type="date" required="required" name="pat_dob" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Age</label>
                                                    <input required="required" type="text" name="pat_age" class="form-control"  id="inputPassword4" placeholder="Student`s Age">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                    <label for="inputState" class="col-form-label">Gender</label>
                                                    <select id="inputState" required="required" name="s_gender" class="form-control">
                                                        <option>Choose</option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputAddress" class="col-form-label">Address</label>
                                                <input required="required" type="text" class="form-control" name="pat_addr" id="inputAddress" placeholder="Student's Addresss">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress" class="col-form-label">Password</label>
                                                <input required="required" type="password" class="form-control" name="pat_pwd" id="inputAddress" placeholder="password">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress" class="col-form-label">confirm Password</label>
                                                <input required="required" type="password" class="form-control" name="upat_pwd" id="inputAddress" placeholder="password">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" name="pat_phone" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
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
                                                <div class="form-group col-md-4">
                                                <label class="form-control-label">Select Section<span class="text-danger ml-2">*</span></label>
                                            <?php
                                            $qry= "SELECT * FROM tblclassarms ";
                                            $result = $mysqli->query($qry);   
                                            $num = $result->num_rows;		
                                            if ($num > 0){       
                                            echo ' <select required name="classArmId" class="form-control mb-3">';
                                            echo'<option value="">--Select Class--</option>';
                                            while ($rows = $result->fetch_assoc()){
                                            echo'<option value="'.$rows['Id'].'" >'.$rows['classArmName'].'</option>';
                                                }    
                                                    echo '</select>';  
                                                }    
                                                ?>  
                                                </div>
                                                <div class="form-group col-md-2" style="display:none">
                                                    <?php 
                                                        $length = 5;    
                                                        $Student_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                    <label for="inputZip" class="col-form-label">Admission Number</label>
                                                    <input type="text" name="admissionNumber" value="<?php echo $Student_number;?>" class="form-control" id="inputZip">
                                                </div>
                                            </div>

                                            <button type="submit" name="add_Student" class="ladda-button btn btn-primary" data-style="expand-right">Add Student</button>

                                        </form>
                                        <!--End Student Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
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

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>