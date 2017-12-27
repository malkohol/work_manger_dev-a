	<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 
	
		include ($root.'script/conn.php');
	
if(isset($_GET['ceg_adatok'])){
	
$edit_id =$_GET['ceg_adatok'];
				$sql_products ="SELECT * FROM `ugyfel` where ugyfel_id =  $edit_id";
				$result_products = mysql_query($sql_products);
				while($product_list = mysql_fetch_array($result_products)){ 
				$id = $product_list['id'];
 				$email = $product_list['email'];
 				$nev = $product_list['nev'];
 				$cim = $product_list['cim'];
 				$kapcsolat = $product_list['kapcsolat'];
 	 			$tel = $product_list['telefonszam'];
 	 			$email = $product_list['email'];
 	 			$adoszam = $product_list['adoszam'];
 	 			$bank = $product_list['bank'];
 	 			$banszamla = $product_list['banszamla'];
 	 			$megrendelo_id = $product_list['ugyfel_id'];
 	 	
		

		
		
		}
		
$_SESSION['megrendelo'] = 1;
			echo "<script>
	 $('#megrend_id').val('".$megrendelo_id."');	
	 $('#szam_nev').val('".$nev."');
	 $('#szam_nev').val('".$nev."');
	 $('#szam_cim').val('".$cim."');
	 $('#szam_kap').val('".$kapcsolat."');
	 $('#szam_tel').val('".$tel."');
	 $('#szam_email').val('".$email."');
	 $('#szam_ado').val('".$adoszam."');
	 $('#bank').val('".$bank."');
	 $('#szam_bank').val('".$banszamla."');

	 $('#ugyfel_id').val('".$edit_id."');


	 	 	 	 
	</script>";
	}

if(isset($_GET['add_cim'])){
	
$add_cim =$_GET['add_cim'];
				$sql_cim_l ="SELECT * FROM `cim_lista` where id =  $add_cim";
				$result_cim_l = mysql_query($sql_cim_l);
				while($cim_l = mysql_fetch_array($result_cim_l)){ 
				$id = $cim_l['id'];
 				$nev = $cim_l['nev'];
 				$cim = $cim_l['cim'];
 				$kapcsolat = $cim_l['kapcsolat'];
 				$kapcsolat_tel = $cim_l['kapcsolat_tel'];
 				$cim_var = $cim_l['cim_var'];
 		 		$pieces_f = explode("&", $cim_var);
		

		
		
		}
		
$_SESSION['felvetel'] = 1;
			echo "<script>
	 $('#f_cim').val('".$cim."');
	 $('#f_kap_nev').val('".$kapcsolat."');
	 $('#f_tel').val('".$kapcsolat_tel."');
	$('#f_varos').val('".$pieces_f[0]."');
	$('#f_iranyio').val('".$pieces_f[1]."');
	$('#f_utca').val('".$pieces_f[2]."');
	$('#f_emelt').val('".$pieces_f[3]."');
	
	get_coord_f(); 	 	 
	</script>";
	}	
	
	if(isset($_GET['add_cel'])){
	
$add_cel =$_GET['add_cel'];
				$sql_cim_l ="SELECT * FROM `cim_lista` where id =  $add_cel";
				$result_cim_l = mysql_query($sql_cim_l);
				while($cim_l = mysql_fetch_array($result_cim_l)){ 
				$id = $cim_l['id'];
 				$nev = $cim_l['nev'];
 				$cim = $cim_l['cim'];
 				$kapcsolat = $cim_l['kapcsolat'];
 				$kapcsolat_tel = $cim_l['kapcsolat_tel'];
			 	$cim_var = $cim_l['cim_var'];
 	 	
				$pieces_c = explode("&", $cim_var);

		
		
		}
		
$_SESSION['cel'] = 1;
			echo "<script>
	 $('#cim_cim').val('".$cim."');
	 $('#cim_kap').val('".$kapcsolat."');
	 $('#cim_tel').val('".$kapcsolat_tel."');
	$('#c_varos').val('".$pieces_c[0]."');
	$('#c_iranyio').val('".$pieces_c[1]."');
	$('#c_utca').val('".$pieces_c[2]."');
	$('#c_emelt').val('".$pieces_c[3]."');
	
	get_coord_c(); 	 	 
	</script>";
	}	
	
	?>
	


