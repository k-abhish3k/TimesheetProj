<?php

$server_rm = "STARK-PC\SQLEXPRESS";
$connection = array("Database"=>"Timesheet",'ReturnDatesAsStrings'=>true);
$conn = sqlsrv_connect($server_rm, $connection);
if ($conn === false) {  
    echo "Could not connect.\n";  
    die(print_r(sqlsrv_errors(), true));  
}

session_start();

$EmployeeID = $_REQUEST['EmployeeID'];
$Employeename  = $_REQUEST['Employeename'];
$Employeepwd  = $_REQUEST['Employeepwd'];
$query = "SELECT * FROM dbo.employee WHERE EmployeeID = '$EmployeeID' AND Employeename='$Employeename' AND Employeepwd='$Employeepwd'";
$result = sqlsrv_query($conn,$query,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$num = sqlsrv_num_rows($result);
if($num == true){
$_SESSION['valid_user'] = true;
$_SESSION['EmployeeID'] = $EmployeeID;
header('Location: Employee page.php'); 
die(); 
}else{
header('Location: employee_login.html');
die();
}



?>