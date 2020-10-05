<?php
 $connect = mysqli_connect("localhost", "av8db", "av8db", "av8");
 $query = "SELECT d.id ID, DATE_FORMAT(d.log_date, '%d/%m/%Y') Log_Date, CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END) Total_Hrs_Today, concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date-(floor(d.total_hrs_to_date/60)*60)) Total_Hrs_To_Date, CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check, df.flt_no Flt_No, captain Captain, df.p2_passenger P2_Passenger, df.from_airport From_Airport, df.to_airport To_Airport, date_format(df.engine_start_up, '%h:%i') Engine_Start_Up, date_format(df.engine_shutdown, '%h:%i') Engine_Shutdown, date_format(df.engine_runtime, '%h:%i') Engine_Runtime, date_format(df.takeoff_time, '%h:%i') Takeoff_Time, date_format(df.landing_time, '%h:%i') Landing_Time,  date_format(df.airbourne_time, '%h:%i') Airbourne_Time, df.landings Landings, concat(floor(d.total_hrs_flown_prev/60), ' : ',d.total_hrs_flown_prev-(floor(d.total_hrs_flown_prev/60)*60)) Total_Hrs_Flown_Prev, CONCAT(CASE WHEN floor(d.Hours_To_Next_Check_Prev/60) > 9 THEN floor(d.Hours_To_Next_Check_Prev/60) WHEN floor(d.Hours_To_Next_Check_Prev/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.Hours_To_Next_Check_Prev/60),2,'0') END,':',CASE WHEN d.Hours_To_Next_Check_Prev < 0 then '00' else case WHEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) > 9 THEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) ELSE LPAD(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60),2,'0') END END) Hours_To_Next_Check_Prev FROM dlog d, dlog_flights df WHERE df.dlog_id = d.id AND d.callsign = 'GSHMI' ORDER BY d.log_date desc, df.flt_no";
 $result = mysqli_query($connect, $query);
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Test Date Picker</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:900px;">
                <h3 align="center">G-SHMI Flight Log (Orderd By Date Descending)</h3>
                <p align="center">Enter Flight Date Filter</p><br />
                <div class="col-md-3">
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Flight Date - From:" />
                </div>
                <div class="col-md-3">
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Fligh Date - To:" />
                </div>
                <div class="col-md-5">
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
                </div>
                <div style="clear:both"></div>
                <br />
                <div id="order_table">
                     <table class="table table-bordered">
                          <tr>
                               <th width="5%">ID</th>
                               <th width="30%">Registration</th>
                               <th width="43%">Flight Log Date</th>
                               <th width="10%">Total Hours To Date</th>
                               <th width="12%">Hours To Next Check</th>
                          </tr>
                     <?php
                     while($row = mysqli_fetch_array($result))
                     {
                     ?>
                          <tr>
                               <td><?php echo $row["ID"]; ?></td>
                               <td>G-SHMI</td>
                               <td><?php echo $row["Log_Date"]; ?></td>
                               <td><?php echo $row["Total_Hrs_To_Date"]; ?></td>
                               <td><?php echo $row["Hours_To_Next_Check"]; ?></td>
                          </tr>
                     <?php
                     }
                     ?>
                     </table>
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
