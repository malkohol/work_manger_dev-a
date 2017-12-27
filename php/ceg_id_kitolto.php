<?
if(empty($_SESSION['local'])) {
session_start();
		$_SESSION['id'] = session_id();
		$root = $_SESSION['root'];
$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];

	}
		include ($root.'/script/conn.php');
		
$sql_products ="SELECT * FROM `kuldemeny`";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){
		$szam_cim = $product_list['szam_cim'];	
		$pid = $product_list['pid'];
		$pieces = explode("&", $szam_cim);
		$unev = $pieces[0];

		$sql_ugyfel ="SELECT * FROM `ugyfel` WHERE `nev` LIKE '%$unev%' ";
		$result_ugyfel = mysql_query($sql_ugyfel);
		while($ugyfel_list = mysql_fetch_array($result_ugyfel)){
		$id = $ugyfel_list['id'];
		$ugyfel_id = $ugyfel_list['ugyfel_id']; 
		echo $ugyfel_id."<br>";
		$sql ="UPDATE `kuldemeny` SET `megrendelo_id` = '$ugyfel_id' WHERE `pid` = '$pid';";
		 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
		}	
	
}

?>