<?php
include 'dbh.inc.php';

session_start();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="jquery-ui/css/bootstrap.css">
  <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#from" ).datepicker();
    } );
    </script>
    <script>
        $( function() {
            $( "#to" ).datepicker();
        } );
    </script>
    <style>
        label {
            margin: 8px ;
        }
        input {
            margin: 5px;
        }
        div{
            align-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <h3 style = "color:white">Search Submitted Assement Form</h3>
        </div>
        <div class="navbar-collapse collapse w-50 order-1 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <h4 style = "color:white"><a class="nav-link" href="homepage.php?login=Success">Home</a></h4>
            </li>
        </ul>
    </div>
    </nav>
<br>
<br>
    
<div class="input-group">
            <label class="col-sm-2 col-form-label">Assessment Number</label>
            <div class="col-sm-2">
            <input id="search" type="text" class="input-group-text">
            </div>
    </div>
<br>
<br>

    <table id="searchTable" class="table table-striped table-dark">
         <tr>
            <th>ASSESSMENT NUMBER</th>
            <th>ORGANIZATION_ID</th>
            <th>QUOTE_NUMBER</th>
            <th>QUOTE NAME</th>
            <th>QUOTE DATE</th>
            <th colspan="2">QUOTE STATUS</th>
        </tr>
        
        <?php
        
        $sql_tracked_form = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_STATUS = 'PENDING'
        AND ORG_ID = '".$_SESSION['ORG_ID']."'";

        $result_tracked_form = oci_parse($conn, $sql_tracked_form);
        oci_execute($result_tracked_form);
        while($row_tracked_form =oci_fetch_array($result_tracked_form,OCI_ASSOC)):

        
        ?>
        <tr>
        <td><?php echo $row_tracked_form['ASSESSMENT_NUMBER']; ?></td>
        <td><?php echo $row_tracked_form['ORGANIZATION_ID']; ?></td>
        <td><?php echo $row_tracked_form['QUOTE_NUMBER']; ?></td>
        <td><?php echo $row_tracked_form['QUOTE_NAME']; ?></td>
        <td><?php echo $row_tracked_form['QUOTE_DATE']; ?></td>
        <td><?php echo 'In Process'; ?></td>
        <td><a href="view_track_form.php?QUOTE_HEADER_ID=<?php echo $row_tracked_form['QUOTE_HEADER_ID']; ?>&ASSESSMENT_NUMBER=<?php echo  $row_tracked_form['ASSESSMENT_NUMBER']; ?>"><button type="button" class="btn btn-success">View</button></a></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
<script>
    $(document).ready(function(){
        $("#").on('keyup',function(){
            var ASSESSMENT_NUMBER =  $(this).val();
            console.log(ASSESSMENT_NUMBER);
            $.ajax({    
            url: "search_saved_assessment_form.php",
            type: "post",
            data: {ASSESSMENT_NUMBER:ASSESSMENT_NUMBER},
            dataType: "html",            
            success: function(response){
                $("#searchTable").html(response); 
            }
            });
        })
    });
    </script>
</html>