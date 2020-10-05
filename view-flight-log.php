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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Flight Log</title>
  <link rel="stylesheet" href="av8_style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <style type="text/css">
  </style>
</head>

<body>
  <div class="page-header-av8">
    <a href="welcome.php" class="btn btn-warning">Back</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a></h4>
  </div>
  <p class="btn btn-primary btn-block" style="text-align:left; padding-left:6px;">
      <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
        <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
      </svg>
      G-SHMI Flight Logs (Sorted By Date, Descending)</p>

    <div class="container" style="width:95%">
       <table class='table'><tr><td>
                <p>Flight Date Filter</p>
           </td>
           <td>
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From:" />
           </td>
           <td>
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To:" />
           </td>
           <td>
                <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
           </td>
         </tr>
       </table>
      <div style="clear:both"></div>
      <div id="order_table">

            <?php
              //run SQL and prepare output HTML table
              $sql_dlog = "
              SELECT ID, DATE_FORMAT(d.log_date, '%d/%m/%Y')
              Log_Date,
              CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END)
              Total_Hrs_Today,
              concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date - (floor(d.total_hrs_to_date/60)*60))
              Total_Hrs_To_Date,
              CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check
              FROM dlog d WHERE d.callsign = '".CALLSIGN."' ORDER BY d.log_date desc";

              $result_dlog = mysqli_query($link, $sql_dlog);
                  if (mysqli_num_rows($result_dlog) > 0) {
                    echo "<table class='table table-bordered'>";
                      echo "<tr style='background-color:#337ab7; color: #fff'>";
                        echo "<th>Registration</th>";
                        echo "<th>Flight Date</th>";
                        echo "<th>Total Hours Flown</th>";
                        echo "<th>Total Hours To Date</th>";
                        echo "<th>Hours To Next Check</th>";
                      echo "</tr>";
                    while ($row = mysqli_fetch_array($result_dlog)) {
                        echo "<tr style='background-color: #f8f9d2; background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);'>";
                          echo "<td>".CALLSIGN."</td>";
                          echo "<td>" . $row['Log_Date'] . "</td>";
                          echo "<td>" . $row['Total_Hrs_Today'] . "</td>";
                          echo "<td>" . $row['Total_Hrs_To_Date'] . "</td>";
                          echo "<td>" . $row['Hours_To_Next_Check'] . "</td>";
                        echo "</tr>";
                        echo "<tr style='background-color: #aecad6; background-image: linear-gradient(315deg, #aecad6 0%, #b8d3fe 74%);'><td colspan=5><table class='table table-bordered'><tr>";
                          echo "<th>Flt No</th>";
                          echo "<th>Captain</th>";
                          echo "<th>Passenger</th>";
                          echo "<th>From Airport</th>";
                          echo "<th>To Airport</th>";
                          echo "<th>Engine Start-Up</th>";
                          echo "<th>Engine Shut-Down</th>";
                          echo "<th><strong>Engine Runtime</strong></th>";
                          echo "<th>Takeoff Time</th>";
                          echo "<th>Landing Time</th>";
                          echo "<th>Airborne Time</th>";
                          echo "<th><strong>Landings</strong></th>";
                        echo "</tr>";
                        $sql_dlog_flights = "
                          SELECT df.flt_no Flt_No,
                          captain Captain,
                          df.p2_passenger P2_Passenger,
                          df.from_airport From_Airport,
                          df.to_airport To_Airport,
                          date_format(df.engine_start_up, '%h:%i') Engine_Start_Up,
                          date_format(df.engine_shutdown, '%h:%i') Engine_Shutdown,
                          date_format(df.engine_runtime, '%h:%i') Engine_Runtime,
                          date_format(df.takeoff_time, '%h:%i') Takeoff_Time,
                          date_format(df.landing_time, '%h:%i') Landing_Time,
                          date_format(df.airbourne_time, '%h:%i') Airbourne_Time,
                          df.landings Landings
                          FROM dlog_flights df
                          WHERE df.dlog_id = ".$row['ID']."
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

                      }
                      echo "</table>";
                      // Free result set
                      mysqli_free_result($result_dlog);
                    } else {
                      echo "<h3>No flight logs matching your callsign were found.</h3>";}


                // Close connection
                mysqli_close($link);
                ?>
  </div>
  </div>
</body>
</html>
<script>
     $(document).ready(function(){
          $.datepicker.setDefaults({
               dateFormat: 'dd-mm-yy'
          });
          $(function(){
               $("#from_date").datepicker();
               $("#to_date").datepicker();
          });
          $('#filter').click(function(){
               var from_date = $('#from_date').val();
               var to_date = $('#to_date').val();
               if(from_date != '' && to_date != '')
               {
                    $.ajax({
                         url:"dlog-filter.php",
                         method:"POST",
                         data:{from_date:from_date, to_date:to_date},
                         success:function(data)
                         {
                              $('#order_table').html(data);
                         }
                    });
               }
               else
               {
                    alert("Please Select Flight Dates");
               }
          });
     });
</script>
