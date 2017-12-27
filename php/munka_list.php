	
	<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 
	
		include ($root.'script/conn.php');
if(empty($_SESSION['s_date'])){
$_SESSION['s_date'] = date("Y-m-d");
$_SESSION['e_date'] =date('Y-m-d');
}else{
$today = $_SESSION['s_date'];
$end_date = $_SESSION['e_date'];
}	
		?>
<script>
	function order_list() { 
	   $.ajax( {
        type: 'POST',
        url: "<? echo $local; ?>/php/munka_list_proc.php?action=szures",
        data: $("#dateRangeForm").serialize(),
        success: function(html) {
            $("#munka_list").empty().append(html);
        }
    } );
    return false;


}		

$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
           
        })
        
});
$(document).ready(function() {
    $('#dateRangePicker2')
        .datepicker({
            format: 'yyyy-mm-dd'
           
        })
        
});

</script>
			<div class="col-md-12">
					<div class="row">
					<form id="dateRangeForm">
								<div class="col-lg-9">
					<label>Kezdő dátum:</label><input class="" class="form-control" id="dateRangePicker" name="s_date" value="<? echo $today ?>" type="text">
					<label>Utolsó dátum:</label><input class="" class="form-control" id="dateRangePicker2" name="e_date" value="<? echo $end_date ?>" type="text">
					<label>megrendelő:</label>
								<select name="ugyfel">
									<option value="0">nincs</option>
			<?					for ($fu = 0; $fu <= count($_SESSION['ugyfel'])-1; $fu++) {
  							  if($_SESSION['ugyfel'][$fu]['nev'] !=""){
  							  echo "<option value='".$_SESSION['ugyfel'][$fu]['id']."'>".$_SESSION['ugyfel'][$fu]['nev']."</option>";
							}
						} ?>
								
							</select>
				
					</div>
								<div class="col-lg-3">
					<div class="btn btn-primary" onclick="order_list();">szürés</div>
									
					 <div type="button" class="myBtn btn btn-danger" onclick="add_new_work();"  id="">Új megrendelés</div>
</div>
						
				
					</form>
					</div>
						<p></p>
					<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Aktuális munkák</div>
					<div class="panel-body">
						<ul class="todo-list">
		<?
		
		
		 	 if(isset($_GET['delet'])){
 		$id =	$_GET['delet'];
 	 	$sql ="DELETE FROM `kuldemeny` WHERE `pid` = $id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	echo  "<script>$('#myModal').modal('hide');alert('munka törölve')</script>";
 	}
		
		
			 	 if(isset($_GET['szallitva'])){
 		$id =	$_GET['szallitva'];
 	 	$sql ="UPDATE `kuldemeny` SET `szallitas` = '1' WHERE `pid` =$id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	}
		
		if(isset($_GET['add_munka'])){
		$cim_cim =	$_POST['cim_cim'];
		$cim_kap =	$_POST['cim_kap'];
		$cim_nev =	$_POST['cim_nev'];
		$cim_tel =	$_POST['cim_tel'];
		$c_coord =	$_POST['c_coord'];
		
		$c_cim_var =	$_POST['c_iranyio']."#".$_POST['c_varos']."#".$_POST['c_utca']."#".$_POST['c_emelt'];
		
		$suly =	$_POST['suly'];
		$cimzett = $cim_nev."&".$cim_cim."&".$cim_kap."&".$cim_tel."&".$c_coord."&".$c_cim_var;
		
		$f_nev =	$_POST['f_nev'];
		$f_kap_nev =	$_POST['f_kap_nev'];
		$f_tel =	$_POST['f_tel'];
		$f_cim =	$_POST['f_cim'];
		$f_coord =	$_POST['f_coord'];

		$f_cim_var =	$_POST['f_iranyio']."#".$_POST['f_varos']."#".$_POST['f_utca']."#".$_POST['f_emelt'];	
		
		$felado = $f_nev."&".$f_cim."&".$f_kap_nev."&".$f_tel."&".$f_coord."&".$f_cim_var;
		
	
		
		$kuld_db	= $_POST['kuld_db'];
		$kuld_dij	= $_POST['kuld_dij'];
		$kuld_nev	= $_POST['kuld_nev'];
		$kuld_ossz	 = $_POST['kuld_ossz'];
	
		$kuldemeny = $kuld_dij."&".$kuld_nev."&".$kuld_db."&".$kuld_ossz;			
		
		$szam_ado	= $_POST['szam_ado'];
		$szam_bank_sz	= $_POST['szam_bank'];
		$szam_cim	= $_POST['szam_cim'];
		$szam_kap	= $_POST['szam_kap'];
		$szam_nev	= $_POST['szam_nev'];
		$szam_tel= $_POST['szam_tel'];
		$szam_bank = $_POST['bank'];
		$szam_email = $_POST['szam_email'];
		$start_date = $_POST['start_date'];
		$fizetes = $_POST['fizetes'];		
if($_SESSION['megrendelo'] == 0){
$ugyfelszam =  rand(100, 999).date("mdHis");			
$sql_m="INSERT INTO `ugyfel` (
`ugyfel_id` ,
`nev` ,
`cim` ,
`kapcsolat` ,
`telefonszam` ,
`email` ,
`adoszam` ,
`banszamla` ,
`bank` 
)
VALUES (
'$ugyfelszam', '$szam_nev', '$szam_cim', '$szam_kap', '$szam_tel', '$szam_email', '$szam_ado', '$szam_bank_sz', '$szam_bank'
);";

		if (!mysql_query($sql_m,$con))
	  {
 			 die('Error:  ' . mysql_error());
}


		
		
		}
		
		

		if($_POST['megrend_id'] != ""){
		$megrend_id = $_POST['megrend_id'];
	}else{
		$megrend_id = $ugyfelszam; 
		
		}
		
		
		
		if($_POST['optradio'] == '1'){
			$megrend_id  = 1;
		}
		
		$szamlazas = $szam_nev."&".$szam_cim."&".$szam_kap."&".$szam_tel."&".$szam_email."&".$szam_ado."&".$szam_bank."&".$szam_bank_sz;
		
		
		
		$futar= $_POST['futar'];
		$munkaszam =  date("Ymdhisa");
		$comment = $_POST['comment']; 
		$sql = "INSERT INTO `kuldemeny` (
		`pid`,
		`csomag_felvetel`,
		`csomag_cel`,
		`csomag_adat`,
		`szam_cim`,
		`munkaszam`, 
		`futar`, 
		`description`, 
		`start_date`, 
		`end_date`, 
		`created_at`,
		`fizetes`,
		`megrendelo_id`,
		`suly`,
		`updated_at`) 
		VALUES (
		 NULL, 
		'$felado', 
		'$cimzett', 
		'$kuldemeny',
		'$szamlazas', 
		'$munkaszam', 
		'$futar', 
		'$comment', 
		'$start_date', 
		'', 
		CURRENT_TIMESTAMP,
		'$fizetes',	
		'$megrend_id',
		'$suly',    
		'');";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}

		
		if($_SESSION['felvetel'] ==0){
			
			
$sql_g="INSERT INTO `cim_lista` (`id`, `nev`, `cim`, `kapcsolat`, `kapcsolat_tel`)
			 VALUES (NULL, '$f_nev', '$f_cim', '$f_kap_nev', '$f_tel');";
					if (!mysql_query($sql_g,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
			}
	
			if($_SESSION['cel'] ==0){
$sql_g="INSERT INTO `cim_lista` (`id`, `nev`, `cim`, `kapcsolat`, `kapcsolat_tel`)
			 VALUES (NULL, '$cim_nev', '$cim_cim', '$cim_kap', '$cim_tel');";
					if (!mysql_query($sql_g,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
			}
		echo  "<script>$('#myModal').modal('hide');alert('munka hozzáadva')</script>";
	}
		
		
if(isset($_GET['edit_munka'])){
		$edit_munka =	$_GET['edit_munka'];
		$cim_cim =	$_POST['cim_cim'];
		$cim_kap =	$_POST['cim_kap'];
		$cim_nev =	$_POST['cim_nev'];
		$cim_tel =	$_POST['cim_tel'];
		$c_coord =	$_POST['c_coord'];
			$c_cim_var =	$_POST['c_iranyio']."#".$_POST['c_varos']."#".$_POST['c_utca']."#".$_POST['c_emelt'];
		$cimzett = $cim_nev."&".$cim_cim."&".$cim_kap."&".$cim_tel."&".$c_coord."&".$c_cim_var;;
		
		$f_nev =	$_POST['f_nev'];
		$f_kap_nev =	$_POST['f_kap_nev'];
		$f_tel =	$_POST['f_tel'];
		$f_cim =	$_POST['f_cim'];
		$f_coord =	$_POST['f_coord'];
		
	
		$f_cim_var =	$_POST['f_iranyio']."#".$_POST['f_varos']."#".$_POST['f_utca']."#".$_POST['f_emelt'];	
		
		$felado = $f_nev."&".$f_cim."&".$f_kap_nev."&".$f_tel."&".$f_coord."&".$f_cim_var;
	
		$kuld_db	= $_POST['kuld_db'];
		$kuld_dij	= $_POST['kuld_dij'];
		$kuld_nev	= $_POST['kuld_nev'];
		$kuld_ossz	 = $_POST['kuld_ossz'];
		$suly	 = $_POST['suly'];
		$kuldemeny = $kuld_dij."&".$kuld_nev."&".$kuld_db."&".$kuld_ossz;					
		
		$szam_ado	= $_POST['szam_ado'];
		$szam_bank_sz	= $_POST['szam_bank'];
		$szam_cim	= $_POST['szam_cim'];
		$szam_kap	= $_POST['szam_kap'];
		$szam_nev	= $_POST['szam_nev'];
		$szam_email	= $_POST['szam_email'];
		$szam_tel= $_POST['szam_tel'];
		$szam_bank = $_POST['bank'];
		$start_date = $_POST['start_date'];
		$fizetes = $_POST['fizetes'];
		$szamlazas = $szam_nev."&".$szam_cim."&".$szam_kap."&".$szam_tel."&".$szam_email."&".$szam_ado."&".$szam_bank."&".$szam_bank_sz;
		$megrend_id = $_POST['megrend_id'];
		
		if($_POST['optradio'] == '1'){
			$megrend_id  = 1;
		}
		$futar= $_POST['futar'];
		$munkaszam =  date("Ymdhisa");
		$comment = $_POST['comment'];
		
	$sql=	"UPDATE `kuldemeny` SET 
	`csomag_felvetel` = '$felado', 
	`csomag_cel` = '$cimzett',
	`csomag_adat` = '$kuldemeny', 
	`szam_cim` = '$szamlazas',
	`futar` = '$futar',
	`megrendelo_id` = '$megrend_id',
	`description` = '$comment',
	`fizetes` = '$fizetes',
	`suly` = '$suly',
	`start_date` = '$start_date'	 
 		WHERE `pid` = $edit_munka ";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
echo  "<script>$('#myModal').modal('hide');alert('munka szerkesztve')</script>";
	}

		
						

		
		?><div id="munka_list">
		<?	include('munka_list_proc.php'); ?>
				</div>
						</ul>
							</div>
			
							<div class="panel-footer">
						<div class="input-group">
							</div>
							
							<span class="input-group-btn">
						
							  <button type="button" class="myBtn btn-info btn-lg" onclick="add_new_work();"  id="">Új megrendelés</button>

							</span>
						</div>
						
							</div>
								</div>
			
	  <script>
$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>