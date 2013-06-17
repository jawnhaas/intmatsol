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


$customer_id = $_REQUEST['customer_id'];
$mdb2->setOption('debug', 1);
$sql = 'select * from customers_addresses ca 
inner join address a on a.id = ca.address_id 
inner join customers c ON c.id = ca.customer_id 
where ca.customer_id = ' . $customer_id;
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
}
if (PEAR::isError($mdb2)) {
    die($mdb2->getMessage());
}
$shipCompany = $billCompany;
$shipAddress1 = $billAddress1;
$shipAddress2 = $billAddress2;
$shipCity = $billCity;
$shipCountry = $billCountry;
$shipPhone = $billPhone;
$salesPerson = 'Howard Bell';
$poNumber = $_REQUEST['purchase_order'];
$shipper = $_REQUEST['ship_method'];
$requisitioner = $_REQUEST['requisitioner'];
$fcaPoint = $_REQUEST['fca_point'];
$material_qty = $_REQUEST['material_qty'];
$supplier = 'Intelligent Materials';
$material = $_REQUEST['material'];
$material_price = $_REQUEST['material_price'];
$total = $material_qty * $material_price;
$subTotal = $total;
$salesTax = 0;
$shipping = 0;
$grandtotal = $total + $salesTax + $shipping;
$manufactureDate = $_REQUEST['manufactureDate'];
$shipDate = $_REQUEST['shipDate'];
$batchNumber = $_REQUEST['batch_number'];
$D995_Aim = $_REQUEST['D995_Aim'];
$D995_Min = $_REQUEST['D995_Min'];
$D995_Max = $_REQUEST['D995_Max'];
$D90_Aim = $_REQUEST['D90_Aim'];
$D90_Min = $_REQUEST['D90_Min'];
$D90_Max = $_REQUEST['D90_Max'];
$D50_Aim = $_REQUEST['D50_Aim'];
$D50_Min = $_REQUEST['D50_Min'];
$D50_Max = $_REQUEST['D50_Max'];
$D10_Aim = $_REQUEST['D10_Aim'];
$D10_Min = $_REQUEST['D10_Min'];
$D10_Max = $_REQUEST['D10_Max'];
$D995_Batch = $_REQUEST['D995_Batch'];
$D90_Batch = $_REQUEST['D90_Batch'];
$D50_Batch = $_REQUEST['D50_Batch'];
$D10_Batch = $_REQUEST['D10_Batch'];

$sql = 'INSERT INTO orders (purchase_order_id, invoice_number, customer_id, requisitioner, shipping_method, shipping_cost, shipping_date, sales_person) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
$statement = $mdb2->prepare($sql);
$data = array($poNumber, $invoiceNumber, $customer_id, $requisitioner, $shipper, $shipping, $shipDate, 'Howard Bell');
$statement->execute($data);
$statement->free();
$id = $mdb2->lastInsertID('orders','id');
$sql = 'INSERT INTO order_items (order_id,description,batch_number,qty,price,manufacture_date) VALUES (?,?,?,?,?,?)';
$statement = $mdb2->prepare($sql);
$data = array($id,$material,$batchNumber,$material_qty,$material_price,$maufactureDate);
$statement->execute($data);
$statement->free();
$sql = "INSERT INTO order_coa (D995_Aim, D995_Min, D995_Max, D90_Aim, D90_Min, D90_Max, D50_Aim, D50_Min, D50_Max, D10_Aim, D10_Min, D10_Max, order_id, D995_Batch, D90_Batch, D50_Batch, D10_Batch) VALUES (?,?,?,?,?,?,?,?,?,?,?,?, ?,?,?,?,?)";
$statement = $mdb2->prepare($sql);
if (PEAR::isError($statement)) {
    echo ($statement->getMessage().' - '.$statement->getUserinfo());
    exit();
}
$data = array($D995_Aim, $D995_Min, $D995_Max, $D90_Aim, $D90_Min, $D90_Max, $D50_Aim, $D50_Min, $D50_Max, $D10_Aim, $D10_Min, $D10_Max, $id, $D995_Batch, $D90_Batch, $D50_Batch, $D10_Batch);
$statement->execute($data);

$statement->free();
include '_pdf.php';
?>

