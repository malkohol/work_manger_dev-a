  <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
		$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
include($root.'/script/conn.php');
$select =	$_GET['irany'];
		
		
		$sql_varos ="SELECT * FROM `varos` WHERE `ph2` = '$select'";
    $result_varos = mysql_query($sql_varos);
    while($varos = mysql_fetch_array($result_varos)){
    $varos = $varos['nev'];
		$varos = trim($varos);
		echo "".$varos."";
    }

?>

   