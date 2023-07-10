<?php

$server_rm = "STARK-PC\SQLEXPRESS";
$connection = array("Database"=>"Timesheet",'ReturnDatesAsStrings'=>true);
$conn = sqlsrv_connect($server_rm, $connection);
if ($conn === false) {  
    echo "Could not connect.\n";  
    die(print_r(sqlsrv_errors(), true));  
}

session_start();

$ClientID = $_REQUEST['ClientID'];
$Clientname  = $_REQUEST['Clientname'];
$Clientpwd  = $_REQUEST['Clientpwd'];
$query = "SELECT * FROM dbo.client WHERE ClientID = '$ClientID' AND Clientname='$Clientname' AND Clientpwd='$Clientpwd'";
$result = sqlsrv_query($conn,$query,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$num = sqlsrv_num_rows($result);
if($num == true){
$_SESSION['valid_user'] = true;
$_SESSION['ClientID'] = $ClientID;
header('Location: client page.php'); 
die(); 
}else{
header('Location: client_login.html');
die();
}



?>