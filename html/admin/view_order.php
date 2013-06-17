<?php
require('fpdf.php');
require('../db.php');

class PDF extends FPDF
{

	function Header()
	{
		$this->Image('intmatsol.jpg',5,8,80);	
	}

	function Footer()
	{
	 	$this->SetY(-15);
	    //Arial italic 8
	    $this->SetFont('Arial','I',8);
	    //Page number
	    $this->Cell(0,10,'Intelligent Material',0,0,'R');
  
	}
}
$order_id = $_REQUEST['id'];

$sql = 'select * from orders o
inner join order_items oi on oi.order_id = o.id
inner join order_coa oc on oc.order_id = o.id
inner join customers c on c.id = o.customer_id
inner join customers_addresses ca on ca.customer_id = c.id
inner join address a on a.id = ca.address_id 
where o.id = ' . $order_id;
$result = $mdb2->query($sql);
while ($row = $result->fetchRow()) {
$billCompany = $row['company_name'];
$billAddress1 =  $row['address1'];
$billAddress2 =  $row['address2'];
$billAddress3 =  $row['address3'];
$invoiceNumber = $_REQUEST['invoiceNumber'];
$billCity =  $row['city'];
$billRegion = $row['region'];
$billCountry = $row['country_code'];
$billPhone = $row['phone'];
$poNumber = $row['purchase_order_id'];
$shipper = $row['shipping_method'];
$requisitioner = $row['requisitioner'];
$fcaPoint = $_REQUEST['fca_point'];
$material_qty = $row['qty'];
$supplier = 'Intelligent Materials';
$material = $row['description'];
$material_price = $row['price'];
$total = $material_qty * $material_price;
$subTotal = $total;
$salesTax = $total * .7;
$shipping = $row['shipping_cost'];
$grandtotal = $total + $salesTax + $shipping;
$manufactureDate = $row['manufacture_date'];
$shipDate = $row['shipping_date'];
$batchNumber = $row['batch_number'];
$D995_Aim = $row['D995_Aim'];
$D995_Min = $row['D995_Min'];
$D995_Max = $row['D995_Max'];
$D90_Aim = $row['D90_Aim'];
$D90_Min = $row['D90_Min'];
$D90_Max = $row['D90_Max'];
$D50_Aim = $row['D50_Aim'];
$D50_Min = $row['D50_Min'];
$D50_Max = $row['D50_Max'];
$D10_Aim = $row['D10_Aim'];
$D10_Min = $row['D10_Min'];
$D10_Max = $row['D10_Max'];
$D995_Batch = $row['D995_Batch'];
$D90_Batch = $row['D90_Batch'];
$D50_Batch = $row['D50_Batch'];
$D10_Batch = $row['D10_Batch'];
}
$shipCompany = $billCompany;
$shipAddress1 = $billAddress1;
$shipAddress2 = $billAddress2;
$shipCity = $billCity;
$shipCountry = $billCountry;
$shipPhone = $billPhone;
$salesPerson = 'Howard Bell';


include '_pdf.php';
?>