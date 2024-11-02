<?php
session_start();
include('config.php');

// Check if the search button is clicked
if(isset($_POST['search'])) {
    $searchDate = $_POST['searchDate'];
    // Retrieve notices for the specified date
    $query = "SELECT * FROM notice WHERE DATE(created_date) = '$searchDate' and towhom='Every one'   ORDER BY created_date DESC";
    $notice_rs = $mysqli->query($query);
    $notice_num = $notice_rs->num_rows;
} else {
    // Retrieve notices for the current page
    $query = "SELECT * FROM notice where towhom='Every one' ORDER BY created_date DESC";
    $notice_rs = $mysqli->query($query);
    $notice_num = $notice_rs->num_rows;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notice Board</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('image.webp');
            background-size: cover;
            margin: 0;
            padding: 0px;
        }

        #logo {
            text-align: center;
            margin-bottom: 0px;
        }

        #logo img {
            max-width: 150px;
        }

        #notice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #notice-container h2 {
            text-align: center;
            margin-top: 0;
            color: #333;
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

        #notice-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .notice-item {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .notice-item h4 {
            margin: 0;
            color: #333;
            font-weight: bold;
            text-align: center;
        }

        .notice-item p {
            margin: 10px 0 0 0;
            color: #666;
            text-align: center;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
            text-decoration: none;
            border-radius: 3px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="logo">
        <img src="mssms.png" alt="Logo">
    </div>
    <div id="notice-container">
        <h2>Notice Board</h2>
        <form method="post">
            <label for="searchDate">Search by Date:</label>
            <input type="date" id="searchDate" name="searchDate">
            <button type="submit" name="search">Search</button>
        </form>
        <ul id="notice-list">
            <?php
            if ($notice_num > 0) {
                while ($notice_row = $notice_rs->fetch_assoc()) {
                    $toWhom = $notice_row['towhom'];
                    $title = $notice_row['title'];
                    $discription = $notice_row['discription'];
                    $Date = $notice_row['created_date'];
                    echo "
                    <li><h5  >LATEST NEWS ON - <spam style='color:blue;'>$Date</spam> <h5>
                        <div class='notice-item'>
                            <h4>$title</h4>
                            <p><strong>For All $toWhom's</strong></p>
                            <p>$discription</p>
                            
                        </div>
                    </li>";
                }
            } else {
                echo "<div class='alert'>
                    There is no notification yet!
                </div>";
            }
            ?>
        </ul>
        <div class="pagination">
            <!-- Pagination code here -->
        </div>
    </div>
</body>

</html>
