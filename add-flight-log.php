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

$query = "SELECT DATE_FORMAT(init_date, '%d/%m/%Y') init_date FROM aircraft WHERE callsign = '".CALLSIGN."'";
$result = mysqli_query($link, $query);
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)) {
    $init_date = $row["init_date"];
  }
}
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Add Daily Technical Log for <?php echo CALLSIGN?></title>
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
      <a href="logout.php" class="btn btn-danger">Sign Out</a></h4>
    </div>
    <p class="btn btn-success btn-block" style="text-align:left; padding-left:6px;">
        <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-bezier2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 0 1 2.5 1h1A1.5 1.5 0 0 1 5 2.5h4.134a1 1 0 1 1 0 1h-2.01c.18.18.34.381.484.605.638.992.892 2.354.892 3.895 0 1.993.257 3.092.713 3.7.356.476.895.721 1.787.784A1.5 1.5 0 0 1 12.5 11h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5H6.866a1 1 0 1 1 0-1h1.711a2.839 2.839 0 0 1-.165-.2C7.743 11.407 7.5 10.007 7.5 8c0-1.46-.246-2.597-.733-3.355-.39-.605-.952-1-1.767-1.112A1.5 1.5 0 0 1 3.5 5h-1A1.5 1.5 0 0 1 1 3.5v-1zM2.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10 10a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
      </svg>Add Aicraft Daily Technical Log for <?php echo CALLSIGN?>
    </p>

      <!-- Body -->
    <div class="container" style="width:99%">
      <table class='table' style="width:50%">
        <tr>
          <td>
            <input type="text" name="select_date" id="select_date" value="<?php echo date('d-m-Y');?>" class="form-control" placeholder="Choose a Date" />
          </td>
          <td>
            <input type="button" name="select_date_btn" id="select_date_btn" value="Select Date" class="btn btn-info" />
          </td>
        </tr>
      </table>
      <!--<div style="clear:both"></div>-->
      <div id="insert_table">
        <p>Select a date. Based on the selection, you will create a new Daily Technical Log entry (if there isn't one created already for the selected date) or insert a new Flight into an existing Technical log.</p>
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
              $("#select_date").datepicker();
            });

      //Filter Function
      $('#select_date_btn').click(function(){
           var TodayDate = new Date();
           var sel_date = $('#select_date').val();
           var dateParts = sel_date.split("-");
           var select_date = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
           //var select_date = new Date(Date.parse($("#select_date").val()));
           var id = "<?php echo $init_date?>";
           var from = id.split("/");
           var init_date = new Date(from[2], from[1] - 1, from[0]);

           if (select_date != '') {
             if ( select_date < init_date ) {
               alert("Please Select a Date higher than the Aircraft Initialization Date (" + id + ")");
             } else if (select_date > TodayDate) {
               alert("Please do not select a date in the future");
             } else {
               $.ajax({
               url:"add-flight-form.php",
               method:"POST",
               data:{select_date:sel_date},
               success:function(data)
                 {
                      $('#insert_table').html(data);
                 }
               });
              }
            }
           else
           {
                alert("Please Select Flight Date");
           }

       });

      });
</script>
