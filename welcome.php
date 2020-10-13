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
    <title><?php echo CALLSIGN?> Main Page</title>
    <link rel="stylesheet" href="av8_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

</head>
<body class="av8_body">
  <div class="page-header-av8">
    Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!
    <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a></h4>
  </div>
    <div>
      <table align="center" class='blueTable'>
        <tr>
          <td>
          <?php
            //run SQL and prepare output HTML table
            $sql_aircraft = 'select Type, concat(floor(total_hrs_flown/60), " : ",total_hrs_flown-(floor(total_hrs_flown/60)*60)) Total_Hrs, concat(floor(hrs_to_next_check/60), " : ",hrs_to_next_check-(floor(hrs_to_next_check/60)*60)) Hrs_to_Next_Check, DATE_FORMAT(last_flown_date, "%d/%m/%Y") Last_Flown_Date, Last_Arrival_Fuel,  Last_Defects, DATE_FORMAT(insurance_due, "%d/%m/%Y") Insurance_Due_Date,DATE_FORMAT(permit_due, "%d/%m/%Y") Permit_Due_Date from aircraft where callsign = "'.CALLSIGN.'";';
            if ($result = mysqli_query($link, $sql_aircraft)) {
              if (mysqli_num_rows($result) > 0) {
                if (mysqli_num_rows($result) > 0) {
                  echo "<table class='table>";
                  while ($row = mysqli_fetch_array($result)) {
                      echo "<tr class='av8tr'><td colspan=2>".CALLSIGN." Current Details</td></tr>";
                      echo "<tr><td>Type:</td><td>" . $row['Type'] . "</td></tr>";
                      echo "<tr><td>Total Hours: </td><td>" . $row['Total_Hrs'] . "</td></tr>";
                      echo "<tr><td>Hours to Next Check:</td><td>" . $row['Hrs_to_Next_Check'] . "</td></tr>";
                      echo "<tr><td>Last Flown Date:</td><td>" . $row['Last_Flown_Date'] . "</td></tr>";
                      echo "<tr><td>Last Arrival Fuel:</td><td>" . $row['Last_Arrival_Fuel'] . " Liters</td></tr>";
                      if (strtoupper($row['Last_Defects']) == 'NIL') {echo "<tr><td>Last Flight Defects:</td><td>" . $row['Last_Defects'] . "</td></tr>";} else {echo "<tr><td>Last Flight Defects:</td><td style='background-color: yellow;'>" . $row['Last_Defects'] . "</td></tr>";}
                      //echo "<tr><td>Last Flight Defects:</td><td>" . $row['Last_Defects'] . "</td></tr>";
                      echo "<tr><td>Insurance Due Date:</td><td>" . $row['Insurance_Due_Date'] . "</td></tr>";
                      echo "<tr><td>Permit Due Date:</td><td>" . $row['Permit_Due_Date'] . "</td></tr>";
                    }
                    echo "</table>";
                    // Free result set
                    mysqli_free_result($result);
                  } else {
                    echo "<h3>No aircraft matching your callsign were found.<h3>";}
                } else {
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);}
              }
              // Close connection
              mysqli_close($link);
              ?>
          </td>
          <td >
            <p><a href="view-flight-log.php" class="btn btn-primary btn-block" style="text-align:left; padding-left:6px;">
              <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
              </svg>
              View Aicraft Flight Logs</a></p>
            <p><a href="documents.php" class="btn btn-primary btn-block" style="text-align:left; padding-left:6px">
              <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
              </svg>
              Read Group Rules and Other Documentation</a></p>
            <p><a href="https://www.shlott.com/calendar" target=”_blank” class="btn btn-warning btn-block" style="text-align:left; padding-left:6px">
              <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg>
              Create Shlott Booking</a></p>
            <p><a href="add-flight-log.php" class="btn btn-success btn-block" style="text-align:left; padding-left:6px">
              <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-bezier2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 0 1 2.5 1h1A1.5 1.5 0 0 1 5 2.5h4.134a1 1 0 1 1 0 1h-2.01c.18.18.34.381.484.605.638.992.892 2.354.892 3.895 0 1.993.257 3.092.713 3.7.356.476.895.721 1.787.784A1.5 1.5 0 0 1 12.5 11h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5H6.866a1 1 0 1 1 0-1h1.711a2.839 2.839 0 0 1-.165-.2C7.743 11.407 7.5 10.007 7.5 8c0-1.46-.246-2.597-.733-3.355-.39-.605-.952-1-1.767-1.112A1.5 1.5 0 0 1 3.5 5h-1A1.5 1.5 0 0 1 1 3.5v-1zM2.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10 10a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
              </svg>Add Daily Technical Log Entry</a></p>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
