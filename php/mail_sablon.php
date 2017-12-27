	<?
	
	$csomag_f[0] = "TSPC Kft";
	$csomag_f[1] = "1053 Budapest Magyar u. 36 4. em";
	$csomag_f[2] = "Vecsési Krisztina";
	$csomag_f[3] = "+3618009191";
	
	$csomag_c[0] = "Rendszerinformatika Zrt.";
	$csomag_c[1] = "1134 Budapest Váci út 19. Panorámaház 4. em";
	$csomag_c[2] = "Fóris Tibor";
	$csomag_c[3] = "+36202810678";
	
	$szam_c[0] = "Rendszerinformatika Zrt.";
	$szam_c[1] = "1134 Budapest Váci út 19";
	$szam_c[2] = "Fóris Tibor";
	$szam_c[3] = "+36202810678";
	
	$csomag_a[0] = "2490 ";
	$csomag_a[1] = "it eszközök";
	$csomag_a[2] = "3 ";
	$csomag_a[3] = "";
	$munkaszam = "20170823093929";
	$fizetes_var = "Átutalás";
	$comment  = "";
	$start_date  = "2017-08-23 ";
	$mail_body ='
	 <head>
  <meta charset="UTF-8">
</head> 
	<body style="background-color:white;color:black;width:100%" align="center">';
		$mail_body .='<table align="center" style="background-color:back;" width="600">';
	$mail_body .='<tr><td><h1>ASAP Futár</h1></td>
	<td align="right"><p >

<b><span style="color:#b41200;">Expressz csomagküldés</span></b><br>
akár 2 óra alatt<br>
	+36 70 500 2195
</p></td>
	</tr>
	</table>	
	<table align="center" style="background-color:back;" width="600">
	<tr><td><img src="http://www.asapfutar.com/wp-content/uploads/2016/08/asap_futar_big_1200.jpg"  width="600" height="268"></td></tr>
	</table>';
	$mail_body .='<table align="center" style="background-color:white;" width="600">';

	$mail_body .='<tr>
								<td style="width:300px ;vertical-align: top;" >';
	$mail_body .=	'<h3 >Csomag felvétel:</h3>';
	$mail_body .=	"<b><span style='color:#b41200;'>Megrendelő:</span></b>".$csomag_f[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$csomag_f[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattaró:</span></b>".$csomag_f[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$csomag_f[3]."<br>
								</td>";	

	$mail_body .=	'<td width="300"><h3>Csomag címzett:</h3>';
	$mail_body .=	"<b><span style='color:#b41200;'>Címzett:</span></b>".$csomag_c[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$csomag_c[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattartó:</span></b>".$csomag_c[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$csomag_c[3]."<br>";	
	$mail_body .="</td></tr>";
	$mail_body .=	"<tr><td style='vertical-align: top;'><h3>Megrendelő Adatai:</h3>";
	$mail_body .=	"<b><span style='color:#b41200;'>Megrendelő:</span></b>".$szam_c[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$szam_c[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattaró:</span></b>".$szam_c[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$szam_c[3]."<br></td>";
	
	$mail_body .=	"<td style='vertical-align: top;'><h3>Csomag adatai:</h3>";
	$mail_body .=	"<b><span style='color:#b41200;'>Csomag megnevezés:</span></b>".$csomag_a[1]."<br>";	
	$mail_body .=	"<b><span style='color:#b41200;'>Szállitási díj:*</span></b>".$csomag_a[0]." Ft. <br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Csomag:</span></b>".$csomag_a[2]." db. <br>";
	if($csomag_a[3] ==""){
	$var_cs = "-";	
	}else{
	$var_cs = $csomag_a[3];
	}
	$mail_body .=	"<b><span style='color:#b41200;'>Utánvét:</span></b>".$var_cs." Ft <br>";
	$mail_body .= "<b><span style='color:#b41200;'>Küldemény azonosító:<b></span></b>".$munkaszam."</b><br>";
	$mail_body .= "<b><span style='color:#b41200;'>Fizetes modja:</span></b>".$fizetes_var."<br>";
	$mail_body .= "<b><span style='color:#b41200;'>Kiszállitás dátuma:</span></b>".$start_date;
	$mail_body .="</td></tr>";
	$mail_body .="<tr><td><b><span style='color:#b41200;'>Megjegyzés:</span></b>".$comment."</td></tr>";
	
	$mail_body .="</table>";
	$mail_body .="<table width='600' align='center' style='background-color:white;color:black;'>";
	$mail_body .="<tr><td ><p align='left'><b><span style='color:black'>* A szállitási díj eltérhet a az értesítésben megadatottól!</span></b></p> </td></tr>";
	$mail_body .="</table>";

	$mail_body .="</body>";
$mail = $mail_body;
echo $mail;
?>