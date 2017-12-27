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
		$sql ="UPDATE `user` SET `aktiv` = '0' WHERE `az_id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
  }
 if(isset($_GET['a'])){
 	
 	
 	}
 	
 	 if(isset($_GET['delet'])){
 		$id =	$_GET['delet'];
 	 	$sql ="DELETE FROM `user` WHERE `id` = $id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	echo  "<script>$('#myModal').modal('hide');alert('Felhasználó törölve')</script>";
 	}
 if(isset($_GET['add'])){

$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$telefon = $_POST['tel'];
$email = $_POST['email'];
$teljes_nev = $_POST['t_nev'];
$felhasznalo_nev = $_POST['nev'];
$statusz = $_POST['statusz'];
$pass = MD5('asap123');
				$sql = "INSERT INTO `user` (
		`user_id`,
		`name`,
		`pass`,
		`telefon`,
		`teljes_nev`,
		`email`, 
		`comment`,
		 `aktiv`,
		`reg_date`) 
		VALUES (
		'$user_id', 
		'$felhasznalo_nev',
		'$pass',
		'$telefon',
		'$teljes_nev',
		'$email',
		'$comment',
		'$statusz', 
		CURRENT_TIMESTAMP
		);";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}

 	echo  "<script>$('#myModal').modal('hide');alert('Felhasználó hozzáadva')</script>";

}
 if(isset($_GET['edit'])){
 	$edit = $_GET['edit'];
$comment = $_POST['comment'];
$user_id = $_POST['user_id'];
$telefon = $_POST['tel'];
$email = $_POST['email'];
$teljes_nev = $_POST['t_nev'];
$statusz = $_POST['statusz'];
$felhasznalo_nev = $_POST['nev'];
$sql = " UPDATE `user` SET 
`name` = '$felhasznalo_nev', 
`comment` = '$comment', 
`telefon` = '$telefon',   
`teljes_nev` = '$teljes_nev', 
`aktiv` = '$statusz',
`email` = '$email'
WHERE `id` = '$edit';";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
 	echo  "<script>$('#myModal').modal('hide');alert('Felhasználó szerkesztve')</script>";
}
		
  ?>
<script>
 	         		function set_user() {

    $.ajax( {
        type: 'POST',
        url: "<? echo $local; ?>php/user_list_proc.php",
        data: $("#user").serialize(),
        success: function(html) {
            $("#table_var").empty().append(html);
        }
    } );

    return false;

  }
</script>
<div class="col-sm-12  col-lg-12  main">	
	
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">Felhasználók</div>
											<div class="input-group">
						
							<span class="input-group-btn">
						
							  

							</span>
						</div>
					<div class="panel-body">
						<form name="user" id="user" role="form">
							<div class="row">
								<div class="col-md-4">
								<div  class="form-group">
																	
						<div class="input-group">
							<input id="btn-input" name="user_dat" class="form-control input-md" placeholder="Telefonszám, email, név" type="text">
							<span class="input-group-btn">
								<div onclick="set_user();" class="btn btn-primary btn-md" id="btn-todo">Keres</div>
							</span>
						</div>
						</div>
								</div>
							<div class="col-md-2" class="text-center">  <button type="button" class="myBtn btn btn-primary btn-md" onclick="add_user(this.id);"  ><i class="fa fa-lg fa-eye-slash "></i> Uj felhasználó</buttom></div>
							</div>
					
						</form>

   <div class='row'>

 
   	<div class="col-md-2">Név</div>
		<div class="col-md-2">Felhasználó</div>
   	<div class="col-md-2">Email</div>
   	<div class="col-md-2">Telefonszám</div>
   	<div class="col-md-2">Szerepkör</div>
		<div class="col-md-2">Szerkesztés</div>	


   	</div>
 <div id="table_var">

 	<? include("user_list_proc.php"); ?>	
 	
 </div>
 </div>
 
 </div>
  </div>
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