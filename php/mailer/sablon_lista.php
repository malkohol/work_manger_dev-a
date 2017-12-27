 <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}

	 
 include($root.'/script/conn.php');	
if(isset($_GET["save_sablon"])){
	
$my_textarea	= $_POST['my_textarea'];
$subject	= $_POST['subject'];
$nev = $_POST['nev'];
$today = date("Y-m-d");  		
	$sql="INSERT INTO `mail_sablon` (`id`, `nev`, `subject`, `szoveg`, `date`) 
	VALUES (NULL, '$nev', '$subject', '$my_textarea', '$today');";
	if (!mysql_query($sql,$con))
 			 {

  			die('Error: ' . mysql_error());
  		}
	
	}

if(isset($_GET["edit_sablon"])){
$id=	$_GET["edit_sablon"];
$my_textarea	= $_POST['my_textarea'];
$subject	= $_POST['subject'];
$nev = $_POST['nev'];
$today = date("Y-m-d");  	
	$sql="UPDATE `mail_sablon` SET `nev` = '$nev', `subject` = '$subject', `szoveg` = '$my_textarea', `date` = '$today' WHERE `id` = $id;";
	if (!mysql_query($sql,$con))
 			 {

  			die('Error: ' . mysql_error());
  		}
	
	}

 ?>

 <div class="col-md-12 ">
 	 <div class="row">
<h4>Sablon lista: </h4> 
<table class="table table-hover" data-toggle="table">
<? 						
							$count_sablon = 0;
							$sql_sablon="SELECT * FROM `mail_sablon`  ";
  						$result_sablon = mysql_query($sql_sablon);
  						while($sablon = mysql_fetch_array($result_sablon)){
  						$count_sablon++;	
  						$sbalon_id = $sablon['id'];
      				$sbalon_nev = $sablon['nev'];
  						$sbalon_subject = $sablon['subject'];
  						$sbalon_date = $sablon['date'];
      		 		echo "<tr><td >".$sbalon_nev."</td><td >".$sbalon_subject."</td><td>".$sbalon_date	."</td> <td><i id='".$sbalon_id."' onclick='load_sabon(this.id);' class='fa fa-pencil-square-o'></i></td>  <td><i id='".$sbalon_id."' onclick='delet_sabon(this.id);' class='fa fa-trash'></i></td></tr>";       		
      		  	}
if($count_sablon == 0){
echo "nincs sablon";	
	}			

?>
</table>
</div>
</div>
