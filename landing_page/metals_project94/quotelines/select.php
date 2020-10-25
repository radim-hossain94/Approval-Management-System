<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#hide1").click(function() {
        $("#hide_table").hide();
      });

    });
    $(document).ready(function() {
      $("#hide2").click(function() {
        $("#hide_table").hide();
      });

    });
    $(document).ready(function() {
      $("#hide3").click(function() {
        $("#hide_table").hide();
      });

    });
  </script>

  <style media="screen">
    .input-group-text {
      width: 260px;

    }

    .input-group-test {
      width: 50px;
      color:  	#FFA07A;
    }



    #discount-text {
      width: 75px;
    }

    ul li {
      padding: 2px 20px;

    }

    table {
      padding: 5px 20px;
      margin-left: 22px;
    }

    #first_table {
      margin-left: 40px;
    }

    #last_table {
      margin-left: 38px;
    }

    #button1 {
      margin-left: 30px;
    }

    #button2 {
      margin-left: 890px;
    }

    #test {
      font-size: 12px;
    }

    body {
      background-color: #E1E1E1;
    }

    .form-control {
      line-height: 220px;
      padding: 5px 5px;

    }
    .Agent{
      font-size: 15px;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>



<?php
 $connect = mysqli_connect("localhost", "root", "", "metal_project");
 $output = '';
 $sql = "SELECT * FROM quote_lines";
 $result = mysqli_query($connect, $sql);
 $output .= '

           <table  class="table-bordered text-center" style="width69%" align="center" id="last_table">
           <tr bgcolor="#F174F7">
               <th colspan="6">Quote Lines</th>
           </tr>
           <tr>
             <td align="">Line No.</td>
             <td align="">Order Item</td>
             <td align="">Quantity</td>
             <td align="">UOM</td>
             <td align="">Unit Selling Price</td>
             <td align="">Unit List Price</td>
           </tr>';
 $rows = mysqli_num_rows($result);
 if($rows > 0)
 {
	  if($rows > 3000)
	  {
		  $delete_records = $rows - 3000;
		  $delete_sql = "DELETE FROM quote_lines LIMIT $delete_records";
		  mysqli_query($connect, $delete_sql);
	  }
      while($row = mysqli_fetch_array($result))
      {
           $output .= '

                <tr class="table-light text-center">
                     <td>'.$row["line_no"].'</td>
                     <td class="order_item" data-id1="'.$row["line_no"].'" contenteditable>'.$row["order_item"].'</td>
                     <td class="quantity" data-id2="'.$row["line_no"].'" contenteditable>'.$row["quantity"].'</td>
                     <td class="uom" data-id3="'.$row["line_no"].'" contenteditable>'.$row["uom"].'</td>
                     <td class="unit_selling_price" data-id4="'.$row["line_no"].'" contenteditable>'.$row["unit_selling_price"].'</td>
                     <td class="unit_list_price" data-id5="'.$row["line_no"].'" contenteditable>'.$row["unit_list_price"].'</td>

                     <td class="text-danger"><button type="button" name="delete_btn" data-id6="'.$row["line_no"].'" class="btn btn-xs btn-danger btn_delete">x</button>-Delete Row-</td>
                </tr>
           ';
      }
      $output .= '
           <tr class="table-light text-center ">
                <td></td>
                <td id="order_item" contenteditable></td>
                <td id="quantity" contenteditable></td>
                <td id="uom" contenteditable></td>
                <td id="unit_selling_price" contenteditable></td>
                <td id="unit_list_price" contenteditable></td>

                <td class="text-success"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button>--Add Row--</td>
           </tr>
      ';
 }
 else
 {
      $output .= '
				<tr class="table-light text-center">
					<td></td>
          <td id="order_item" contenteditable></td>
          <td id="quantity" contenteditable></td>
          <td id="uom" contenteditable></td>
          <td id="unit_selling_price" contenteditable></td>
          <td id="unit_list_price" contenteditable></td>

					<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button>--Add Row--</td>
			   </tr>';
 }
 $output .= '</table>';
 echo $output;
 ?>
