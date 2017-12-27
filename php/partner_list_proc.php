  <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
		$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
include($root.'/script/conn.php');
 	
 	if(isset($_POST['user_dat'])){
 		$user_dat = $_POST['user_dat'];
 		$sql_var = "where nev like '%".$user_dat."%'  OR email like '%".$user_dat."%'   OR telefonszam like '%".$user_dat."%' "; 
 	}else{
 		$sql_var = "";
 		}
 	
 			$count_db = 0;
 				
 				$sql_email ="SELECT * FROM  `ugyfel` $sql_var order by nev asc";
				$result_email = mysql_query($sql_email);
				while($email_list = mysql_fetch_array($result_email)){
 				$id = $email_list['id'];
 				$email = $email_list['email'];
 				$nev = $email_list['nev'];
 				$cim = $email_list['cim'];
 				$kapcsolat = $email_list['kapcsolat'];
 	 			$tel = $email_list['telefonszam'];
 	 			$email = $email_list['email'];
 	 			$adoszam = $email_list['adoszam'];
 	 			$bank = $email_list['bank'];
 	 			$banszamla = $email_list['banszamla'];
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

echo "<div style='bottom' class='row'>";



echo "<div class='col-md-2'><p>".$nev."</p></div>";
echo "<div class='col-md-2'><p>".$cim."</p> </div>

<div class='col-md-2'><b>Adószám:</b>".$adoszam."<br><b>Bank:</b>".$bank."<br>".$banszamla."</div>
<div class='col-md-1'> ".$kapcsolat."</div>
<div class='col-md-2'> ".$tel."</div>
<div class='col-md-2'> ".$email."</div>

<div class='col-md-1'><div id=".$id." class='myBtn btn btn-primary btn-md' type='button' onclick='open_parneter(this.id);'>Szerkeszt</div> </div>
</div>";






				}?>
				
	<script>					
						$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>