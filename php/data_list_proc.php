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
		
		$description = $product_list['description'];

		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date'];
		$created_at = $product_list['created_at'];   
		$user_id = "0";
	
		$csomag_felvetel = explode("&", $csomag_felvetel);
		$csomag_cel = explode("&", $csomag_cel);
		$szam_cim = explode("&", $szam_cim);
		$csomag_adat = explode("&", $csomag_adat);
		
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
	$szal_var ="";	
		}
		
	
	?>
	

	
	<li class="todo-list-item">
							
								<div class="row" style="">	
									<p></p>
									<div class="col-lg-2 col-sm-12"><b>Csomag felvétel:</b><br><? echo $csomag_felvetel_var ?><p></p></div>
									<div class="col-lg-2 col-sm-12"><b>Kiszállítási cím:</b><br><? echo $csomag_cel_var ?><p></p></div>
							
								

									<div class="col-lg-1 col-sm-12"><b>Megjegyzés:</b><br><? echo $description ?><p></p></div>
				
								
									<div class="col-lg-1" >
								<b>Dátum</b><br>
								<? echo "".$start_date; 
								if($over_statusz ==1 || $fizetes == 0){
																$over_utanvet_f = $over_utanvet_f+$csomag_adat[3];
								$over_futar_dij_f =	 $over_futar_dij_f+$csomag_adat[0];
								}
								$over_utanvet =$over_utanvet+$csomag_adat[3];
								$over_futar_dij = $over_futar_dij+$csomag_adat[0];
								
								
									?>
					
								</div>
									<div class="col-lg-1 col-sm-12"><? echo "<b>Utánvét:</b><br>".$csomag_adat[3]; ?><p></p></div>
									<div class="col-lg-1 col-sm-12"><? echo "<b>Fuvar. díj:</b><br>".$csomag_adat[0];?><p></p></div>
									<div class="col-lg-1 col-sm-12"><? echo $_SESSION['fizetes'][$fizetes] ?><p></p></div>
									<div class="col-lg-1 col-sm-12">Státusz<br><? echo $over_statusz_var ?> <p></p></div>
									<div class="col-lg-12 col-sm-12">
									<div id="<? echo $pid ?>" onclick="set_fizetve(this.id);" class="col-lg-3 col-sm-3 col-sx-3"><button class="btn btn-success">fizetve</button></div>
								
									<div id="<? echo $pid ?>" onclick="set_storno(this.id);" class="col-lg-3 col-sm-3 col-sx-3"><button class="btn btn-danger">nincs fizetve</button></div>				
										</div>
			</div>
		</li>
					
						<?}?>
					<li class="todo-list-item">
							
								<div class="row" style="">	
									<p></p>
									<div class="col-lg-2 col-sm-12"><b>Összesen</b><p></p></div>
									<div class="col-lg-2 col-sm-12"><p></p></div>
							
								

									<div class="col-lg-1 col-sm-12"><p></p></div>
				
								
									<div class="col-lg-1" >
								<br>
														
								
									
					
								</div>
							
									<div class="col-lg-2 col-sm-12"><? echo "<b>Utánvét:</b>".$over_utanvet; ?> Ft.<p></p></div>
									<div class="col-lg-2 col-sm-12"><? echo "<b>Fuvar. díj:</b>".$over_futar_dij ;?> Ft.<p></p></div>
								
			</div>
		</li>		
							<li class="todo-list-item">
							
								<div class="row" style="">	
								
									<div class="col-lg-2 col-sm-12"><b>Kifizetve</b><p></p></div>
									<div class="col-lg-2 col-sm-12"><p></p></div>
									<div class="col-lg-1 col-sm-12"><p></p></div>						
									<div class="col-lg-1" ><p></p></div>
									<div class="col-lg-2 col-sm-12"><? echo "<b></b>".$over_utanvet_f; ?> Ft.<p></p></div>
									<div class="col-lg-2 col-sm-12"><? echo "<b></b>".$over_futar_dij_f ;?> Ft.<p></p></div>
								
			</div>
		</li>		
	<script>					
						$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>