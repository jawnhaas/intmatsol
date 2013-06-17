<?php
require_once('MDB2.php');
$dsn = 'mysql://inmatsol:Q1w2e3r4t5@127.0.0.1/intmatsol';
$mdb2 =& MDB2::factory($dsn);
$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);
?>
