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
if(isset($_POST['ugyfel'])){
$ugyfel = $_POST['ugyfel'];
if($ugyfel != 0){
$sql_pot = "and megrendelo_id ='$ugyfel'";	
}else{
$sql_pot ="";	
	}
}else{
$sql_pot ="";		
	}

$s_date = $_SESSION['s_date'];
$e_date = $_SESSION['e_date'];
$sql_products ="SELECT * FROM `kuldemeny` WHERE `start_date` >= '$s_date'  and `start_date` <= '$e_date' $sql_pot ORDER BY `pid` DESC";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$pid = $product_list['pid'];
		$csomag_felvetel = $product_list['csomag_felvetel'];
		$csomag_adat = $product_list['csomag_adat']; 
		$csomag_cel = $product_list['csomag_cel'];
		$szam_cim = $product_list['szam_cim'];
		$munkaszam = $product_list['munkaszam'];
		
		$futar = $product_list['futar'];
		$fizetes = $product_list['fizetes'];
		$szallitas = $product_list['szallitas'];
		$futar_var = "<span style='color:red'>nincs megadva</span>";
		for ($if = 0; $if <= count($_SESSION['futar'])-1; $if++) {			
		if($futar == $_SESSION['futar'][$if]['id'] ){
		$futar_var = 	$_SESSION['futar'][$if]['nev'];
		}

	
		}
		
		$description = $product_list['description'];

		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date'];
		$created_at = $product_list['created_at'];   
		$suly = $product_list['suly'];
		$user_id = "0";
	
		$csomag_felvetel = explode("&", $csomag_felvetel);
		$csomag_cel = explode("&", $csomag_cel);
		$szam_cim = explode("&", $szam_cim);
		$csomag_adat = explode("&", $csomag_adat);
		
		$csomag_cel_var = $csomag_cel[0]."<br>".$csomag_cel[1]."<br>".$csomag_cel[2]."<br>".$csomag_cel[3];
		$csomag_adat_var = 	"szolg. díj:".$csomag_adat[0]."<br>".$csomag_adat[1]."<br>".$csomag_adat[2]." db.<br>Utánvét:".$csomag_adat[3]." Ft.";
	 	$csomag_felvetel_var 	= $csomag_felvetel[0]."<br>".$csomag_felvetel[1]."<br>".$csomag_felvetel[2]."<br>".$csomag_felvetel[3];
		$szam_cim_var = $szam_cim[0]."<br>".$szam_cim[1]."<br>".$szam_cim[2]."<br>".$szam_cim[3];
	
	if($szallitas ==1){
	$szal_var = "background-color:#cbfbcd;";	
	}else{
	$szal_var ="";	
		}
		
	
	?>
	

	
	<li class="todo-list-item">
							
								<div class="row" style="<? echo $szal_var ?>">	
									<p></p>
									<div class="col-lg-2 col-sm-12"><b>Csomag felvétel:</b><br><? echo $csomag_felvetel_var ?><p></p></div>
									<div class="col-lg-2 col-sm-12"><b>Kiszállítási cím:</b><br><? echo $csomag_cel_var ?><p></p></div>
									<div class="col-lg-2 col-sm-12"><b>Számlázási cím:</b><br><? echo $szam_cim_var ?><p></p></div>
									<div class="col-lg-2 col-sm-12"><b>Csomag adatok:</b><br><? echo $csomag_adat_var."<br>".$_SESSION['fizetes'][$fizetes],"<br>Súly: ".$suly; ?> kg<p></p></div>
									<div class="col-lg-1 col-sm-12"><b>Futár:</b><br><? echo $futar_var ?><p></p></div>
									<div class="col-lg-1 col-sm-12"><b>Megjegyzés:</b><br><? echo $description ?><p></p></div>
				
								
									<div class="col-lg-2" ><b>Munka rögzítése:</b><br><? echo $created_at ?><br>
									Munka elkezdése:<br><? echo "".$start_date ?><br>
									Munka vége:<br><? echo $end_date ?></div>
									<p></p>
									
								<div class="col-lg-12">
									<div class="row">
									<div id="<? echo $pid ?>" class="col-lg-2 col-sm-4 myBtn"  onclick="edit_work(this.id);" ><button class=" btn btn-success">Szerkesztés</button></div>
									<div class="col-lg-2 col-sm-4"><button id="<? echo $pid ?>" onclick="send_work(this.id);" class=" btn btn-danger">Futár értesítés</button></div>
									<div class="col-lg-2 col-sm-4"><button id="<? echo $pid ?>" onclick="set_szallitva(this.id);" class="btn btn-warning ">Kiszállítva</button></div>
									<div class="col-lg-2 col-sm-4"><a href="<? echo $local ?>php/megrend_pdf.php?munkaszam=<? echo $munkaszam ?>"> <button id="<? echo $pid ?>" class="btn btn-warning ">Munklap nyomtatás</button></a></div>
								</div>
								</div>
								</div>
		</li>
							
						<?}?>
	<script>					
						$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>