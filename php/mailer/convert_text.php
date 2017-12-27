<?
	if(empty($_SESSION['local'])) {
session_start();
		
$local = $_SESSION['local'];
}else{
	
	$local = $_SESSION['local'];

	}

$cegnev ="Teszt cég";
$telfonszam ="06205514509";
$email ="tesz@email.hu";
$szam_cim ="1158 drégelyvár utca 5 6/38";
$user_id ="11112121212";
$act_date ="2015-07-25" ; 
$szoveg = $_POST['my_textarea'];
$stat = "";



  
 $mit[] = "#cegnev#";  
 $mit[] = "#telfonszam#";  
 $mit[] = "#email#";  
 $mit[] = "#szam_cim#"; 
 $mit[] = "#user_id#"; 
 $mit[] = "#act_date#";
 $mit[] = "#stat#";

 $mire[] = $cegnev;  
 $mire[] = $telfonszam;  
 $mire[] = $email;  
 $mire[] = $szam_cim;
 $mire[] = $user_id;
 $mire[] = $act_date; 
 $mire[] = $stat;  
  
 $string_original = $szoveg;  
 $string_replaced = str_replace($mit,$mire,$string_original);  
 
 

 echo '
<div class="mail_body" style="padding:10px 0px">
 			<div align="center">
 			<div align="left" id="bg" style="width: 600px;  ">
 			<div class="head" style=" width: 600px; padding: 5px 5px 10px;">
 			<div class="head_p" align="center"  style="display: inline; margin-left:5px; width: 100%"> <img src="'.$local.'/kep/lock_hirlevel01.jpg" alt="logo" height="100%" width="100%">
			</div>
 			<div align="center" class="head_sz" style="width: 540px; font-size: 34px; float:left;text-align: center;"></div>
 				<div class="clear" style="both: clear;"></div>
 			</div>
 		
 			<div style="margin: 10px;">'.$string_replaced.'</div>
			</div>
			<div class="foot" style="width: 600px; padding: 5px 5px 10px;">
 			<div class="foot_p" align="center"  style="display: inline; margin-left:5px; width: 100%"> <img src="'.$local.'/kep/lock_hirlevel04.jpg" alt="logo" height="100%" width="100%">
			</div>
 			</div>
 			</div>
 '; 
 
  
?>

