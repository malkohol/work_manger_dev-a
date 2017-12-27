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

if(isset($_POST['s_date'])){
$_SESSION['s_date']  = 	$_POST['s_date'];
}
if(isset($_POST['e_date'])){
$_SESSION['e_date'] = $_POST['e_date'];
}
$s_date = $_SESSION['s_date'];
$e_date = $_SESSION['e_date'];

if(isset($_POST['futar'])){
$futar_id =  $_POST['futar'];
}else{
$futar_id = 0;	
	}
if(isset($_POST['ugyfel'])){
$ugyfel_id =  $_POST['ugyfel'];
}else{
$ugyfel_id = 0;	
	}	
if($futar_id !=0){
$sql_pot = "and futar = ".$futar_id;	
}else{
$sql_pot = "";	
	}

if($ugyfel_id !=0){
$sql_pot1 = "and megrendelo_id = ".$ugyfel_id;	
}else{
$sql_pot1 = "";	
	}	
	
$over_utanvet = 0;
$over_futar_dij =0;
$over_utanvet_f = 0;
$over_futar_dij_f =0;
$over_futar_dij_penz =0;
$over_futar_dij_utalas =0;
$table = "";
$table .='
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
	$table .='<table cellpadding="1" style="text-align:left"><thead><tr>';
	$table .='<th style="text-align:center" class="border" width="110"><b>Csomag felvétel:</b></th>';
	$table .='<th style="text-align:center" class="border" width="110"><b>Kiszállítási cím:</b></th>';
	$table .='<th style="text-align:center" class="border"><b>Megrendelő:</b></th>';
	$table .='<th style="text-align:center" class="border" width="60" ><b>Dátum:</b></th>';
	$table .='<th style="text-align:center" class="border" width="60"><b>Utánvét:</b></th>';				
	$table .='<th style="text-align:center" class="border" width="60"><b>Fuvar. díj:</b></th>';
	$table .='<th style="text-align:center" class="border" width="60"><b>Fizetés modja:</b></th>';						
	$table .='<th style="text-align:center" class="border" width="60"><b>Státusz</b></th>';	
	$table .='<th style="text-align:center" class="border" width="60"><b>Futár</b></th>';		
	$table .="</tr></thead><tbody>";
	$count_elem = 0;
$sql_products ="SELECT * FROM `kuldemeny` WHERE `start_date` >= '$s_date'  and `start_date` <= '$e_date' $sql_pot $sql_pot1 ORDER BY `pid` DESC";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$pid = $product_list['pid'];
		$csomag_felvetel = $product_list['csomag_felvetel'];
		$csomag_adat = $product_list['csomag_adat']; 
		$csomag_cel = $product_list['csomag_cel'];
		$szam_cim = $product_list['szam_cim'];
		
		$futar = $product_list['futar'];
		$fizetes = $product_list['fizetes'];
		$szallitas = $product_list['szallitas'];
		
		for ($if = 0; $if <= count($_SESSION['futar'])-1; $if++) {			
		if($futar == $_SESSION['futar'][$if]['id'] ){
		$futar_var = 	$_SESSION['futar'][$if]['nev'];
		}

	
		}
		
		

		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date'];
		$created_at = $product_list['created_at'];   
		$user_id = "0";
	
		$csomag_felvetel = explode("&", $csomag_felvetel);
		$csomag_cel = explode("&", $csomag_cel);
		
		$csomag_adat = explode("&", $csomag_adat);
		
		$szam_cima = explode("&", $szam_cim);
		
		$description = $szam_cima[0]."<br>".$szam_cima[1];
		
		$csomag_cel_var = $csomag_cel[0]."<br>".$csomag_cel[1];
		$csomag_adat_var = 	"Fuvar. díj:".$csomag_adat[0]."<br>Utánvét:".$csomag_adat[3]." Ft.";
	 	$csomag_felvetel_var 	= $csomag_felvetel[0]."<br>".$csomag_felvetel[1];
		$over_statusz = $product_list['over_statusz'];
	
		if($over_statusz ==0){
	$over_statusz_var ="Nincs fizetve";
	}
	
	if($over_statusz == 1 || $fizetes == 0){
	$over_statusz_var = "fizetve";	
	}


	if($szallitas ==1){
	$szal_var = "background-color:#cbfbcd;";	
	}else{
		
		}

	
	$table .="<tr>";
	$table .='<td width="110" class="border_b">'.$csomag_felvetel_var.'</td>';
	$table .='<td width="110" class="border_b">'.$csomag_cel_var.'</td>';
	$table .='<td class="border_b">'.$description.'</td>';
	$table .='<td width="60" class="border_b">'.$start_date.'</td>';
	if($over_statusz ==1 || $fizetes == 0){
		$over_utanvet_f = $over_utanvet_f+$csomag_adat[3];
		$over_futar_dij_f =	 $over_futar_dij_f+$csomag_adat[0];
	}
	if($fizetes == 0){
	$over_futar_dij_penz =$over_futar_dij_penz+$csomag_adat[0];
	}
	if($fizetes == 1){
	$over_futar_dij_utalas =  $over_futar_dij_utalas+$csomag_adat[0];
	}
		$over_utanvet =$over_utanvet+$csomag_adat[3];
		$over_futar_dij = $over_futar_dij+$csomag_adat[0];
		$table .='<td width="60" class="border_b">'.$csomag_adat[3].'</td>';				
		$table .='<td width="60" class="border_b">'.$csomag_adat[0].'</td>';
		$table .='<td width="60" class="border_b">'.$_SESSION['fizetes'][$fizetes].'</td>';						
		$table .='<td width="60" class="border_b">'.$over_statusz_var.'</td>';		
		$table .='<td width="60" class="border_b">'.$futar_var.'</td>';				
	
	
	$table .="</tr>";
	

	
	$count_elem++;
	}
	$table .='<tr>';
	$table .='<td style="text-align:left" class="border" width="110"><b>Összesen:</b></td>';
	$table .='<td style="text-align:center" class="border" width="110"></td>';
	$table .='<td style="text-align:center" class="border"></td>';
	$table .='<td style="text-align:center" class="border" width="60" ></td>';
	$table .='<td style="text-align:left" class="border" width="60"><b>'.$over_utanvet.' </b></td>';				
	$table .='<td style="text-align:left" class="border" width="60"><b>'.$over_futar_dij.'</b></td>';						
	$table .='<td style="text-align:left" class="border" width="60"><b>Készpénz:'.$over_futar_dij_penz.'<br>Utalás:'.$over_futar_dij_utalas.'</b></td>';
		$table .='<td style="text-align:right" class="border" width="60"></td>';
	$table .='<td style="text-align:center" class="border" width="60"><b></b></td>';			
	$table .="</tr>	";
		
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
$pdf->SetFont('arial', 'N', 6);

// add a page
$pdf->AddPage();
$save_var = "";
$html = '<div align="center"><h2>Kimutatás<h2></div>';
$html .= '<div align="center"><h2>Időszak: '.$s_date.' - '.$e_date.' <h2></div>';
$save_var .= $s_date."_".$e_date;
if($_POST['futar'] !=0){
$html .= '<div align="center"><h2>Futár: '.$futar_var.' <h2></div>';
$save_var .= $s_date."_".$e_date."_".$futar_var; 
}
$ugyfel_var ="";
if($_POST['ugyfel'] !=0){
	for($elbe = 0; $elbe <= count($_SESSION['ugyfel'])-1; $elbe++) {
if($_SESSION['ugyfel'][$elbe]['id']	== $_POST['ugyfel']){
	$ugyfel_var = $_SESSION['ugyfel'][$elbe]['nev']	;
	}
$save_var .= $s_date."_".$e_date."_".$ugyfel_var; 
}
$html .= '<div align="center"><h2>Megrendelő: '.$ugyfel_var.' <h2></div>';
}
$pdf->writeHTML($html, true, false, true, false, '');

$html = $table.'
</tbody></table>';
$pdf->writeHTML($html, true, false, true, false, '');





//Close and output PDF document
$pdf->Output($save_var.".pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+

?>