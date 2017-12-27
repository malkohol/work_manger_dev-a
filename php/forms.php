<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	}
			include ($root.'script/conn.php');
if(isset($_GET['edit'])){
		$edit_id = $_GET['edit'];
		$sql_products ="SELECT * FROM `products` where pid =  $edit_id";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$pid = $product_list['pid'];
		$product_nev = $product_list['name'];
		$product_cim = $product_list['cim']; 
		$munkaszam = $product_list['munkaszam'];
		$price = $product_list['price'];
		$tel = $product_list['tel'];
		$coord = $product_list['coord'];
		$description = $product_list['description'];
		$created_at = $product_list['created_at'];
		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date'];
		$button_var = "edit_munka(this.id);";
		$m_id = $product_list['user_id'];
}
}else{
	$pid ="";
		$product_nev = "";
		$product_cim = ""; 

		$price = "";
		$tel = "";
		$coord = "";
		$description = "";
		$created_at = "";
		$start_date = "";
		$end_date ="";
$munkaszam = date("YmdHis");
$button_var ="add_munka();";
$m_id = "";
}
?>
				

		<div class="row">
		
			<div class="col-lg-12">



						<div class="col-md-12">
							<form id="munka_form" >
							
								<div class="form-group">
									<label>Kapcsolattartó neve:</label>
									<input name="nev" class="form-control" value="<? echo $product_nev ?>" placeholder="Kapcsolattartó neve:">
								</div>
								
									<div class="form-group">
									<label>Megrendelés cime:</label>
									<input name="cim" class="form-control" value="<? echo $product_cim ?>" placeholder="Megrendelés cime:">
								</div>
									<div class="form-group">
									<label>Kapcsolattartó Telefonszáma:</label>
									<input name="tel" class="form-control"  value="<? echo $tel ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
									<div class="form-group">
									<label>Munkaszám</label>
									<input name="munkaszam" class="form-control" value="<? echo $munkaszam ?>" placeholder="Munkaszám">
								</div>								
								
								
						
								
								<div class="form-group">
									<label>Megjegyzés</label>
									<textarea  name="comment" class="form-control" placeholder="comment" rows="3"><? echo $description ?></textarea>
								</div>
														<div class="form-group">
									<label>Munkaválaló hozzádás</label>
									<select name="user_id" name="user_id" class="form-control">
								<?
				$sql_user ="SELECT * FROM `user`";
				$result_user = mysql_query($sql_user);
				while($user_list = mysql_fetch_array($result_user)){ 
				$vezeteknev = $user_list['vezeteknev'];
				$keresztnev = $user_list['keresztnev'];
				$user_id = $user_list['user_id'];
				if($m_id == $user_id){
				$select_var = "selected";
			}else{
				$select_var = "";
				}
				echo "<option ".$select_var." value='".$user_id."' >".$vezeteknev." ".$keresztnev."</option>";
				}?>
									</select>
								</div>
							
								
							</div>
		
								<div class="col-md-12">
								<div  id="<? echo $pid; ?>" onclick="<? echo $button_var; ?>" class="btn btn-primary">Submit Button</div>
					
								</div>
						</form>
				
	
			</div><!-- /.col-->
		</div><!-- /.row -->





