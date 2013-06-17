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
		<td><h1>Customer Order</h1></td>
	</tr>
	</table>
	<br /><br />
	<div>
<?php 
$hostname='127.0.0.1';
$username='inmatsol';
$password='Q1w2e3r4t5';
$dbname='intmatsol';

mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
mysql_select_db($dbname);

$query = 'SELECT id, company_name from customers where active = 1';
$result = mysql_query($query);
?>
<form action="generate.php" method="post">
	<table><tr>
		<td valign="top">
<div>Company:</div><?php
if($result) {
	?><div><select name="customer_id"><?php
    while($row = mysql_fetch_array($result)){
        ?><option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option><?php
        
    }
	?></select><?php
} else {
	?><div><input type="text" name="company_name" value="" width="200"></div><?php
	
}
?><p />
<div>Invoice Number</div>
<div><input type="text" name="invoiceNumber" value="" size="10"></div></p>
</td><td>
<div>Purchase Order Number</div>
<div><input type="text" name="purchase_order" value="" width="200"></div></p>
<div>Requisitioner</div>
<div><input type="text" name="requisitioner" value="" width="200"></div></p>
</td></tr>
</table>
<table>
	<tr><td valign="top">
<div class="tab">Material Info</div>
<div class="material">
<div>Info</div>
<div><textarea name="material"></textarea></p>
<div>Batch Number</div>
<div><input type="text" name="batch_number" value="" size="5"> </div></p>
<div>Quantity</div>
<div><input type="text" name="material_qty" value="" size="3"> Kg</div></p>
<div>Price</div>
<div>$<input type="text" name="material_price" value="" size="5"></div></p>
<div>Date of Manufacture</div>
<input type="text" name="manufactureDate" id="datepicker" size="10"></p>
</div>
</div>
</td><td width="20"></td><td valign="top">
<div class="tab">Shipping Info</div>
<div class="material">
<div>Shipper</div>
<div><select name="ship_method">
	<option>DHL</option>
	<option>Fed-Ex</option>
</select><p>
<div>
	Named Port/Place<br />
	<select name="named_port">
		<option>EXW</option>
		<option>FAS</option>
		<option>FCA</option>
		<option>FOB</option>
		<option>CFR</option>
		<option>CIF</option>
		<option>CPT</option>
		<option>CIP</option>
		<option>DAF</option>
		<option>DES</option>
		<option>DEQ</option>
		<option>DDU</option>
		<option>DDP</option>
	</select>
	<select name="ship_point">
	<option>Princeton, Nj</option>
	<option>New Brunswick, Nj</option>
	</select>
</div>
<div>Date Shipped</div>
<input type="text" name="shipDate" id="datepicker2" size="10"></p>
</div>
</div>
<br />

	<div class="tab">Certificate of Analysis</div>
	<div class="material">
	<table><tr>
		<td>Particle Size</td>
		<td align="right">Aim</td>
		<td align="right">Min</td>
		<td align="right">Max</td>
		<td align="right">Batch</td>
	</tr>
	<tr>
		<td>d(99.5), microns</td>
		<td><input class="coa" name="D995_Aim" size="1"></td>
		<td><input class="coa" name="D995_Min" size="1"></td>
		<td><input class="coa" name="D995_Max" size="1"></td>
		<td><input class="coa" name="D995_Batch" size="1"></td>
	</tr>
	<tr>
		<td>d(90), microns</td>
		<td><input class="coa" name="D90_Aim" size="1"></td>
		<td><input class="coa" name="D90_Min" size="1"></td>
		<td><input class="coa" name="D90_Max" size="1"></td>
		<td><input class="coa" name="D90_Batch" size="1"></td>		
	</tr>
	<tr>
		<td>d(50), microns</td>
		<td><input class="coa" name="D50_Aim" size="1"></td>
		<td><input class="coa" name="D50_Min" size="1"></td>
		<td><input class="coa" name="D50_Max" size="1"></td>
		<td><input class="coa" name="D50_Batch" size="1"></td>
	</tr>
	<tr>
		<td>d(10), microns</td>
		<td><input class="coa" name="D10_Aim" size="1"></td>
		<td><input class="coa" name="D10_Min" size="1"></td>
		<td><input class="coa" name="D10_Max" size="1"></td>
		<td><input class="coa" name="D10_Batch" size="1"></td>
	</tr>
</table>
</div>
</td></tr>
</table>
<table width="700">	
	<tr>
		<td align="right"><input type="submit" value="Generate Order"></td>
	</tr>
	</table>

