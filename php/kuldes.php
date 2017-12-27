 <? if(empty($_SESSION['loc	al'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
	include ($root.'script/conn.php');
	?>
		
		
		
		
<?	
$mail_body ="";	
			if(isset($_GET['send_work'])){
				
				$id = $_GET['send_work'];
  			$sql_kuldemeny="SELECT * FROM `kuldemeny` WHERE `pid` =$id";
  			$result_kuldemeny = mysql_query($sql_kuldemeny);
  			while($kuldemeny_list = mysql_fetch_array($result_kuldemeny)){

  			$csomag_felvetel= $kuldemeny_list['csomag_felvetel'];
  			$csomag_cel= $kuldemeny_list['csomag_cel'];
  			$csomag_adat= $kuldemeny_list['csomag_adat'];
  			$csomag_adat= $kuldemeny_list['csomag_adat'];
  			$szam_cim= $kuldemeny_list['szam_cim'];
  			$futar= $kuldemeny_list['futar'];
  			$description = $kuldemeny_list['description'];
  			$start_date = $kuldemeny_list['start_date'];
  			$munkaszam = $kuldemeny_list['munkaszam'];
  			$fizetes = $kuldemeny_list['fizetes'];
  			
  			}
	 $csomag_f = explode("&", $csomag_felvetel);
	$csomag_c = explode("&", $csomag_cel);
	$csomag_a = explode("&", $csomag_adat);
		$szam_c = explode("&", $szam_cim);
	
	if($fizetes ==0 ){
		$fizetes_var = "Készpénz";
		}
	if($fizetes ==1 ){
		$fizetes_var = "Átutalás";
		}
	$mail_body .=	"<h3>Csomag felvétel:</h3>"."<br>";
	$mail_body .=	"Megrendelő:".$csomag_f[0]."<br>";
	$mail_body .=	"Cím:".$csomag_f[1]."<br>";
	$mail_body .=	"Kapcsolattaró:".$csomag_f[2]."<br>";		
	$mail_body .=	"Telefon:".$csomag_f[3]."<br>";	

	$mail_body .=	"<h3>Csomag címzett:</h3>"."<br>";
	$mail_body .=	"Címzett:".$csomag_c[0]."<br>";
	$mail_body .=	"Cím:".$csomag_c[1]."<br>";
	$mail_body .=	"Kapcsolattartó:".$csomag_c[2]."<br>";		
	$mail_body .=	"Telefon:".$csomag_c[3]."<br>";	
	
	$mail_body .=	"<h3>Megrendelő Adatai:</h3>"."<br>";
	$mail_body .=	"Megrendelő:".$szam_c[0]."<br>";
	$mail_body .=	"Cím:".$szam_c[1]."<br>";
	$mail_body .=	"Kapcsolattaró:".$szam_c[2]."<br>";		
	$mail_body .=	"Telefon:".$szam_c[3]."<br>";
	
	$mail_body .=	"<h3>Csomag adatai:</h3>"."<br>";
	$mail_body .=	"Csomag megnevezés:".$csomag_a[1]."<br>";	
	$mail_body .=	"Szallitási díj  :".$csomag_a[0]." db <br>";
	$mail_body .=	"Csomag  :".$csomag_a[2]." db <br>";
	$mail_body .=	"Utánvét: ".$csomag_a[3]." Ft <br>";
	$mail_body .= "Küldemény azonosító:".$munkaszam."<br>";
	$mail_body .= "Fizetes modja:".$fizetes_var."<br>";
	$mail_body .= "Megjegyzés:".$description."<br>";
	$mail_body .= "Kiszállitás dátuma:".$start_date;
	
	$sql_futar="SELECT * FROM `user` WHERE `user_id` =$futar";
  $result_futar = mysql_query($sql_futar);
  while($futar_list = mysql_fetch_array($result_futar)){
	$email = $futar_list['email'];
	$push_id = $futar_list['push_up'];

}

/*
	include('send_mail.php');
	*/
 $ch = curl_init("https://fcm.googleapis.com/fcm/send");	
$title ="Csomag Felvétel helye:";	
$message =$csomag_f[0]." ".$csomag_f[1];
//Creating the notification array.
    $notification = array('title' =>$title , 'text' => $message, 'sound' => 'default');

    //This array contains, the token and the notification. The 'to' attribute stores the token.
    $arrayToSend = array('to' => $push_id, 'notification' => $notification,'priority'=>'high');

    //Generating JSON encoded string form the above array.
    $json = json_encode($arrayToSend);
    //Setup headers:
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key= AIzaSyC3t3aB8M9gpA1nZHUxX8ziu5Ii1Gtalk0'; // key here

    //Setup curl, add headers and post parameters.
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       

    //Send the request
    $response = curl_exec($ch);

    //Close request
    curl_close($ch);
    return $response;

}

?>
