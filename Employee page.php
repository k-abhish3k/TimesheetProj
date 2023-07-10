<?php session_start();?>
<!DOCTYPE html>
<?php
// session_start();

$weekID = NULL;
$result = NULL;

$t = NULL;
if (isset($_POST['submit']) && $_POST['submit'] == 'Get WeekID') {
    if (isset($_POST['startdate']) || isset($_POST['enddate'])) {
        $start = $_POST['startdate'];
        $end = $_POST['enddate'];
        if ($start < $end) {
            $t = date("Ymd", strtotime($start));
            $weekID = $t . date("d", strtotime($end));
        } else {
            echo'<script>alert("Start Date cannot be greater than the End date!")</script>';
        }
    }
}
$serverName = "STARK-PC\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array("Database" => "Timesheet");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    echo "Could not connect.\n";
    die(print_r(sqlsrv_errors(), true));
}
$tsql = "INSERT INTO dbo.timesheet_STG (EmployeeID,  
     Day_1,Day_2,Day_3,Day_4,Day_5,Day_6,Day_7,WeekID)  
VALUES (?, ?, ?, ?,?,?,?,?,?)";
if (
    isset($_POST['EmployeeID']) || isset($_POST['Day_1']) || isset($_POST['Day_2']) || isset($_POST['Day_3']) || isset($_POST['Day_4'])
    || isset($_POST['Day_5']) || isset($_POST['Day_6']) || isset($_POST['Day_7']) || isset($_POST['WeekID'])
) {
    $employeeID = $_POST['EmployeeID'];
    $day1 = $_POST['Day_1'];
    $day2 = $_POST['Day_2'];
    $day3 = $_POST['Day_3'];
    $day4 = $_POST['Day_4'];
    $day5 = $_POST['Day_5'];
    $day6 = $_POST['Day_6'];
    $day7 = $_POST['Day_7'];
    $weekID = $_POST['WeekID'];
    $params1 = array($employeeID, $day1, $day2, $day3, $day4, $day5, $day6, $day7, $weekID);
    $stmt1 = sqlsrv_query($conn, $tsql, $params1);
    if ($stmt1 === false) {

        echo "Error in execution of INSERT.\n";
        die(print_r(sqlsrv_errors(), true));
    } else {
        $result = "Data entered Successfully!";
    }
    sqlsrv_free_stmt($stmt1);



$esql = "exec [dbo].[SCD2_TimeSheet]";
$stmt2 = sqlsrv_query($conn, $esql);
if ($stmt2 === false) {

    echo "Error in execution of SCD.\n";
    die(print_r(sqlsrv_errors(), true));
} 
sqlsrv_free_stmt($stmt2);


$dsql = "delete from dbo.timesheet_STG";
$stmt3 = sqlsrv_query($conn, $dsql);
if ($stmt3 === false) {

    echo "Error in deletion of inserted query.\n";
    die(print_r(sqlsrv_errors(), true));
} 
sqlsrv_free_stmt($stmt3);



    sqlsrv_close($conn);
}

?>

<html>
<head>
    <title> timesheet </title>

    <style>
        .res-tab {
            overflow-x: auto;
        }

        ul li {
            display: inline-block;
        }

        ul li a {
            margin: 50px auto;
            width: 120px;
            height: 30px;
            border: 3px solid white;
            background-color: rgba(255, 255, 255, 0);
            color: black;
            font-family: sans-serif;
            font-weight: bold;
            border-radius: 5px;
            position: absolute;
            right: 0;
        }

        

        .WeekID {
            text-align: center;
            top: 40px;
            color: #D0B64C ;
            font-family: 'Trocchi', serif; font-weight: bold; 
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        ul li a:hover {
        background-color: rgba(255, 255, 255, 1);
        color: #222;
        cursor: pointer;
        transition: background-color 0.2s, colour 0.2s
           
        }

        ul li.active a {
            background-color: #fff;
            color: #000;
 
        }

        h1 {
            color: #7c795d; 
            font-family: 'Trocchi', serif; font-weight: bold; 
            text-align: center;

        }

        h3 {
            text-align: center;
            font-size: 30px;
            color: #6FD04C;
            font-style:oblique;
        }

        h4 {
            text-align: center;
            font-size: 30px;
            color:darkred;
            font-style:oblique;
        }

        .date {
            text-align: center;

        }

        table {
            border-collapse: collapse;
            top: 40px;
            width: 95%;
            font-size: 18px;
            margin-left: auto;
            margin-right: auto;
            table-layout: fixed;
            font-style: normal;
            text-align: center;
        }

        th {
            background-color: dodgerblue;
            color: white;
        }

        th,
        td {
            border: 2px solid #000;
            padding: 15px;
        }
        .description{
            background-color: #95876E;
            color: rgba(0, 0, 0, 1);
            text-align: center;
            margin-top: 150px;
            font-family: sans-serif;
            padding: 5px;
            margin-bottom: 40px;
}



.submit{
  margin: 50px auto;
  display:  block;
  width: 180px;
  height: 50px;
  border: 3px solid white;
  background-color: rgba(255, 255, 255, 0);
  color: black;
  font-family: sans-serif;
  font-weight: bold;
  border-radius: 5px;

  transition: background-color 0.1s, colour 0.1s
}
.submit:hover{
  background-color: rgba(255, 255, 255, 1);
  color: #222;
  cursor: pointer;
  transition: background-color 0.1s, colour 0.1s
}
.logout{
  margin-left: 1300px;
  display:  block;
  width: 140px;
  height: 40px;
  border: 5px solid white;
  background-color: rgba(255, 255, 255, 0);
  color: black;
  font-family: sans-serif;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.1s, colour 0.1s
  
  

}
.logout:hover{
  background-color: rgba(255, 255, 255, 1);
  color: #222;
  cursor: pointer;
  transition: background-color 0.1s, colour 0.1s
}


body{
/**background-image: url("https://cdn.hipwallpaper.com/i/3/88/sXHZgG.jpg");**/
height:100%;
background: url("office.jpg") no-repeat center fixed;
backdrop-filter: blur(10px);
  background-size: cover;
}
    </style>
</head>

<body>
    <div class="res-tab">
	
    </div>

    <header>
        <div class="main">
            <div class="logo">
              
            </div>

            <ul>
                <button class="logout"><a href="index.html">Log Out</a></button>

            </ul>
        </div>

        <div class="title">
            <h1>Employee Timesheet</h1>
        </div>
        <form method="post" action="Employee page.php">
            <div class="WeekID">

                <h2> Week ID: <?php echo $weekID ?> </h2>
                <label for="start">Start date:</label>

                <input type="date" id="start" name="startdate" value="yyyy-mm-dd" min="2020-01-01" max="2021-12-31">

                <label for="End">End date:</label>
                <input type="date" id="end" name="enddate" value="yyyy-mm-dd" min="2020-01-01" max="2021-12-31">
                <input type="submit" name="submit" value="Get WeekID">
            </div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <div class="table">
            <form method="post" action="Employee page.php">
                <table class="" center>
                    <tbody>
                        <tr>
                            <th>EmployeeID</th>
                            <th>Day 1</th>
                            <th>Day 2</th>
                            <th>Day 3</th>
                            <th>Day 4</th>
                            <th>Day 5</th>
                            <th>Day 6</th>
                            <th>Day 7</th>
                            <th>WeekID</th>
                        </tr>

                        <tr>
                            <?php
                            if (!isset($_SESSION['EmployeeID'])) {
                                 $_SESSION['msg'] = "You have to log in first";
                                 header('location: employee_login.php');
                            }
                            if (isset($_SESSION['EmployeeID'])) :
                            ?>
                            <td><input type="text" id="EmployeeID" name="EmployeeID" value="<?php echo $_SESSION['EmployeeID'] ?>" readonly></td> <?php endif ?>
                            <td><input type="text" id="Day_1" name="Day_1"></td>
                            <td><input type="text" id="Day_2" name="Day_2"></td>
                            <td><input type="text" id="Day_3" name="Day_3"></td>
                            <td><input type="text" id="Day_4" name="Day_4"></td>
                            <td><input type="text" id="Day_5" name="Day_5"></td>
                            <td><input type="text" id="Day_6" name="Day_6"></td>
                            <td><input type="text" id="Day_7" name="Day_7"></td>
                            <td><input type="text" id="WeekID" name="WeekID" value="<?php echo $weekID ?>" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <p align="center">
                <button class="submit">Submit</button>
                </p>
            </form>


        </div>



        
         <h3> <?php echo $result ?> </h3>
           
        <div class="description" align="center">
            <p>Input Description: 0=Leave; 0.5=Half-day; 1=Full-day</p>
        </div>
         

       

    </header>
</body>

</html>