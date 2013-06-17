<?php
require('../db.php');

$sql = 'DELETE FROM orders WHERE id = ?';
$statement = $mdb2->prepare($sql);
$data = array($_REQUEST['id']);
$statement->execute($data);
$statement->free();

header( 'Location: index.php' ) ;
?>