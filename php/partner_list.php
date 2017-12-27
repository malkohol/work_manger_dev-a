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
		$sql ="UPDATE `ugyfel` SET `aktiv` = '0' WHERE `az_id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
  }
 	 if(isset($_GET['delet'])){
 		$id =	$_GET['delet'];
 	 	$sql ="DELETE FROM `ugyfel` WHERE `id` = $id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	echo  "<script>$('#myModal').modal('hide');alert('Partner törölve')</script>";
 	}

 if(isset($_GET['edit'])){
 	$edit = $_GET['edit'];
$adpszam = $_POST['adpszam'];
$bank = $_POST['bank'];
$banszamla = $_POST['banszamla'];
$cim = $_POST['cim'];
$email = $_POST['email'];
$kapcsolat = $_POST['kapcsolat'];
$nev = $_POST['nev'];
$telefon = $_POST['telefon'];
$sql = " UPDATE `ugyfel` SET 
`nev` = '$nev', 
`cim` = '$cim', 
`kapcsolat` = '$kapcsolat',   
`telefonszam` = '$telefon', 
`email` = '$email',
`adoszam` = '$adpszam',
`banszamla` = '$banszamla',
`bank` = '$bank'
WHERE `id` = '$edit';";
			if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());
}
echo  "<script>$('#myModal').modal('hide');alert('Partner szerkesztve')</script>";
}

 if(isset($_GET['add'])){
$adoszam = 	$_POST['adpszam'];
$banszamla = 	$_POST['banszamla'];
$cim = 	$_POST['cim'];
$email = 	$_POST['email'];
$kapcsolat = 	$_POST['kapcsolat'];
$nev =	$_POST['nev'];
$telefon = 	$_POST['telefon'];
$ugyfelszam =  rand(100, 999).date("mdHis");		
	
$sql ="INSERT INTO `ugyfel` (`id`, `ugyfel_id`, `nev`, `cim`, `kapcsolat`, `telefonszam`, `email`, `adoszam`, `banszamla`, `aktiv`) 
VALUES 
(NULL, '$ugyfelszam', '$nev', '$cim', '$kapcsolat', '$telefon', '$email', '$banszamla', '$adoszam', '');";
 
 if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
 echo  "<script>$('#myModal').modal('hide');alert('Partner hozzáadva')</script>";
 }

 if(isset($_GET['pass'])){
$az_id =	$_GET['pass'];
$pass =	$_POST['pass'];
		$sql ="UPDATE `ugyfel` SET `pass` = md5('$pass') WHERE `id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
   echo  "<script>$('#myModal').modal('hide');alert('Jelszó hozzáadva')</script>";
  }


 if(isset($_GET['a'])){
$az_id =	$_GET['a'];
		$sql ="UPDATE `ugyfel` SET `pass` = '1' WHERE `az_id` = $az_id ;";



if (!mysql_query($sql,$con))

  {
  die('Error: ' . mysql_error());
		}
  }

  ?>
<script>
 	         		function set_user() {

    $.ajax( {
        type: 'POST',
        url: "<? echo $local; ?>php/partner_list_proc.php",
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
								<div onclick="set_user();" class="btn btn-primary btn-md" id="btn-todo">Keres</div>
								
							</span>
								<div style="float:right;" class="myBtn btn btn-primary btn-md" onclick="add_new_partner(this.id);"  id="'.$id.'"><i class="fa fa-lg fa-eye-slash disabled"></i>Uj Partner</div>
						</div>
			
						
				
					
						</div>
						</div>
						</form>
 </div>
 
 <div id="table_var" class="">

 	<? include("partner_list_proc.php"); ?>	
 	
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
  
   