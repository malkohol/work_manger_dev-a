<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	}

	
	
			include ($root.'script/conn.php');
if(isset($_GET['open_partner'])){
	$edit = 1;
		$edit_id = $_GET['open_partner'];
		$sql_products ="SELECT * FROM `ugyfel` where id =  $edit_id";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$id = $product_list['id'];
		$name = $product_list['nev'];
		$cim = $product_list['cim']; 
		$kapcsolat = $product_list['kapcsolat'];
		$telefonszam = $product_list['telefonszam'];
		$email = $product_list['email'];
		$adoszam = $product_list['adoszam'];
		$banszamla = $product_list['banszamla'];
		$bank = $product_list['bank'];
$button_var ="edit_parter(this.id);";	
$button_text ="Szerkeszt";
}
}else{
		$edit = 0;
		$id = "";
		$name = "";
		$cim = ""; 
		$kapcsolat = "";
		$telefonszam = "";
		$email = "";
		$adoszam ="";
		$banszamla = "";
		$bank = ""; 
$munkaszam = date("mdHis");
$button_var ="add_parter();";
$m_id = "";
$button_text ="Ment";
}



?>
				

		<div class="row">
		
			<div class="col-lg-12">



						<div class="col-md-12">
							<form id="partner_form" >
							<h4 align="center"> Céges adatok: </h4>
								<div class="form-group">
									<label>Parnter neve:</label>
									<input name="nev" class="form-control" value="<? echo $name ?>" placeholder="Kapcsolattartó neve:">
								</div>
								
									<div class="form-group">
									<label>Parnter cime:</label>
									<input name="cim" class="form-control" value="<? echo $cim ?>" placeholder="Megrendelés cime:">
								</div>
												<div class="form-group">
									<label>Adoszám:</label>
									<input name="adpszam" class="form-control"  value="<? echo $adoszam ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
								<div class="form-group">
									<label>Számlavezető bank:</label>
									<input name="bank" class="form-control"  value="<? echo $bank ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
								<div class="form-group">
									<label>Bankszamla:</label>
									<input name="banszamla" class="form-control"  value="<? echo $banszamla ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
								<h4 align="center"> Kapcsolattaró: </h4>
									<div class="form-group">
									<label>Kapcsolattartó neve:</label>
									<input name="kapcsolat" class="form-control"  value="<? echo $kapcsolat ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
										<div class="form-group">
									<label>Kapcsolattartó telefon:</label>
									<input name="telefon" class="form-control"  value="<? echo $telefonszam ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
									<div class="form-group">
									<label>Kapcsolattartó email:</label>
									<input name="email" class="form-control"  value="<? echo $email ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
						
								
											
								
							</div>
		
								<div class="col-md-12">
								<div  id="<? echo $id; ?>" onclick="<? echo $button_var; ?>" class="btn btn-primary"><? echo $button_text ?></div>
						<? if($edit == 1) {?>
								<div  id="<? echo $id; ?>" onclick="delet_partner(this.id);" class="btn btn-danger">Töröl</div>
							<? } ?>
								</div>
						</form>
				<div class="col-md-12">
				<form id="pass_form" >
					<input name="pass" class="form-control"  value="" placeholder="jelszó">
				<div  id="<? echo $id; ?>" onclick="add_pass(this.id);" class="btn btn-danger">Új jelszó</div>
				</form>
					</div>
			</div><!-- /.col-->
		</div><!-- /.row -->





