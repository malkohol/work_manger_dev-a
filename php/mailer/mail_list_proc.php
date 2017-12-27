  <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
		$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
include($root.'/script/conn.php');
 	
 	if(isset($_POST['mail_user_dat'])){
 		$mail_user_dat = $_POST['mail_user_dat'];
 		$sql_var = "where nev like '%".$mail_user_dat."%'  OR email like '%".$mail_user_dat."%'   OR tel like '%".$mail_user_dat."%' "; 
 	}else{
 		$sql_var = "";
 		}
 	
 			$count_db = 0;
 				
 				$sql_email ="SELECT * FROM  `mail_user` $sql_var  limit 0,40";
				$result_email = mysql_query($sql_email);
				while($email_list = mysql_fetch_array($result_email)){
 				$id = $email_list['id'];
 				$email = $email_list['email'];
 				$nev = $email_list['teljes_nev'];
 				$name = $email_list['name'];
 	 			$tel = $email_list['telefon'];
 	 			$aktiv = $email_list['aktiv'];
 			
$count_db++;
if($aktiv == 1){
$scipt_var = "passziv(this.id)";
$icon_class =   "";
$icon_glyph = 	"fa-eye";
}else{
$scipt_var = "aktiv(this.id)";
$icon_class =   "disabled";
$icon_glyph = 	"fa-eye-slash";
	}

echo "<div class='row'>";
echo "<div class='col-md-12'>";
$aktiv_var ="";
echo "<div class='col-md-2'> ".$nev."</div>";
echo "<div class='col-md-2'> ".$name ."</div>";
echo "<div class='col-md-2'> ".$email."</div>
<div class='col-md-2'>".$tel."</div>";
for ($ib = 0; $ib <= count($_SESSION['mail_user'])-1; $ib++) {
if($ib== $aktiv){
$aktiv_var = 	$_SESSION['mail_user'][$ib];
	}	
}

echo "<div class='col-md-2'> ".$aktiv_var."</div>";
echo '<div class="col-md-2"> 
<button id="'.$id.'" class="myBtn btn btn-primary btn-md" type="button" onclick="open_mail_user(this.id);"> Szerkesztés</button>';
echo "</div>";

echo "</div>";


echo "</div>";
				}?>
				
