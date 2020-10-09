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

 if(isset($_POST["select_date"]))
 {
   $_sdc = new DateTime($_POST["select_date"]);
   $select_date_conv = $_sdc->format('Y-m-d');

   $output = '';

   $query = "
    SELECT ID, DATE_FORMAT(d.log_date, '%d/%m/%Y')
    Log_Date,
    CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END)
    Total_Hrs_Today,
    concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date - (floor(d.total_hrs_to_date/60)*60))
    Total_Hrs_To_Date,
    CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check
    FROM dlog d WHERE d.callsign = '".CALLSIGN."'
    AND d.log_date = '".$select_date_conv."'
    ";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
        $qmax = 'SELECT MAX(flt_no)+1 Next_Flt_No FROM dlog_flights where dlog_id = '.$row["ID"].'';
        $resmax = mysqli_query($link, $qmax);
        while($rowmax = mysqli_fetch_array($resmax)) {
          $Next_Flt_No = $rowmax["Next_Flt_No"];
          $output .= '<p>Daily Technical Log Found for this date. Adding Flight Number '.$Next_Flt_No.'</p>';

          $output .='
          <form action="dlog-insert.php" method="post">
            <input type="hidden" id="dlog_id_set" name="dlog_id_set" value="'.$row["ID"].'">
            <table class="table table-bordered" style="width: 100%">
            <colgroup>
               <col span="1" style="width: 20%;"></col>
               <col span="1" style="width: 40%;"></col>
               <col span="1" style="width: 20%;"></col>
               <col span="1" style="width: 20%;"></col>
            </colgroup>
            <tr>
              <td>Flight No</td>
              <td><input tabindex="1" type="text" name="Flt_No" id="Flt_No" readonly style="background-color: silver" value="'.$Next_Flt_No.'"></td>
              <td>Enginer Start-Up</td>
              <td><input tabindex="6" type="time" name="Engine_Start_Up" id="Engine_Start_Up"></td>
            </tr>
            <tr>
              <td>Captain</td>
              <td><input tabindex="2" type="text" name="Captain" id="Captain" value="'.$_SESSION["username"].'"></td>
              <td>Engine Shutdown</td>
              <td><input tabindex="7" type="time" name="Engine_Shutdown" id="Engine_Shutdown"></td>
            </tr>
            <tr>
              <td>P2 / Passenger</td>
              <td><input tabindex="3" type="text" name="P2_Passenger" id="P2_Passenger"></td>
              <td>Take Off Time</td>
              <td><input tabindex="8" type="time" name="Takeoff_Time" id="Takeoff_Time"></td>
            </tr>
            <tr>
              <td>From</td>
              <td><input tabindex="4" type="text" name="From_Airport" id="From_Airport" value="Gloucester EGBJ"></td>
              <td>Landing Time</td>
              <td><input tabindex="9" type="time" name="Landing_Time" id="Landing_Time"></td>
            </tr>
            <tr>
              <td>To</td>
              <td><input tabindex="5" type="text" name="To_Airport" id="To_Airport" value="Gloucester EGBJ"></td>
              <td>Landings</td>
              <td><input tabindex="10" type="number" name="Landings" id="Landings"></td>
            </tr>
          </table>
          <input type="submit" value="Submit">
          </form>
          ';
          }
      }
    }
    else
    {

      $highest_log = "
      SELECT total_hrs_to_date, hours_to_next_check FROM dlog WHERE callsign = '".CALLSIGN."'
      AND log_date < '".$select_date_conv."' AND log_date =
        (SELECT MAX(log_date) FROM dlog WHERE callsign = '".CALLSIGN."' AND log_date < '".$select_date_conv."' )
      ";
      $res_highest_log = mysqli_query($link, $highest_log);
      while($row_highest_log = mysqli_fetch_array($res_highest_log)) {
        $tot_hrs = $row_highest_log["total_hrs_to_date"];
        $hrs_check = $row_highest_log["hours_to_next_check"];
      }
      $sql = 'INSERT INTO dlog (callsign, log_date, total_hrs_today, total_hrs_to_date, hours_to_next_check, total_hrs_flown_prev, hours_to_next_check_prev) VALUES (?, ?, ?, ?, ?, ?, ?)';
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sssssss", $cs, $select_date_conv, $tht, $tot_hrs, $hrs_check, $tot_hrs, $hrs_check);
        $cs = CALLSIGN;
        $tht = 0;
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $new_log_id = $link->insert_id;
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
      } else { echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link); }
      // Close statement
      mysqli_stmt_close($stmt);

      $output .= '<p> No Daily Technical Log found for this date. Adding a new Technical Log Entry and Flight Number 1.</p>';
      $output .='
      <form action="dlog-insert.php" method="post">
        <input type="hidden" id="dlog_id_set" name="dlog_id_set" value="'.$new_log_id.'">
        <table class="table table-bordered" style="width: 100%">
        <colgroup>
           <col span="1" style="width: 20%;"></col>
           <col span="1" style="width: 40%;"></col>
           <col span="1" style="width: 20%;"></col>
           <col span="1" style="width: 20%;"></col>
        </colgroup>
        <tr>
          <td>Flight No</td>
          <td><input tabindex="1" type="text" name="Flt_No" id="Flt_No" readonly style="background-color: silver" value="1"></td>
          <td>Enginer Start-Up</td>
          <td><input tabindex="6" type="time" name="Engine_Start_Up" id="Engine_Start_Up"></td>
        </tr>
        <tr>
          <td>Captain</td>
          <td><input tabindex="2" type="text" name="Captain" id="Captain" value="'.$_SESSION["username"].'"></td>
          <td>Engine Shutdown</td>
          <td><input tabindex="7" type="time" name="Engine_Shutdown" id="Engine_Shutdown"></td>
        </tr>
        <tr>
          <td>P2 / Passenger</td>
          <td><input tabindex="3" type="text" name="P2_Passenger" id="P2_Passenger"></td>
          <td>Take Off Time</td>
          <td><input tabindex="8" type="time" name="Takeoff_Time" id="Takeoff_Time"></td>
        </tr>
        <tr>
          <td>From</td>
          <td><input tabindex="4" type="text" name="From_Airport" id="From_Airport" value="Gloucester EGBJ"></td>
          <td>Landing Time</td>
          <td><input tabindex="9" type="time" name="Landing_Time" id="Landing_Time"></td>
        </tr>
        <tr>
          <td>To</td>
          <td><input tabindex="5" type="text" name="To_Airport" id="To_Airport" value="Gloucester EGBJ"></td>
          <td>Landings</td>
          <td><input tabindex="10" type="number" name="Landings" id="Landings"></td>
        </tr>
      </table>
      <input type="submit" value="Submit">
      </form>
      ';
    }
    echo $output;
}
?>
