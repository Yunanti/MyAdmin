<?php

$serverName = "LAPTOP-M1P841HN";
$database = "dbAdmin";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass, 
    "ReturnDatesAsStrings" => true
];

$conn = sqlsrv_connect($serverName,$connection);
// if(!$conn)
// die(print_r(sqlsrv_errors(),true));
// $tsql = "select * from ProgramKerja";

// $stmt = sqlsrv_query($conn,$tsql);

// if($stmt == false){
//     echo 'Error';
// }

// while($obj =sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
//     echo $obj['IDProker'].'<\br>';
// }
// sqlsrv_free_stmt($stmt);
// sqlsrv_close($conn);

?>