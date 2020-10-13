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
    <title>View <?php echo CALLSIGN?> Daily Technical Log</title>
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
      </svg><?php echo CALLSIGN?> Flight Logs (Sorted By Date, Descending)
    </p>

    <!-- Body -->
    <div class="container" style="width:95%">
      <table class='table'>
        <tr>
          <td>
            <input type="button" name="prevmonth" id="prevmonth" value="Previous" class="btn btn-info btn-block" />
          </td>
          <td>
            <input type="button" name="currmonth" id="currmonth" value="Current Month" class="btn btn-info btn-block" />
          </td>
          <td>
            <input type="button" name="nextmonth" id="nextmonth" value="Next" class="btn btn-info btn-block" />
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
        FROM dlog d WHERE exists (select 1 from dlog_flights where dlog_id = d.id) and d.callsign = '".CALLSIGN."' ORDER BY d.log_date desc";

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
                  echo "<tr class='av8tr'>";
                    echo "<td>".CALLSIGN."</td>";
                    echo "<td>" . $row['Log_Date'] . "</td>";
                    echo "<td>" . $row['Total_Hrs_Today'] . "</td>";
                    echo "<td>" . $row['Total_Hrs_To_Date'] . "</td>";
                    echo "<td>" . $row['Hours_To_Next_Check'] . "</td>";
                  echo "</tr>";
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

                  //Fuel/Oil Record
                  $sql_dlog_fuel_oil = "
                  SELECT Flt_No, Uplift_Fuel, Uplift_Oil, Departure_Fuel, Departure_Oil_OK, Arrival_Fuel, Arrival_Oil_OK, Defects FROM dlog_fuel_oil
                  WHERE dlog_id = ".$row['ID']."
                  order by flt_no";
                  $result_dlog_fuel_oil = mysqli_query($link, $sql_dlog_fuel_oil);
                  if (mysqli_num_rows($result_dlog_fuel_oil) > 0) {
                      echo "<p><strong>FUEL/OIL RECORD - Litres</strong></p>";
                      echo "<table class='table table-bordered' style='width: 60%'>";
                      echo "<tr>";
                      echo "<td style='width: 10%'>Flight No</td>";
                      echo "<td style='width: 10%'>Uplift Fuel</td>";
                      echo "<td style='width: 10%'>Uplift Oil</td>";
                      echo "<td style='width: 10%'>Departure Fuel</td>";
                      echo "<td style='width: 10%; text-align:center;'>Departure Oil OK?</td>";
                      echo "<td style='width: 10%'>Arrival Fuel</td>";
                      echo "<td style='width: 10%; text-align:center;'>Arrival Oil OK?</td>";
                      echo "<td style='width: 30%'>Defects</td>";
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
              } else {
                echo "<p><strong>No Daily Technical Logs matching your Aircraft Callsign were found.</strong></p>";}


          // Close connection
          mysqli_close($link);
      ?>
      </div>
    </div>
  </body>
</html>

<script>
  $(document).ready(function(){
    var mth_selector = 0;

        $.datepicker.setDefaults({
          dateFormat: 'dd-mm-yy'
        });
        $(function(){
          $("#from_date").datepicker();
          $("#to_date").datepicker();
        });

    //Prev/Current/Next Month Functions
    $('#prevmonth').click(function(){
      mth_selector = mth_selector-1;
      var frmd = Date.today().addMonths(mth_selector).clearTime().moveToFirstDayOfMonth().toString("dd-MM-yyyy");
      var tod = Date.today().addMonths(mth_selector).clearTime().moveToLastDayOfMonth().toString("dd-MM-yyyy");
        $.ajax({
             url:"dlog-filter.php",
             method:"POST",
               data:{from_date:frmd, to_date:tod},
             success:function(data)
             {
                  $('#order_table').html(data);
             }
        });
      });
    $('#currmonth').click(function(){
      mth_selector = 0;
      var frmd = Date.today().clearTime().moveToFirstDayOfMonth().toString("dd-MM-yyyy");
      var tod = Date.today().clearTime().moveToLastDayOfMonth().toString("dd-MM-yyyy");
        $.ajax({
             url:"dlog-filter.php",
             method:"POST",
             data:{from_date:frmd, to_date:tod},
             success:function(data)
             {
                  $('#order_table').html(data);
             }
        });
      });
      $('#nextmonth').click(function(){
          mth_selector = mth_selector + 1;
          var frmd = Date.today().addMonths(mth_selector).clearTime().moveToFirstDayOfMonth().toString("dd-MM-yyyy");
          var tod = Date.today().addMonths(mth_selector).clearTime().moveToLastDayOfMonth().toString("dd-MM-yyyy");
          $.ajax({
               url:"dlog-filter.php",
               method:"POST",
               data:{from_date:frmd, to_date:tod},
               success:function(data)
               {
                    $('#order_table').html(data);
               }
          });
        });

      //Filter Function
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
