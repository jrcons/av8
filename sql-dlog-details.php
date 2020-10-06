$sql_aircraft = "SELECT DATE_FORMAT(d.log_date, '%d/%m/%Y') Log_Date, CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END) Total_Hrs_Today, concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date-(floor(d.total_hrs_to_date/60)*60)) Total_Hrs_To_Date, CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check, df.flt_no Flt_No, captain Captain, df.p2_passenger P2_Passenger, df.from_airport From_Airport, df.to_airport To_Airport, date_format(df.engine_start_up, '%h:%i') Engine_Start_Up, date_format(df.engine_shutdown, '%h:%i') Engine_Shutdown, date_format(df.engine_runtime, '%h:%i') Engine_Runtime, date_format(df.takeoff_time, '%h:%i') Takeoff_Time, date_format(df.landing_time, '%h:%i') Landing_Time,  date_format(df.airbourne_time, '%h:%i') Airbourne_Time, df.landings Landings, concat(floor(d.total_hrs_flown_prev/60), ' : ',d.total_hrs_flown_prev-(floor(d.total_hrs_flown_prev/60)*60)) Total_Hrs_Flown_Prev, CONCAT(CASE WHEN floor(d.Hours_To_Next_Check_Prev/60) > 9 THEN floor(d.Hours_To_Next_Check_Prev/60) WHEN floor(d.Hours_To_Next_Check_Prev/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.Hours_To_Next_Check_Prev/60),2,'0') END,':',CASE WHEN d.Hours_To_Next_Check_Prev < 0 then '00' else case WHEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) > 9 THEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) ELSE LPAD(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60),2,'0') END END) Hours_To_Next_Check_Prev FROM dlog d, dlog_flights df WHERE df.dlog_id = d.id AND d.callsign = 'GSHMI' ORDER BY d.log_date desc, df.flt_no";

$result = mysqli_query($link, $sql_aircraft);
    if (mysqli_num_rows($result) > 0) {
      echo "<table class='table table-bordered'>";
        echo "<tr>";
          echo "<th>Registration</th>";
          echo "<th>Date</th>";
          echo "<th>Flt No</th>";
          echo "<th>Captain</th>";
          echo "<th>P2 Passenger</th>";
          echo "<th>From Airport</th>";
          echo "<th>To Airport</th>";
          echo "<th>Engine Start</th>";
          echo "<th>Engine Shut Down</th>";
          echo "<th>Engine Runtime</th>";
          echo "<th>Takeoff Time</th>";
          echo "<th>Landing Time</th>";
          echo "<th>Airbourne Time</th>";
          echo "<th>Landings</th>";
        echo "</tr>";
      while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
            echo "<td>G-SHMI</td>";
            echo "<td>" . $row['Log_Date'] . "</td>";
            echo "<td>" . $row['Flt_No'] . "</td>";
            echo "<td>" . $row['Captain'] . "</td>";
            echo "<td>" . $row['P2_Passenger'] . "</td>";
            echo "<td>" . $row['From_Airport'] . "</td>";
            echo "<td>" . $row['To_Airport'] . "</td>";
            echo "<td>" . $row['Engine_Start_Up'] . "</td>";
            echo "<td>" . $row['Engine_Shutdown'] . "</td>";
            echo "<td>" . $row['Engine_Runtime'] . "</td>";
            echo "<td>" . $row['Takeoff_Time'] . "</td>";
            echo "<td>" . $row['Landing_Time'] . "</td>";
            echo "<td>" . $row['Airbourne_Time'] . "</td>";
            echo "<td>" . $row['Landings'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";





        $query = "
            SELECT d.id ID, DATE_FORMAT(d.log_date, '%d/%m/%Y') Log_Date, CONCAT(CASE WHEN floor(d.total_hrs_today/60) > 9 THEN floor(d.total_hrs_today/60) WHEN floor(d.total_hrs_today/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.total_hrs_today/60),2,'0') END,':',CASE WHEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) > 9 THEN floor(d.total_hrs_today-(floor(d.total_hrs_today/60)*60)) ELSE LPAD(d.total_hrs_today-(floor(d.total_hrs_today/60)*60),2,'0') END) Total_Hrs_Today,
            concat(floor(d.total_hrs_to_date/60), ' : ',d.total_hrs_to_date-(floor(d.total_hrs_to_date/60)*60)) Total_Hrs_To_Date,
            CONCAT(CASE WHEN floor(d.hours_to_next_check/60) > 9 THEN floor(d.hours_to_next_check/60) WHEN floor(d.hours_to_next_check/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.hours_to_next_check/60),2,'0') END,':',CASE WHEN d.hours_to_next_check < 0 then '00' else case WHEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) > 9 THEN floor(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60)) ELSE LPAD(d.hours_to_next_check-(floor(d.hours_to_next_check/60)*60),2,'0') END END) Hours_To_Next_Check,
            df.flt_no Flt_No, captain Captain, df.p2_passenger P2_Passenger, df.from_airport From_Airport, df.to_airport To_Airport, date_format(df.engine_start_up, '%h:%i') Engine_Start_Up,
            date_format(df.engine_shutdown, '%h:%i') Engine_Shutdown, date_format(df.engine_runtime, '%h:%i') Engine_Runtime, date_format(df.takeoff_time, '%h:%i') Takeoff_Time, date_format(df.landing_time, '%h:%i') Landing_Time,
            date_format(df.airbourne_time, '%h:%i') Airbourne_Time, df.landings Landings, concat(floor(d.total_hrs_flown_prev/60), ' : ',d.total_hrs_flown_prev-(floor(d.total_hrs_flown_prev/60)*60)) Total_Hrs_Flown_Prev,
            CONCAT(CASE WHEN floor(d.Hours_To_Next_Check_Prev/60) > 9 THEN floor(d.Hours_To_Next_Check_Prev/60) WHEN floor(d.Hours_To_Next_Check_Prev/60) <= 0 THEN '00' ELSE LPAD(FLOOR(d.Hours_To_Next_Check_Prev/60),2,'0') END,':',CASE WHEN d.Hours_To_Next_Check_Prev < 0 then '00' else case WHEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) > 9 THEN floor(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60)) ELSE LPAD(d.Hours_To_Next_Check_Prev-(floor(d.Hours_To_Next_Check_Prev/60)*60),2,'0') END END) Hours_To_Next_Check_Prev
            FROM dlog d, dlog_flights df WHERE df.dlog_id = d.id AND d.callsign = '".CALLSIGN."'
             AND d.Log_Date BETWEEN '".$from_date_conv."' AND '".$to_date_conv." ORDER BY d.log_date desc, df.flt_no'
