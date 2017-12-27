<?
if(empty($_SESSION['local'])) {
session_start();
		$_SESSION['id'] = session_id();
		$root = $_SESSION['root'];
$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];

	}
		include ($root.'/script/conn.php');

if(isset($_GET['munkaszam'])){
$munkaszam = 	$_GET['munkaszam'];
}

  			$sql_kuldemeny="SELECT * FROM `kuldemeny` WHERE `munkaszam` =$munkaszam ";
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
  			$comment  = $kuldemeny_list['description'];
  			$fizetes_var = "készpénz";
  			}
  			
	 $csomag_f = explode("&", $csomag_felvetel);
	$csomag_c = explode("&", $csomag_cel);
	$csomag_a = explode("&", $csomag_adat);
		$szam_c = explode("&", $szam_cim);



$mail_body = "";
$mail_body .='
<style>
.border{
border-top: 1px solid black;
border-bottom: 1px solid black;
border-left: 1px solid black;
border-right: 1px solid black;
}
.border_b{

border-top: 1px solid black;

}
</style>';
$mail_body .='<table align="left" class="" style="background-color:white;" width="720">';
$mail_body .=	"<tr><td width='360' style='vertical-align: top;' align='center'><h3 >Megrendelő Adatai:</h3>";
	$mail_body .=	"<b><span style='color:#b41200;'>Megrendelő:</span></b>".$szam_c[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$szam_c[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattaró:</span></b>".$szam_c[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$szam_c[3]."<br></td>";
	
	$mail_body .=	"<td width='360' style='vertical-align: top;' align='center'><h3 >Csomag adatai:</h3>";
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
	$mail_body .="<br></td></tr>";
	$mail_body .='<tr>
								<td style="width:360px ;vertical-align: top;" >';
	$mail_body .=	'<h3 align="center">Csomag felvétel:</h3>';
	$mail_body .=	"<b><span style='color:#b41200;'>Megrendelő:</span></b>".$csomag_f[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$csomag_f[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattaró:</span></b>".$csomag_f[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$csomag_f[3]."<br>
								</td>";	

	$mail_body .=	'<td width="360"><h3 align="center">Csomag címzett:</h3>';
	$mail_body .=	"<b><span style='color:#b41200;'>Címzett:</span></b>".$csomag_c[0]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Cím:</span></b>".$csomag_c[1]."<br>";
	$mail_body .=	"<b><span style='color:#b41200;'>Kapcsolattartó:</span></b>".$csomag_c[2]."<br>";		
	$mail_body .=	"<b><span style='color:#b41200;'>Telefon:</span></b>".$csomag_c[3]."<br>";	
	$mail_body .="</td></tr>";

$img_1 = $root."pic/".$munkaszam."_felvet.png";

if (file_exists($img_1))
{
      
}
else
{
 	$img_1 = $local."pic/clear.png";   
}
$img_2 = $root."pic/".$munkaszam."_kezb.png";
if (file_exists($img_2))
{
      
}
else
{
 	$img_2 = $local."pic/clear.png";   
}
	
	$mail_body .=	'<tr><td>Aláírás<br>
	<img src="'.$img_1.'" style="width:100px;height:60px;">
	</td><td>Aláírás<br>
	<img src="'.$img_2.'" style="width:100px;height:60px;"></td></tr>';
	
	
	
	$mail_body .="<tr><td><b><span style='color:#b41200;'>Megjegyzés:</span></b>".$comment."</td></tr>";
	
	$mail_body .="</table>";
	

	
	


	
	 require($_SESSION['root'].'/script/tcpdf/tcpdf.php');
 

 

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $txt = "ASAP Sofőr és Futárszolgálat
1095 Budapest József körút 36. Fsz. 5.
+36 70 500 2195
info@asapfutar.com
";
      
      
         // Logo
        $image_file = $_SESSION['local']."img/"."cmh_logo.png";
        $this->Image($image_file, 10, 2, 30, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
      
        // Set font
        $this->SetFont('arial', 'B', 9);
        // Title
        $this->MultiCell(55, 10, 	'', 0, 'L', 0, 0, '', '', true);
				$this->MultiCell(110, 10, $txt, 0, 'R', 0, 1, '', '', true);
        
    		$this->SetTopMargin($this->GetY()+5);
     
    
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Oldal '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/lang.php')) {
    require_once(dirname(__FILE__).'/lang/lang.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('arial', 'N', 10);

// add a page
$pdf->AddPage();
$save_var = "";
$html = '<div align="center"><h2>Munkalap<h2></div>';


$ugyfel_var ="";

$save_var=$munkaszam;



$pdf->writeHTML($html, true, false, true, false, '');

$html = $mail_body;
$pdf->writeHTML($html, true, false, true, false, '');





//Close and output PDF document
$pdf->Output($save_var.".pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+

?>