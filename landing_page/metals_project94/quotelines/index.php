
<html>
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </head>

      <style media="screen">

      a{
        border-radius: 10px;
        display: block;
        width: 17%;
        height: 27px;
        border: none;

        text-decoration: none;
        font-family: arial;
        background-color: #00AD5F;
        font-size: 16px;
        color: #fff;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
      }
      h3{
        display: block;
       margin-top: 2%;
        width: 20%;
        text-decoration: none;
        height: 40px;
        border: none;
        background-color: #FF0000;
        font-family: arial;
        font-size: 16px;
        color: #fff;
        text-align: center;
        line-height: 40px;
        margin-left: 40%;

      }
      </style>
    <body>

        <div class="container">
            <br />
            <br />
			<br />
			<div class="table-responsive">

				<span id="result"></span>
				<div id="live_data"></div>
			</div>
		</div>

    </body>
</html>
<script>
$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"select.php",
            method:"POST",
            success:function(data){
				$('#live_data').html(data);
            }
        });
    }
    fetch_data();
    $(document).on('click', '#btn_add', function(){
        var order_item = $('#order_item').text();
        var quantity = $('#quantity').text();
        var uom = $('#uom').text();
        var unit_selling_price = $('#unit_selling_price').text();
        var unit_list_price = $('#unit_list_price').text();

        if(order_item == '')
        {
            alert("Enter Order Item");
            return false;
        }
        if(quantity == '')
        {
            alert("Enter Quantity");
            return false;
        }
        if(uom == '')
        {
            alert("Enter UOM");
            return false;
        }
        if(unit_selling_price == '')
        {
            alert("Enter Unit Selling Price");
            return false;
        }
        if(unit_list_price == '')
        {
            alert("Enter Unit List Price");
            return false;
        }

        $.ajax({
            url:"insert.php",
            method:"POST",
            data:{order_item:order_item,quantity:quantity,uom:uom,unit_selling_price:unit_selling_price,unit_list_price:unit_list_price},
            dataType:"text",
            success:function(data)
            {
                alert(data);
                fetch_data();
            }
        })
    });



	function edit_data(line_no, text, column_name)
    {
        $.ajax({
            url:"edit.php",
            method:"POST",
            data:{line_no:line_no, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
				$('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }
        });
    }
    $(document).on('blur', '.order_item', function(){
        var line_no= $(this).data("id1");
        var order_item = $(this).text();
        edit_data(line_no, order_item, "order_item");
    });
    $(document).on('blur', '.quantity', function(){
        var line_no = $(this).data("id2");
        var quantity = $(this).text();
        edit_data(line_no,quantity, "quantity");
    });
    $(document).on('blur', '.uom', function(){
        var line_no = $(this).data("id3");
        var uom = $(this).text();
        edit_data(line_no,uom, "uom");
    });
    $(document).on('blur', '.unit_selling_price', function(){
        var line_no = $(this).data("id4");
        var unit_selling_price = $(this).text();
        edit_data(line_no,unit_selling_price, "unit_selling_price");
    });
    $(document).on('blur', '.unit_list_price', function(){
        var line_no = $(this).data("id5");
        var unit_list_price = $(this).text();
        edit_data(line_no,unit_list_price, "unit_list_price");
    });

    $(document).on('click', '.btn_delete', function(){
        var line_no=$(this).data("id6");
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{line_no:line_no},
                dataType:"text",
                success:function(data){
                    alert(data);
                    fetch_data();
                }
            });
        }
    });
});
</script>
