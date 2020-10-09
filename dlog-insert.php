<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

function time_to_integer($time) {
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0]*60 + $timeArr[1] );
     return $decTime;
}

function timeDiff($firstTime,$lastTime) {
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
    $timeDiff=($lastTime-$firstTime)/60;
    $timeDiffFormatted = sprintf('%02d', floor($timeDiff / 60)) . ":" . $timeDiff % 60;
    return $timeDiffFormatted;
}

// Prepare an insert statement
$sql = "INSERT INTO dlog_flights (dlog_id, user_id, Flt_No, Captain, P2_Passenger, From_Airport, To_Airport, est_h, est_m, esd_h, esd_m, er_h, er_m, to_h, to_m, la_h, la_m, ab_h, ab_m, Landings) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $dlog_id, $user_id, $Flt_No, $Captain, $P2_Passenger, $From_Airport, $To_Airport, $est_h, $est_m, $esd_h, $esd_m, $er_h, $er_m, $to_h, $to_m, $la_h, $la_m, $ab_h, $ab_m, $Landings);

    // Set parameters
    $dlog_id = $_REQUEST['dlog_id_set'];
    $user_id = $_SESSION["id"];
    $Flt_No = $_REQUEST['Flt_No'];
    $Captain = $_REQUEST['Captain'];
    $P2_Passenger = $_REQUEST['P2_Passenger'];
    $From_Airport = $_REQUEST['From_Airport'];
    $To_Airport = $_REQUEST['To_Airport'];
    $Engine_Start_Up = $_REQUEST['Engine_Start_Up'];
    $est_h = substr($Engine_Start_Up, 0, 2);
    $est_m = substr($Engine_Start_Up, 3, 2);
    $Engine_Shutdown = $_REQUEST['Engine_Shutdown'];
    $esd_h = substr($Engine_Shutdown, 0, 2);
    $esd_m = substr($Engine_Shutdown, 3, 2);
    $er_h = substr(timeDiff($Engine_Start_Up,$Engine_Shutdown),0,2);
    $er_m = substr(timeDiff($Engine_Start_Up,$Engine_Shutdown),3,2);
    $Takeoff_Time = $_REQUEST['Takeoff_Time'];
    $to_h = substr($Takeoff_Time, 0, 2);
    $to_m = substr($Takeoff_Time, 3, 2);
    $Landing_Time = $_REQUEST['Landing_Time'];
    $la_h = substr($Landing_Time, 0, 2);
    $la_m = substr($Landing_Time, 3, 2);
    $ab_h = substr(timeDiff($Takeoff_Time, $Landing_Time),0,2);
    $ab_m = substr(timeDiff($Takeoff_Time, $Landing_Time),3,2);
    $Landings = $_REQUEST['Landings'];

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($link);
?>
