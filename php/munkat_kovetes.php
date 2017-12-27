
	<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 
	
		include ($root.'script/conn.php');
		
		if(isset($_GET['add_munka'])){
		$nev =	$_POST['nev'];
		$cim =	$_POST['cim'];
		$tel =	$_POST[	'tel'];
		$munkaszam =	$_POST['munkaszam'];
		$comment =	$_POST['comment'];
			
		
		$sql = "INSERT INTO `products` (`pid`, `name`, `munkaszam`, `cim`, `tel`, `price`, `description`, `start_date`, `end_date`, `coord`, `work_user`, `created_at`, `updated_at`) 
		VALUES (NULL, '$nev', '$munkaszam', '$cim', '$tel', '0', '$comment', '', '', '', '', CURRENT_TIMESTAMP, '0000-00-00 00:00:00');";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
		} ?>
	
	
		<?
		$sql_products ="SELECT * FROM `products` ";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$product_nev = $product_list['name'];
		$product_cim = $product_list['cim']; 
		$tel = $product_list['tel'];
		$coord = $product_list['coord'];

		$f_nev = $product_list['f_name'];
		$f_cim = $product_list['f_cim']; 
		$f_tel = $product_list['f_tel'];
		$f_coord = $product_list['f_coord'];

		$munkaszam = $product_list['munkaszam'];
		$price = $product_list['price'];
		$k_name = $product_list['k_name'];
		$k_db = $product_list['k_db'];
		$k_utanvetel = $product_list['k_utanvetel'];

	
		$description = $product_list['description'];
		$created_at = $product_list['created_at'];
		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date']; 
		
		$futar = $product_list['futar'];
		$aktiv = $product_list['aktiv'];    
	
	
	$allapot_var ="";
	
	if($end_date !=""){
			$allapot_var = "kiszallitva";
		}else{
			$allapot_var = "visszaigazolásra vár";
			}
	?>
		<div class="row">
	<div class="col-lg-12">
							
						
									<div class="col-lg-1"><? echo $munkaszam ?></div>
									<div class="col-lg-1"><? echo $f_nev."<br>".$f_cim."<br>".$f_tel ?></div>
									<div class="col-lg-1"><? echo $product_nev."<br>".$product_cim."<br>".$tel ?></div>
									<div class="col-lg-1"><? echo $k_name."<br>".$price."<br>".$k_db."<br>".$k_utanvetel ?></div>
								
									<div class="col-lg-1"><? echo $description ?></div>
									
									<div class="col-lg-1"><? echo $allapot_var ?></div>
									
									<div class="col-lg-1" ><? echo $futar ?></div>
									<div class="col-lg-1"><? echo $created_at ?></div>
									<div class="col-lg-1" ><? echo $start_date ?></div>
									<div class="col-lg-1" ><? echo $aktiv ?></div>
							
								<div class="col-lg-2" action-buttons">
									<a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
									<a href="#" class="flag"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg></a>
									<a href="#" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
								</div>
							
								
							</div>
							</div>	
						<?}?>
						
						