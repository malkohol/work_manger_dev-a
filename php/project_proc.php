<?
 if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	


	if(isset($_SESSION["mail"])){
		unset($_SESSION["mail"]);
		}
	

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
	include($root.'/script/conn.php');
	$count_szures = 0;
	$today = date("H-i-s"); 

if(isset($_GET["szures"])){
$szures = $_GET["szures"];

if($szures == 0){
	unset($_SESSION["mail"]);
	$sql_var = "WHERE `email` = 'a'";
}

if($szures == 1){
$sql_var = "WHERE email != 'nincs' ";	
	
}
if($szures == 2){
$sql_var = " WHERE nem = 0 and email != 'nincs' ";
	
}
if($szures == 3){
$sql_var = " WHERE nem = 1 and email != 'nincs' ";
	
}
if($szures == 4){
$sql_var = " WHERE admin = 1 and email != 'nincs' ";
	
}


							$sql_user="SELECT * FROM  `user_list`  $sql_var ";
  						$result_user = mysql_query($sql_user);
  						while($user = mysql_fetch_array($result_user)){
  					
  						$userid = $user['id'];
      				$usernev = $user['nev'];
  						$useremail = $user['email'];
  						$user_id= $user['id'];
								
								$_SESSION["mail"][$count_szures]['id'] = $userid ;
								$_SESSION["mail"][$count_szures]['cegnev'] = $usernev;
								$_SESSION["mail"][$count_szures]['email'] = $useremail;
								$count_szures++;
				
							
}
}

?>

  <div class="large-12 columns" id="">
 <div class="left" >Levelek Száma: </div>  <div class="left" ><? echo  $count_szures ?></div>
 </div>
 
  <div class="large-12 columns" id="mail_info_box">
  </div>	