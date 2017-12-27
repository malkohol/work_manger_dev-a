<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$con = mysql_connect("dataplace.hu","dataplace_hu","vyczimqn");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_query("SET NAMES utf8", $con);
mysql_select_db("dataplace_hu_asap_teszt", $con);
?>