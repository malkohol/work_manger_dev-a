  <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
		$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}
include($root.'/script/conn.php');
	
unset($_SESSION['actual_tev']);
	
if(isset($_GET['p'])){
$az_id =	$_GET['p'];
		$sql ="UPDATE `cim_lista` SET  WHERE `id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
  }
 	 if(isset($_GET['delet'])){
 		$id =	$_GET['delet'];
 	 	$sql ="DELETE FROM `cim_lista` WHERE `id` = $id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	echo  "<script>$('#myModal').modal('hide');alert('Cim törölve')</script>";
 	}

 if(isset($_GET['edit'])){
 	$edit = $_GET['edit'];

$cim = $_POST['cim'];
$email = $_POST['email'];
$kapcsolat = $_POST['kapcsolat'];
$nev = $_POST['nev'];
$telefon = $_POST['telefon'];
$sql = " UPDATE `cim_lista` SET 
`nev` = '$nev', 
`cim` = '$cim', 
`kapcsolat` = '$kapcsolat',   
`kapcsolat_tel` = '$telefon', 
`email` = '$email'
WHERE `id` = '$edit';";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
echo  "<script>$('#myModal').modal('hide');alert('Cim szerkesztve')</script>";
}

 if(isset($_GET['add'])){
$cim = 	$_POST['cim'];
$email = 	$_POST['email'];
$kapcsolat = 	$_POST['kapcsolat'];
$email = 	$_POST['email'];
$nev =	$_POST['nev'];
$telefon = 	$_POST['telefon'];
	
	
$sql ="INSERT INTO `cim_lista` (`id`,  `nev`, `cim`, `kapcsolat`, `kapcsolat_tel`, `email`) 
VALUES 
(NULL, '$nev', '$cim', '$kapcsolat', '$telefon', '$email');";
 
 if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}

 }


 if(isset($_GET['a'])){
$az_id =	$_GET['a'];
		$sql ="UPDATE `ugyfel` SET `aktiv` = '1' WHERE `az_id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
  }

  ?>

<div class="col-sm-12  col-lg-12  main">	
	
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">Partnerek</div>
											<div class="input-group">
						
							<span class="input-group-btn">
						
							  

							</span>
						</div>
					<div class="panel-body">
				 <div id="" class="row">
						<form name="user" id="user" role="form">
							<div class="col-md-4">
								<div  class="form-group">
									<label>Keresés (telefonszám, email, név)</label>
									
						<div class="input-group">
							<input id="btn-input" name="user_dat" class="form-control input-md" placeholder="Telefonszám, email, név" type="text">
							<span class="input-group-btn">
								<div onclick="set_cim();" class="btn btn-primary btn-md" id="btn-todo">Keres</div>
								
							</span>
								<div style="float:right;" class="myBtn btn btn-primary btn-md" onclick="add_new_cim(this.id);"  id="'.$id.'"><i class="fa fa-lg fa-eye-slash disabled"></i>Uj Cim</div>
						</div>
			
						
				
					
						</div>
						</div>
						</form>
 </div>
 
 <div id="cim_list_proc" class="">

 	<? include("cim_list_proc.php"); ?>	
 	
 </div>

 
 </div>
  </div>
   </div>
    </div>		

   </div>
   

  
   