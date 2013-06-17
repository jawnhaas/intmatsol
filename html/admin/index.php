<?php
require('fpdf.php');
require('../db.php');
?>
<html>
<head>
<title>Intelligent Material Solutions</title>
<link rel="stylesheet" type="text/css" media="screen" href="style.css" /> 
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.10.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
				// Datepicker
				$( "#datepicker" ).datepicker();
				$( "#datepicker2" ).datepicker();		
			});
		</script>

</head>
<body>
<table width="880">	
<tr><td><img src="intmatsol.png"></td>
			<td><h1>Order List</h1></td>
</tr>
</table>
<br /><br />
<div>
<button style="background-color:transparent;font-size:20px" onClick="window.location='order.php'">New Order</button>
<br /><br />
<?
$sql = 'select o.id, o.invoice_number, o.order_date, c.company_name from orders o
inner join customers c On c.id = o.`customer_id`
order by o.id desc';
$result = $mdb2->query($sql);
?><table cellspacing=10>
<tr>
	<td><b>Order Date</b></td>
	<td><b>Invoice #</b></td>
	<td><b>Customer</b></td>
	<td><b></b></td>
	<td><b></b></td>
</td>
</tr>
<?php
while ($row = $result->fetchRow()) {
	echo '<tr>';
	echo '<td>' . $row['order_date'] . '</td>';
	echo '<td align="right">' . $row['invoice_number'] . '</td>';
	echo '<td>' . $row['company_name'] . '</td>';
	echo '<td><a href="view_order.php?id=' . $row['id'] . '">view</a></td>';
	echo '<td><a href="delete.php?id=' . $row['id'] . '">delete</a></td>';
	
	echo '</tr>';
}
echo '</table>'
?>
