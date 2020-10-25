<HTML>
<HEAD>
	<TITLE> Add/Remove dynamic rows in HTML table </TITLE>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</HEAD>

<BODY>

<script>


		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[2].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[2].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}


			var LINE_NO = document.getElementById('LINE_NO').value;
			var QUANTITY = document.getElementById('QUANTITY').value;
			var UNIT_OF_MEASURE = document.getElementById('UNIT_OF_MEASURE').value;
			var UNIT_SELLING_PRICE = document.getElementById('UNIT_SELLING_PRICE').value;


		if(LINE_NO == '')
        {
            alert("Enter Order Item");
            return false;
        }
        if(QUANTITY == '')
        {
            alert("Enter Quantity");
            return false;
        }
        if(UNIT_OF_MEASURE == '')
        {
            alert("Enter UOM");
            return false;
        }
        if(UNIT_SELLING_PRICE == '')
        {
            alert("Enter Unit Selling Price");
            return false;
        }

		$.ajax({
            url:"insert.php",
            method:"POST",
            data:{LINE_NO:LINE_NO,QUANTITY,UNIT_OF_MEASURE,UNIT_SELLING_PRICE},
            dataType:"text",
            success:function(data)
            {
                alert(data);
                // fetch_data();
            }
        });
        


		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 3) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</script>


	<INPUT type="button" value="Add Row" onclick="addRow('last_table')" />

	<INPUT type="button" value="Delete Row" onclick="deleteRow('last_table')" />

	<TABLE id="last_table" width="350px" border="1">
    <TR bgcolor="#F174F7">
    <TD colspan = "7">Quote Lines</TD>
    </TR>
   <TR>
   <td>Mark</td>
    <TD>Line No.</TD>
    <TD>Order Item</TD>
    <TD>Quantity</TD>
    <TD>UOM</TD>
    <TD>Unit Selling Price</TD>
    <TD>Unit List Price</TD>
    
    </TR>
		<TR>
			<TD><INPUT type="checkbox" name="chk"/></TD>
			<TD><INPUT type="text" name="LINE_NO" id="LINE_NO"/></TD>
            
			<TD>
				<INPUT type="text" name=""/>
			</TD>
            <TD>
				<INPUT type="text" name="QUANTITY" id="QUANTITY"/>
			</TD>
            <TD>
				<INPUT type="text" name="UNIT_OF_MEASURE" id="UNIT_OF_MEASURE"/>
			</TD>
            <TD>
				<INPUT type="text" name="UNIT_SELLING_PRICE" id="UNIT_SELLING_PRICE"/>
			</TD>
            <TD>
				<INPUT type="text" name="UNIT_LIST_PRPICE" id=""/>
			</TD>
            
		</TR>
	</TABLE>

</BODY>
</HTML>