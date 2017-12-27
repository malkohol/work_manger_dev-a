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
$edit = 1;	
		$edit_id = $_GET['edit'];
		$sql_products ="SELECT * FROM `user` where id =  $edit_id";
		$result_products = mysql_query($sql_products);
		while($user_list = mysql_fetch_array($result_products)){ 
		$pid = $user_list['id'];
		$user_nev = $user_list['name'];
		$telefon = $user_list['telefon'];
		$mail = $user_list['email'];
		$teljes_nev = $user_list['teljes_nev'];
		$comment = $user_list['comment'];
		$user_id = $user_list['user_id'];
		$statusz = $user_list['aktiv'];
	}
$button_text ="Szerkeszt";
$button_var ="save_user(this.id);";
}else{
	$edit = 0;	
		$pid ="";
		$mail = "";
		$user_nev = ""; 
		$telefon = "";
		$teljes_nev = "";
		$comment = "";
		$statusz = 0;
$user_id = date("sHmid");
$button_var ="save_nev_user();";
$m_id = "";
$button_text ="Ment";
}
?>
				

		<div class="row">
		
			<div class="col-lg-12">



						<div class="col-md-12">
							<form id="user_form" >
							
								<div class="form-group">
									<label>Felhasználó neve:</label>
									<input name="nev" class="form-control" value="<? echo $user_nev ?>" placeholder="Kapcsolattartó neve:">
								<div class="hidden"><input name="user_id" class="form-control" value="<? echo $user_id ?>" placeholder=""></div>	
								</div>
								<div class="form-group">
									<label>Teljes név</label>
									<input name="t_nev" class="form-control" value="<? echo $teljes_nev ?>" placeholder="Kapcsolattartó neve:">
								</div>
																<div class="form-group">
									<label>Telefonszám:</label>
									<input name="tel" class="form-control"  value="<? echo $telefon ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
									<div class="form-group">
									<label>Email</label>
									<input name="email" class="form-control" value="<? echo $mail ?>" placeholder="Munkaszám">
								</div>								
								
								
						
								
								<div class="form-group">
									<label>Megjegyzés</label>
									<textarea  name="comment" class="form-control" placeholder="comment" rows="3"><? echo $comment ?></textarea>
								</div>
														<div class="form-group">
									<label>Felhasználó szerepkör</label>
							<? echo  $statusz?> 
									<select name="statusz" name="statusz" class="form-control">
								<?
				for ($ia = 0; $ia <= count($_SESSION['user'])-1; $ia++) {
			 
				if($statusz  == $ia ){
				$sel_var = "SELECTED";	
			}else{
				$sel_var = "";
				}
				echo "<option  value='".$ia."' ".$sel_var.">".$_SESSION['user'][$ia]."</option>";
				}?>
									</select>
								</div>
							
								
							</div>
		
								<div class="col-md-12">
								<div  id="<? echo $pid; ?>" onclick="<? echo $button_var; ?>" class="btn btn-primary"><? echo $button_text ?></div>
							<? if($edit == 1) {?>
								<div  id="<? echo $pid; ?>" onclick="delet_user(this.id);" class="btn btn-danger">Töröl</div>
							<? } ?>
								</div>
						</form>
				
	
			</div><!-- /.col-->
		</div><!-- /.row -->





