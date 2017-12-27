 <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}

	 
 include($root.'/script/conn.php');
		

 	
$send_mail =  $_GET["send_mail"];	
$sql1="SELECT * FROM `project_lista` WHERE `id` = '$send_mail'";
$result=mysql_query($sql1);
while($adatM = mysql_fetch_array($result)){
$nev = $adatM['nev'];
$id = $adatM['id'];
$db_nev = $adatM['db_id'];
 

}

	$sql_table="SELECT * FROM `$db_nev`	 WHERE  `send` = '0' LIMIT 0,1";
	$result_table=mysql_query($sql_table);
	while($email_table = mysql_fetch_array($result_table)){
	$emaill = $email_table['email'];
	$cegnev = $email_table['cegnev'];
	$eid = $email_table['id'];
	$db_id = $email_table['db_id'];
	}

if (isset($emaill)) {
$sablon =  $_GET["sablon"];	

$sql_sablon="SELECT * FROM `mail_sablon` where id =  $sablon";
  						$result_sablon = mysql_query($sql_sablon);
  						while($sablon = mysql_fetch_array($result_sablon)){
  				  	$sbalon_id = $sablon['id'];
      				$sbalon_nev = $sablon['nev'];
  						$sbalon_subject = $sablon['subject'];
							$szoveg = $sablon['szoveg'];
}
 	$subject = $sbalon_subject; 
	$mail_script = "<html><body>";	
	
	
	$sql_site_user="SELECT * FROM `site_user` WHERE `id` ='$db_id' ";
	$result_site_user=mysql_query($sql_site_user);
	while($email_site_user = mysql_fetch_array($result_site_user)){
	$cegnev = $email_site_user['cegnev'];
	$telfonszam = $email_site_user['telszam'];
	$email = $email_site_user['email'];
	$szam_cim = $email_site_user['szam_cim'];
	$user_id = $email_site_user['user_id'];
	$act_date = $email_site_user['act_date'];
	
	}
	$stat = "";


$stat .= "Összes egyéni látogató:".round($_SESSION['munkamenet']*1.6)." db<br>";
$stat .= "Összes keresés a kategóriákban:".round($_SESSION['kategoria']*1.6)." db<br>";
$stat .= "Összes adatlap megnyitása:".round($_SESSION['adatlapnezet']*1.6)." db<br>";  
$stat .= "Az Ön adatlapjának megtekintése:".rand(5, 35)." db<br>";

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
  

 	$mail_script = "<html><body>";
	
		$mail_script  .=  '
<div class="mail_body" style="background: #0f3155;padding:10px 0px">
 			<div align="center">
 			<div align="left" id="bg" style="width: 600px; color: white; background: #0c2c42; ">
 			<div class="head" style="height: 50px;  background: rgba(4, 18, 31, 0.5) none repeat scroll 0 0; width: 600px;padding: 5px 0px 10px; ">
 			<div class="head_p" align="center" style="float:left;  margin-left:5px;"> <img src="'.$local.'/img/app_logo.png" alt="logo" height="50" width="37"></div>
 			<div align="center" class="head_sz" style="width: 80%; font-size: 200%; float:left;   text-align: center;">Autószervizek App</div>
 			<div class="clear" style="both: clear;"></div>
 			</div>
 		
 			<div style="both: clear;margin: 10px; padding-bottom:5px;">'.$string_replaced.'</div>
			</div>
 			<div align="left" id="bg" style="width: 600px; color: #0c2c42; background: rgba(4, 18, 31, 0.5) none repeat scroll 0 0; ">
		 <div style="padding:5px"> Amennyiben szeretne leiratkozni hírlevelünkről, kérjük kattintson az alábbi <a href="'.$local.'index.php?remove_news='.$email.'"> linkre </a>.</div>
 			
 			</div>
 			</div>
 			</div>

 ';
	
	
	$mail_script .= "</html></body>"; 	
	  
 	
  
  $email = $emaill;  		
  $mail = $mail_script;	
 			 
  include('send_mail.php');	
  
   $sq2=("UPDATE $db_nev SET send = 1 WHERE `id` = $eid");
     
if (!mysql_query($sq2,$con))
  {
  die('Error: ' . mysql_error());
  }

}else{
	
    
   ?>   <script>end_timer();</script> <?
  }
  


  ?>

