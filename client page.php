<!DOCTYPE html>
<html>
<head>
  <title>Client page</title>
  <style>
    table {
		border: "2";
		line-height: 25px;
		width: 100%;
		color: #0033cc;
		font-family: monospace;
		font-size: 18px;
		text-align: center;
	}
	th {
		background-color: #0033cc;
		color: white;
	}
    h1{
        margin: 10px 0 10px 0;
  font-family: Rockwell,"Courier Bold",Courier,Georgia,Times,"Times New Roman",serif;
  font-size: 50px;
  text-transform: uppercase;
  color: #3747b3;
  background: inherit;
    }
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	.logoutLblPos{
   	position:fixed;
   	right:15px;
   	top:15px;
	}
 body{
background-image: url("https://images.pexels.com/photos/1484759/pexels-photo-1484759.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260");
height:100%;
 background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
input[name=submit2]{
   
    background::#742e08;
    color:red;
    border:none;
    padding:10px;

}
  </style>
</head>
</br>
<h1 align="center">EMPLOYEE TIMESHEET</h1>
</br></br></br></br>
<form action="" method="POST">
    <input type="text" name="get_id" placeholder="Enter ID" required>
     <button type="submit" name="search_by_id">Search</button>  
     
</form>
<table>
  <tr>
    <th>TimeSheetID</th>
	<th>EmployeeID</th>
	<th>Day_1</th>
	<th>Day_2</th>
	<th>Day_3</th>
	<th>Day_4</th>
	<th>Day_5</th>
	<th>Day_6</th>
	<th>Day_7</th>
	<th>WeekID</th>
	<th>START_DATE</th>
        <th>END_DATE</th>
        <th>ACTIVE_FLAG</th>
  </tr>
<form align="right" name="form1" method="post" action="index.html">
  <label class="logoutLblPos">
  <input name="submit2" type="submit" id="submit2" value="LOG OUT">
  </label>
</form>

<?php
error_reporting(0);
$server_rm = "STARK-PC\SQLEXPRESS";
$connection = array("Database"=>"Timesheet",'ReturnDatesAsStrings'=>true);
$conn = sqlsrv_connect($server_rm, $connection);
if ($conn === false) {  
    echo "Could not connect.\n";  
    die(print_r(sqlsrv_errors(), true));  
}
            
// $query = "SELECT [TimeSheetID],[EmployeeID],[Day_1],[Day_2],[Day_3],[Day_4],[Day_5],[Day_6],[Day_7],[WeekID],[START_DATE],[END_DATE],[ACTIVE_FLAG] FROM dbo.timesheet_TGT";
// $stmt =sqlsrv_query($conn,$query);
// if( $stmt === false) {
//     die( print_r( sqlsrv_errors(), true) );
// }
// $count=0;
// if	($stmt == $count>=0) {
// 	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

// 	  echo "<tr><td>". $row['TimeSheetID'] ."</td><td>". $row['EmployeeID'] ."</td><td>". $row['Day_1'] ."</td><td>". $row['Day_2'] ."</td><td>". $row['Day_3'] ."</td><td>". $row['Day_4'] ."</td><td>". $row['Day_5'] ."</td><td>". $row['Day_6'] ."</td><td>". $row['Day_7'] ."</td><td>". $row['WeekID'] ."</td><td>". $row['START_DATE'] ."</td><td>". $row['END_DATE'] ."</td><td>". $row['ACTIVE_FLAG'] ."</td></tr>"; 
// 	  $count++;
// 	}
// 	  echo "</table>";
//   }
//   else {
// 	  echo "0 result";
//   }
// sqlsrv_free_stmt($stmt);


// Turn off all error reporting



if(isset($_POST['search_by_id']))
{
	$id=$_POST['get_id'];
	$query1 = "SELECT [TimeSheetID],[EmployeeID],[Day_1],[Day_2],[Day_3],[Day_4],[Day_5],[Day_6],[Day_7],[WeekID],[START_DATE],[END_DATE],[ACTIVE_FLAG] FROM dbo.timesheet_TGT where EmployeeID='$id' ";
}

$stmt1 =sqlsrv_query($conn,$query1);
if( $stmt1 === false) {
    die( print_r( sqlsrv_errors(), true) );
}

$count1=0;
if	($stmt1 == $count1>=0) {
	while ($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {

	  echo "<tr><td>". $row1['TimeSheetID'] ."</td><td>". $row1['EmployeeID'] ."</td><td>". $row1['Day_1'] ."</td><td>". $row1['Day_2'] ."</td><td>". $row1['Day_3'] ."</td><td>". $row1['Day_4'] ."</td><td>". $row1['Day_5'] ."</td><td>". $row1['Day_6'] ."</td><td>". $row1['Day_7'] ."</td><td>". $row1['WeekID'] ."</td><td>". $row1['START_DATE'] ."</td><td>". $row1['END_DATE'] ."</td><td>". $row1['ACTIVE_FLAG'] ."</td></tr>"; 
	  $count1++;
	}
	  echo "</table>";
  }
  else {
	  echo "0 result";
  }

sqlsrv_free_stmt($stmt1);

sqlsrv_close($conn);	
?>
</table>
</body>
</html> 