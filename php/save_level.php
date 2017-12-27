 <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
	include($root.'/script/conn.php');

if($_GET['save_level']){
$nev = $_GET['save_level'];
$today = date("Y-m-d");
$rand = rand(100, 999);
$db_id_a = date("mdHis");  	
$db_id = "t_".$db_id_a;
$sql =
"INSERT INTO `project_lista_a` (
`id` ,
`nev` ,
`db_id` ,
`date`
)
VALUES (
NULL , '$nev', '$db_id', '$today'
);";
if (!mysql_query($sql,$con))
 			 {

  			die('Error: ' . mysql_error());
  		}else{

$sql1 = "CREATE TABLE $db_id( ".
       "id INT NOT NULL AUTO_INCREMENT, ".
       "db_id INT NOT NULL, ".
       "cegnev TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, ".
       "email TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, ".
       "send INT , ".
       "PRIMARY KEY ( id )); ";
mysql_select_db( $db_id );
$retval = mysql_query( $sql1, $con );
if(! $retval )
{
  die('Could not create table: ' . mysql_error());
}
echo "Table created successfully\n";

}


$last = count($_SESSION['mail'])-1;
$sql_values ="";
for ($k = 0; $k <= count($_SESSION['mail'])-1; $k++) {
if($last == $k){
$end_var = ";"; 
}else{
$end_var = "," ;	
	}
$sql_values .= "(NULL, '".$_SESSION['mail'][$k]['id']."', '".$_SESSION['mail'][$k]['cegnev']."', '".$_SESSION['mail'][$k]['email']."', '0')".$end_var;	
}	

$sql3 = "INSERT INTO $db_id (`id`, `db_id`, `cegnev`, `email`, `send`) VALUES  ".$sql_values." "; 

if (!mysql_query($sql3,$con)){
  die('Error: ' . mysql_error());
}

mysql_close($con);

}
?>