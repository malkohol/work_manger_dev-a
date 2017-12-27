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
$sql1="SELECT * FROM `project_lista_a` WHERE `id` = '$send_mail'";
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
	
	
	$sql_site_user="SELECT * FROM `user_list` WHERE `id` ='$db_id' ";
	$result_site_user=mysql_query($sql_site_user);
	while($email_site_user = mysql_fetch_array($result_site_user)){
	$cegnev = $email_site_user['nev'];
	$telfonszam = $email_site_user['tel'];
	$email = $email_site_user['email'];

	
	}
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

  
 $string_original = $szoveg;  
 $string_replaced = str_replace($mit,$mire,$string_original);  
  

 	$mail_script = "<html><body>";
	
		$mail_script  .=  '
<div class="mail_body" style="padding:10px 0px">
 			<div align="center">
 			<div align="left" id="bg" style="width: 600px;  ">
 			<div class="head" style=" width: 600px; padding: 5px 5px 10px;">
 			<div class="head_p" align="center"  style="display: inline; margin-left:5px; width: 100%"> <img src="'.$local.'/kep/lock_hirlevel01.jpg" alt="logo"  width="100%">
			</div>
 			<div align="center" class="head_sz" style="width: 540px; font-size: 34px; float:left;text-align: center;"></div>
 				<div class="clear" style="both: clear;"></div>
 			</div>
 		
 			<div style="margin: 10px;">'.$string_replaced.'</div>
			</div>
			<div class="foot" style="width: 600px; padding: 5px 5px 10px;">
 			<div class="foot_p" align="center"><a href="http://lockclub.dataplace.hu?remove_mail='.$email.'">Ha le szeretnél iratkozni, kattints ide</a></div>
 			<div class="foot_p" align="center"  style="display: inline; margin-left:5px; width: 100%"> <img src="'.$local.'/kep/lock_hirlevel04.jpg" alt="logo"  width="100%">
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

