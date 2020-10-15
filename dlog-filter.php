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
 //filter.php
 if(isset($_POST["from_date"], $_POST["to_date"]))
 {
      $_fdc = new DateTime($_POST["from_date"]);
      $from_date_conv = $_fdc->format('Y.m.d');
      $_tdc = new DateTime($_POST["to_date"]);
      $to_date_conv = $_tdc->format('Y.m.d');

      $output = '';
      $query = "
      SELECT ID, DATE_FORMAT(d.log_date, '%d/%m/%Y')
      Log_Date,
      CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END)
      Total_Hrs_Today,
      concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date - (floor(d.total_hrs_to_date/60)*60))
      Total_Hrs_To_Date,
      CONCAT(case when hours_to_next_check > 0 then (lpad(floor(Hours_To_Next_Check/60),2,'0')) When CEILING(hours_To_Next_Check/60) <=1 then CONCAT('-',LPAD(-CEILING(hours_To_Next_Check/60),2,'0')) else CEILING(hours_To_Next_Check/60) END,':',
      case when hours_to_next_check > 0 then LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') when -d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60)<9 then CONCAT('0',-d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60)) ELSE -d.hours_to_next_check+(ceiling(d.hours_to_next_check/60)*60) END)
      Hours_To_Next_Check, case when Hours_To_Next_Check < 0 then '-' ELSE '+' END Is_Positive
      FROM dlog d WHERE exists (select 1 from dlog_flights where dlog_id = d.id) and  d.callsign = '".CALLSIGN."' AND d.Log_Date BETWEEN '".$from_date_conv."' AND '".$to_date_conv."' ORDER BY d.log_date desc
      ";
      $result = mysqli_query($link, $query);
      $output .= '
           <table class="table table-bordered">
                <tr style="background-color:#337ab7; color: #fff">
                  <th>Registration</th>
                  <th>Flight Date</th>
                  <th>Total Hours Flown</th>
                  <th>Total Hours To Date</th>
                  <th>Hours To Next Check</th>
                </tr>
      ';
      if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_array($result))
           {
                $output .= '
                     <tr class="av8tr">
                          <td>'.CALLSIGN.'</td>
                          <td>'. $row["Log_Date"] .'</td>
                          <td> '. $row["Total_Hrs_Today"] .'</td>
                          <td>'. $row["Total_Hrs_To_Date"] .'</td>';

                          if ($row['Is_Positive'] == '+') {$output .= "<td>". $row['Hours_To_Next_Check'];}
                            else {$output .= "<td style='background-color: yellow; color: red;'>". $row['Hours_To_Next_Check'];};
                            $output .= '</td>

                     </tr>
                     <tr style="background-color: #aecad6; background-image: linear-gradient(315deg, #aecad6 0%, #b8d3fe 74%);"><td colspan=5><table class="table table-bordered"><tr>
                       <td>Flt No</td>
                       <td>Captain</td>
                       <td>Passenger</td>
                       <td>From Airport</td>
                       <td>To Airport</td>
                       <td>Engine Start-Up</td>
                       <td>Engine Shut-Down</td>
                       <td><strong>Engine Runtime</strong></td>
                       <td>Takeoff Time</td>
                       <td>Landing Time</td>
                       <td>Airborne Time</td>
                       <td><strong>Landings</strong></td>
                      </tr>';
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
                       WHERE df.dlog_id = ".$row["ID"]."
                       ORDER BY df.flt_no";
                     $result_dlog_flights = mysqli_query($link, $sql_dlog_flights);
                     while ($row_flights = mysqli_fetch_array($result_dlog_flights)) {
                       $output .= '<tr>
                         <td>'. $row_flights["Flt_No"] . '</td>
                         <td>'. $row_flights["Captain"] . '</td>
                         <td>'. $row_flights["P2_Passenger"] . '</td>
                         <td>'. $row_flights["From_Airport"] . '</td>
                         <td>'. $row_flights["To_Airport"] . '</td>
                         <td>'. $row_flights["Engine_Start_Up"] . '</td>
                         <td>'. $row_flights["Engine_Shutdown"] . '</td>
                         <td><strong>'. $row_flights["Engine_Runtime"] . '</strong></td>
                         <td>'. $row_flights["Takeoff_Time"] . '</td>
                         <td>'. $row_flights["Landing_Time"] . '</td>
                         <td>'. $row_flights["Airbourne_Time"] . '</td>
                         <td><strong>'. $row_flights["Landings"] . '</strong></td>
                       </tr>';
                     }
                     $output .= "</table>";
                     //Fuel/Oil Record
                     $sql_dlog_fuel_oil = "
                     SELECT Flt_No, Uplift_Fuel, Uplift_Oil, Departure_Fuel, Departure_Oil_OK, Arrival_Fuel, Arrival_Oil_OK, Defects FROM dlog_fuel_oil
                     WHERE dlog_id = ".$row['ID']."
                     order by flt_no";
                     $result_dlog_fuel_oil = mysqli_query($link, $sql_dlog_fuel_oil);
                     if (mysqli_num_rows($result_dlog_fuel_oil) > 0) {
                       $output .= "<p><strong>FUEL/OIL RECORD - Litres</strong></p>";
                       $output .= "<table class='table table-bordered' style='width: 60%'>";
                       $output .= "<tr>";
                       $output .= "<td style='width: 10%'>Flight No</td>";
                       $output .= "<td style='width: 10%'>Uplift Fuel</td>";
                       $output .= "<td style='width: 10%'>Uplift Oil</td>";
                       $output .= "<td style='width: 10%'>Departure Fuel</td>";
                       $output .= "<td style='width: 10%; text-align:center;'>Departure Oil OK?</td>";
                       $output .= "<td style='width: 10%'>Arrival Fuel</td>";
                       $output .= "<td style='width: 10%; text-align:center;'>Arrival Oil OK?</td>";
                       $output .= "<td style='width: 30%'>Defects</td>";
                       $output .= "</tr>";
                     while ($row_fuel_oil = mysqli_fetch_array($result_dlog_fuel_oil)) {
                       $output .= "<tr>";
                       $output .= "<td>". $row_fuel_oil['Flt_No'] . "</td>";
                       $output .= "<td>". $row_fuel_oil['Uplift_Fuel'] . " L</td>";
                       $output .= "<td>". $row_fuel_oil['Uplift_Oil'] . " L</td>";
                       $output .= "<td>". $row_fuel_oil['Departure_Fuel'] . " L</td>";
                       if ($row_fuel_oil['Departure_Oil_OK'] == '1') {$output .= "<td style='text-align:center; color: white; font-weight: bold; background-color: green;'>Yes";} else {$output .= "<td style='text-align:center; color: white; font-weight: bold; background-color: red;'>No";}; $output .= "</td>";
                       $output .= "<td>". $row_fuel_oil['Arrival_Fuel'] . " L</td>";
                       if ($row_fuel_oil['Arrival_Oil_OK'] == '1') {$output .= "<td style='text-align:center; color: white; font-weight: bold; background-color: green;'>Yes";} else {$output .= "<td style='text-align:center; color: white; font-weight: bold; background-color: red;'>No";}; $output .= "</td>";
                       if (strtoupper($row_fuel_oil['Defects']) == 'NIL') {$output .= "<td>". $row_fuel_oil['Defects'];} else {$output .= "<td style='background-color: yellow;'>". $row_fuel_oil['Defects'];}; $output .= "</td>";
                       $output .= "</tr>";
                     }
                     $output .= "</table>";
                     $output .= "</td></tr>";
                     } else { $output .= "<p><strong>FUEL/OIL RECORD: No records found for this Daily Technical Log</strong><p>";
                              $output .= "</td></tr><tr><td colspan=5></td></tr>";
                            }

           }
      }
      else
      {
           $output .= '
                <tr>
                     <td colspan="5"><strong>No Flight Logs were found for this period.</strong></td>
                </tr>
           ';
      }
      $output .= '</table>';
      echo $output;
 }
 ?>
