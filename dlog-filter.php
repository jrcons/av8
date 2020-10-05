<?php
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
      CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check
      FROM dlog d WHERE d.callsign = '".CALLSIGN."' AND d.Log_Date BETWEEN '".$from_date_conv."' AND '".$to_date_conv." ORDER BY d.log_date desc'
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
                     <tr style="background-color: #f8f9d2; background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);">
                          <td>'.CALLSIGN.'</td>
                          <td>'. $row["Log_Date"] .'</td>
                          <td> '. $row["Total_Hrs_Today"] .'</td>
                          <td>'. $row["Total_Hrs_To_Date"] .'</td>
                          <td>'. $row["Hours_To_Next_Check"] .'</td>
                     </tr>
                     <tr style="background-color: #aecad6; background-image: linear-gradient(315deg, #aecad6 0%, #b8d3fe 74%);"><td colspan=5><table class="table table-bordered"><tr>
                       <th>Flt No</th>
                       <th>Captain</th>
                       <th>Passenger</th>
                       <th>From Airport</th>
                       <th>To Airport</th>
                       <th>Engine Start-Up</th>
                       <th>Engine Shut-Down</th>
                       <th><strong>Engine Runtime</strong></th>
                       <th>Takeoff Time</th>
                       <th>Landing Time</th>
                       <th>Airborne Time</th>
                       <th><strong>Landings</strong></th>
                      </tr>';
                     $sql_dlog_flights = '
                       SELECT df.flt_no Flt_No,
                       captain Captain,
                       df.p2_passenger P2_Passenger,
                       df.from_airport From_Airport,
                       df.to_airport To_Airport,
                       date_format(df.engine_start_up, "%h:%i") Engine_Start_Up,
                       date_format(df.engine_shutdown, "%h:%i") Engine_Shutdown,
                       date_format(df.engine_runtime, "%h:%i") Engine_Runtime,
                       date_format(df.takeoff_time, "%h:%i") Takeoff_Time,
                       date_format(df.landing_time, "%h:%i") Landing_Time,
                       date_format(df.airbourne_time, "%h:%i") Airbourne_Time,
                       df.landings Landings
                       FROM dlog_flights df
                       WHERE df.dlog_id = '.$row["ID"].'
                       ORDER BY df.flt_no';
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
           }
      }
      else
      {
           $output .= '
                <tr>
                     <td colspan="5">No Flight Logs Found!</td>
                </tr>
           ';
      }
      $output .= '</table>';
      echo $output;
 }
 ?>