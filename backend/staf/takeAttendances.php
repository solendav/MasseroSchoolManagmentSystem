<?php
session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
//$aid=$_SESSION['ad_id'];
$staf_id = $_SESSION['staf_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Attendance</title>
</head>
<body>
  <h1>Attendance</h1>
  <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table id="attendanceTable">
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
            $currentDateTime = date("m-d-Y");

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

    <button type="submit">Submit Attendance</button>
  </form>
</body>
</html>
