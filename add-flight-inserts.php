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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Log Created</title>
    <link rel="stylesheet" href="av8_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="date.js"></script>
    <style type="text/css">
    </style>
  </head>

<body>
  <!-- Header -->
  <div class="page-header-av8">
    Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!
    <a href="welcome.php" class="btn btn-warning">Back</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a>
  </div>
  <p class="btn btn-primary btn-block" style="text-align:left; padding-left:6px;">
    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
    <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
  </svg><?php echo CALLSIGN?> Flight Added
  </p>

<?php
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}

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

    // Set parameters
    $dlog_id = $_REQUEST['dlog_id_set'];
    $dlog_date = $_REQUEST['dlog_date_set'];
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
    $Uplift_Fuel = $_REQUEST['Uplift_Fuel'];
    $Uplift_Oil = $_REQUEST['Uplift_Oil'];
    $Departure_Fuel = $_REQUEST['Departure_Fuel'];
    if (!empty($_REQUEST['Departure_Oil_OK'])) {$Departure_Oil_OK=1;} else {$Departure_Oil_OK=0;};
    $Arrival_Fuel = $_REQUEST['Arrival_Fuel'];
    if (!empty($_REQUEST['Arrival_Oil_OK'])) {$Arrival_Oil_OK=1;} else {$Arrival_Oil_OK=0;};
    $Defects = $_REQUEST['Defects'];
    $er = $er_h*60+$er_m;

    // Flights Insert statement
    $sql_flights = "INSERT INTO dlog_flights (dlog_id, user_id, Flt_No, Captain, P2_Passenger, From_Airport, To_Airport, est_h, est_m, esd_h, esd_m, er_h, er_m, to_h, to_m, la_h, la_m, ab_h, ab_m, Landings) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    prepared_query($link, $sql_flights, [$dlog_id, $user_id, $Flt_No, $Captain, $P2_Passenger, $From_Airport, $To_Airport, $est_h, $est_m, $esd_h, $esd_m, $er_h, $er_m, $to_h, $to_m, $la_h, $la_m, $ab_h, $ab_m, $Landings]);

    // Fuel-Oil Insert statement
    $sql_fuel_oil = "INSERT INTO dlog_fuel_oil (dlog_id, Flt_No, Uplift_Fuel, Uplift_Oil, Departure_Fuel, Departure_Oil_OK, Arrival_Fuel, Arrival_Oil_OK, Defects) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    prepared_query($link, $sql_fuel_oil, [$dlog_id, $Flt_No, $Uplift_Fuel, $Uplift_Oil, $Departure_Fuel, $Departure_Oil_OK, $Arrival_Fuel, $Arrival_Oil_OK, $Defects]);

    // Update Log totals for the day
    $upd_log = "UPDATE dlog SET total_hrs_today=total_hrs_today+?, total_hrs_to_date=total_hrs_to_date+?, hours_to_next_check=hours_to_next_check-? WHERE id=?";
    prepared_query($link, $upd_log, [$er, $er, $er, $dlog_id]);

    //Get Totals for Next Logs
    $cur_log_query = "select d.total_hrs_to_date, d.hours_to_next_check from dlog d where d.id = '".$dlog_id."'";
    $result_cur_log = mysqli_query($link, $cur_log_query);
    if (mysqli_num_rows($result_cur_log) > 0) {
    while ($row_cur_log = mysqli_fetch_array($result_cur_log)) {
      $tot_h_prev_upd = $row_cur_log['total_hrs_to_date'];
      $h_next_check_upd = $row_cur_log['hours_to_next_check'];
      }
    }
    mysqli_free_result($result_cur_log);

    // Update Future Logs
    $future_logs_query = "
    SELECT d.id, d.log_date, d.total_hrs_today FROM dlog d where d.log_date > '" . $dlog_date . "' ORDER BY log_date";
    $result_fl = mysqli_query($link, $future_logs_query);
      if (mysqli_num_rows($result_fl) > 0) {
        while ($row_fl = mysqli_fetch_array($result_fl)) {
          $updated_tot_h = $tot_h_prev_upd + $row_fl ['total_hrs_today'];
          $updated_hr_check = $h_next_check_upd - $row_fl ['total_hrs_today'];
          $id = $row_fl ['id'];

          $update_fl = "update dlog set total_hrs_to_date = ?, hours_to_next_check = ?, total_hrs_flown_prev = ?, hours_to_next_check_prev = ? where id = ?";
          prepared_query ($link, $update_fl, [$updated_tot_h, $updated_hr_check, $tot_h_prev_upd, $h_next_check_upd, $id]);

          $tot_h_prev_upd = $updated_tot_h;
          $h_next_check_upd = $updated_hr_check;
        }
      }
      mysqli_free_result($result_fl);

    //Presents current dlog
    $sql_dlog = "
    SELECT DATE_FORMAT(d.log_date, '%d/%m/%Y')
    Log_Date,
    CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END)
    Total_Hrs_Today,
    concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date - (floor(d.total_hrs_to_date/60)*60))
    Total_Hrs_To_Date,
    CONCAT(case when hours_to_next_check > 0 then (lpad(floor(Hours_To_Next_Check/60),2,'0')) When CEILING(hours_To_Next_Check/60) <=1 then CONCAT('-',LPAD(-CEILING(hours_To_Next_Check/60),2,'0')) else CEILING(hours_To_Next_Check/60) END,':',
    case when hours_to_next_check > 0 then LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') when -d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60)<9 then CONCAT('0',-d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60)) ELSE -d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60) END)
    Hours_To_Next_Check, case when Hours_To_Next_Check < 0 then '-' ELSE '+' END Is_Positive
    FROM dlog d WHERE d.callsign = '".CALLSIGN."' and ID = ".$dlog_id;

    echo "<p>Flight Record inserted in the Aircraft Technical Log. Here is today's Log:</p>";

    $result_dlog = mysqli_query($link, $sql_dlog);
        if (mysqli_num_rows($result_dlog) > 0) {
          echo '<div class="container" style="width:95%">';
          echo "<table class='table table-bordered'>";
            echo "<tr style='background-color:#337ab7; color: #fff'>";
              echo "<th>Registration</th>";
              echo "<th>Flight Date</th>";
              echo "<th>Total Hours Flown</th>";
              echo "<th>Total Hours To Date</th>";
              echo "<th>Hours To Next Check</th>";
            echo "</tr>";
          while ($row = mysqli_fetch_array($result_dlog)) {
              echo "<tr class='av8tr'>";
                echo "<td>".CALLSIGN."</td>";
                echo "<td>" . $row['Log_Date'] . "</td>";
                echo "<td>" . $row['Total_Hrs_Today'] . "</td>";
                echo "<td>" . $row['Total_Hrs_To_Date'] . "</td>";
                if ($row['Is_Positive'] == '+') {echo "<td>". $row['Hours_To_Next_Check'];}
                  else {echo "<td style='background-color: yellow; color: red;'>". $row['Hours_To_Next_Check'];}; echo "</td>";
              echo "</tr>";
            }
            echo "<tr style='background-color: #aecad6; background-image: linear-gradient(315deg, #aecad6 0%, #b8d3fe 74%);'><td colspan=5><table class='table table-bordered'><tr>";
              echo "<td>Flt No</td>";
              echo "<td>Captain</td>";
              echo "<td>Passenger</td>";
              echo "<td>From Airport</td>";
              echo "<td>To Airport</td>";
              echo "<td>Engine Start-Up</td>";
              echo "<td>Engine Shut-Down</td>";
              echo "<td><strong>Engine Runtime</strong></td>";
              echo "<td>Takeoff Time</td>";
              echo "<td>Landing Time</td>";
              echo "<td>Airborne Time</td>";
              echo "<td><strong>Landings</strong></td>";
            echo "</tr>";
            //Flights Record
            $sql_dlog_flights = "
              SELECT df.flt_no Flt_No,
              captain Captain,
              df.p2_passenger P2_Passenger,
              df.from_airport From_Airport,
              df.to_airport To_Airport,
              concat(lpad(est_h,2,0),':',lpad(est_m,2,0)) Engine_Start_Up,
              concat(lpad(esd_h,2,0), ':', lpad(esd_m,2,0)) Engine_Shutdown,
              concat(lpad(er_h,2,0), ':', lpad(er_m,2,0)) Engine_Runtime,
              concat(lpad(to_h,2,0), ':', lpad(to_m,2,0)) Takeoff_Time,
              concat(lpad(la_h,2,0), ':', lpad(la_m,2,0))  Landing_Time,
              concat(lpad(ab_h,2,0), ':', lpad(ab_m,2,0)) Airbourne_Time,
              df.landings Landings
              FROM dlog_flights df
              WHERE df.dlog_id = ".$dlog_id."
              ORDER BY df.flt_no";
            $result_dlog_flights = mysqli_query($link, $sql_dlog_flights);
            while ($row_flights = mysqli_fetch_array($result_dlog_flights)) {
              echo "<tr>";
              echo "<td>". $row_flights['Flt_No'] . "</td>";
              echo "<td>". $row_flights['Captain'] . "</td>";
              echo "<td>". $row_flights['P2_Passenger'] . "</td>";
              echo "<td>". $row_flights['From_Airport'] . "</td>";
              echo "<td>". $row_flights['To_Airport'] . "</td>";
              echo "<td>". $row_flights['Engine_Start_Up'] . "</td>";
              echo "<td>". $row_flights['Engine_Shutdown'] . "</td>";
              echo "<td><strong>". $row_flights['Engine_Runtime'] . "</strong></td>";
              echo "<td>". $row_flights['Takeoff_Time'] . "</td>";
              echo "<td>". $row_flights['Landing_Time'] . "</td>";
              echo "<td>". $row_flights['Airbourne_Time'] . "</td>";
              echo "<td><strong>". $row_flights['Landings'] . "</strong></td>";
              echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result_dlog_flights);

            //Fuel/Oil Record
            $sql_dlog_fuel_oil = "
            SELECT Flt_No, Uplift_Fuel, Uplift_Oil, Departure_Fuel, Departure_Oil_OK, Arrival_Fuel, Arrival_Oil_OK, Defects FROM dlog_fuel_oil
            WHERE dlog_id = ".$dlog_id."
            order by flt_no";
            $result_dlog_fuel_oil = mysqli_query($link, $sql_dlog_fuel_oil);
            if (mysqli_num_rows($result_dlog_fuel_oil) > 0) {
                echo "<p><strong>FUEL/OIL RECORD - Litres</strong></p>";
                echo "<table class='table table-bordered' style='width: 90%'>";
                echo "<tr>";
                echo "<td style='width: 8%'>Flight No</td>";
                echo "<td style='width: 8%'>Uplift Fuel</td>";
                echo "<td style='width: 10%'>Uplift Oil</td>";
                echo "<td style='width: 8%'>Departure Fuel</td>";
                echo "<td style='width: 8%; text-align:center;'>Departure Oil OK?</td>";
                echo "<td style='width: 8%'>Arrival Fuel</td>";
                echo "<td style='width: 8%; text-align:center;'>Arrival Oil OK?</td>";
                echo "<td style='width: 42%'>Defects</td>";
                echo "</tr>";
              while ($row_fuel_oil = mysqli_fetch_array($result_dlog_fuel_oil)) {
                echo "<tr>";
                echo "<td>". $row_fuel_oil['Flt_No'] . "</td>";
                echo "<td>". $row_fuel_oil['Uplift_Fuel'] . " L</td>";
                echo "<td>". $row_fuel_oil['Uplift_Oil'] . " L</td>";
                echo "<td>". $row_fuel_oil['Departure_Fuel'] . " L</td>";
                if ($row_fuel_oil['Departure_Oil_OK'] == '1') {echo "<td style='text-align:center; color: white; font-weight: bold; background-color: green;'>Yes";} else {echo "<td style='text-align:center; color: white; font-weight: bold; background-color: red;'>No";}; echo "</td>";
                echo "<td>". $row_fuel_oil['Arrival_Fuel'] . " L</td>";
                if ($row_fuel_oil['Arrival_Oil_OK'] == '1') {echo "<td style='text-align:center; color: white; font-weight: bold; background-color: green;'>Yes";} else {echo "<td style='text-align:center; color: white; font-weight: bold; background-color: red;'>No";}; echo "</td>";
                if (strtoupper($row_fuel_oil['Defects']) == 'NIL') {echo "<td>". $row_fuel_oil['Defects'];} else {echo "<td style='background-color: yellow;'>". $row_fuel_oil['Defects'];}; echo "</td>";
                echo "</tr>";
              }
              echo "</table>";
              echo "</td></tr>";
            } else { echo "<p><strong>FUEL/OIL RECORD: No records found for this Daily Technical Log</strong><p>"; }
            mysqli_free_result($result_dlog_fuel_oil);
            echo "</td></tr><tr><td colspan=5></td></tr>";
          }
          echo "</table>";

          // Free result set
          mysqli_free_result($result_dlog);
          echo "</table>";
          echo '<table><tr><td>';
          echo '<a href="welcome.php" class="btn btn-primary">Back Home</a> ';
          echo '<a href="add-flight-log.php" class="btn btn-warning">Add New Entry</a> ';
          echo '<a href="view-flight-log.php" class="btn btn-warning">View All Logs</a>';
          echo '</td></tr></table>';

  // Close connection
  mysqli_close($link);

?>

</body>
