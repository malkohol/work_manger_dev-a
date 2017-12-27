 <?
 if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

 	}

	 if(empty($_GET['sub_cont'])){
 $sub_cont = "";
}else{
$sub_cont = $_GET['sub_cont'];
}
	 if(empty($_GET['content'])){
 $content = "";
}else{
$content = $_GET['content'];
}

$macro_cont	= $_SESSION['tema'];


if($sub_cont == "new_mail" && $sub_cont == "email_list"){

$sql_db ="SELECT * FROM `tema` where id = $macro_cont	 ";
				$result_db = mysql_query($sql_db);
				while($db_list = mysql_fetch_array($result_db)){
				$db_nev = $db_list['nev'];	
				$db_id = $db_list['id'];	
				$_SESSION['tema'] = $db_id;
				}
}else{
	
	$db_nev = "szerkesztes";
	}
	if($sub_cont == "email_list"){
		$_SESSION['tema'] = $_GET['macro_cont'];
		
		}
		
		
	
 ?>
  <div class="col-md-12">
    <div class="work-header clearfix">
      <div class="large-3 columns primary-bg">
        <h4>Email <? echo $db_nev  ?></h4>
      </div>
      <div class="large-9 columns primary-bg-tint">

        <dl class="sub-nav">
            <dd class="<? if($content == "email" &&  $sub_cont == ""){echo "active";}else{echo "";} ?> "><a href="<? echo $local ?>index.php?content=email&sub_cont=email_list&macro_cont=<? echo $_SESSION['tema'];	 ?>">Email lista</a></dd>
            <dd class="<? if($sub_cont == "new_mail"){echo "active";}else{echo "";} ?> "><a href="<? echo $local ?>index.php?content=email&sub_cont=new_mail&macro_cont=<? echo $_SESSION['tema'];	 ?>">Új Email</a></dd>
        		<dd class="<? if($sub_cont == "email_szures"){echo "active";}else{echo "";} ?> "><a href="<? echo $local ?>index.php?content=email&sub_cont=email_szures"> Email leválogatás</a></dd>
        </dl>

      </div>
    </div>

 <div id="mail_box">
<? if($sub_cont == "email_list"){ 
 include ('email_list.php');
 
 } 
 
 if($sub_cont == "new_mail"){ 
?>
 
 	<form id="email_c">
 		
 <div class="col-md-12">
 	<input style="display:none" type="text" name="tema" value="<? echo $_SESSION['tema'] ?>">
 	 	<div class="large-3 columns">
 	<label>E-mail:</label>	
<input type="text" id="email" name="email">
 	 	 	 </div>
 	 <div class="col-md-3">
 	 	<label>Cégnév</label>	
 	 	<input type="text" id="cegnev" name="cegnev">
	</div>
		<div class="col-md-3">
		 <label>Irányitó szám</label>	
		<input type="text" id="irsz" name="irsz">
		</div>
			<div class="col-md-3">
		 <label>Város</label>	
		<input type="text" id="varos" name="varos">
		 	</div>
		 		<div class="col-md-3">
		 <label>Cim</label>	
		<input type="text" id="cim" name="cim">
		 </div>
		 <div class="col-md-3">
		 <label>Tel</label>	
		<input type="text" id="tel" name="tel">
 		 	</div>
  
 </form>
 

 	
 	<div class="large-12 columns">

 	<div class="large-3 columns">
 	<label>Tevékenység</label>	
 	<div id="act_tev">
 	<? include ('act_tev.php');?>
 	</div>
 	</div>
 	 	
 		<div class="large-3 columns">
<div id="select_tevekenyseg">
<? include ('select_tev.php');?>
</div>
 	</div>
 	<div class="large-3 columns">
 
 	<div class="row">
 	
 	<label>uj tevékenység</label>	
 	<div style="float:left;" class="large-9 columns "><form id="new_tev">	<input type="text" name="tev"></form></div>
 	<div id="<? echo $_SESSION['tema'];  ?> " onclick="add_newtev(this.id);" class="large-1 columns button tiny">+</div>
 	</div>
 	 	</div>
 	
 </div>

  <div class="large-12 columns">
  	<div onclick="save_email();" class="button">Ment</div>
  	  	<div id="email_save"></div>
 	

 	</div>
  	 </div>	
  
 <?}



 if($sub_cont == "edit_mail"){ 

$macro_cont	= $_SESSION['tema'];
$sql_mail ="SELECT * FROM `emai` where id = $macro_cont	 ";
				$result_mail = mysql_query($sql_mail);
				while($mail_list = mysql_fetch_array($result_mail)){
				$id = $mail_list['id'];
				$email = $mail_list['email'];	
				$cegnev = $mail_list['cegnev'];	
				$irany = $mail_list['irany'];
				$varos = $mail_list['varos'];
				$cim = $mail_list['cim'];
				$tel = $mail_list['tel'];
				$cinke = $mail_list['cinke'];	
				$tema = $mail_list['tema'];	

				
				}
				
								$pieces = explode("#", $cinke);
	unset($_SESSION['actual_tev']);			
	for ($i = 0; $i <= count($pieces)-1; $i++) {			
	
	$_SESSION['actual_tev'][] = $pieces[$i];
	
	}
				 ?>
 	<form id="email_c">
 		
 <div class="large-12 columns">
 	<input style="display:none" type="text" name="tema" value="<? echo $tema ?>">
 	<input style="display:none" type="text" name="user" value="<? echo $id ?>">
 	 	<div class="large-3 columns">
 	<label>E-mail:</label>	
<input type="text" id="email" value="<? echo $email ?>" name="email">
 	 	 	 </div>
 	 <div class="large-3 columns">
 	 	<label>Cégnév</label>	
 	 	<input type="text" id="cegnev" value="<? echo $cegnev ?>" name="cegnev">
	</div>
		<div class="large-3 columns">
		 <label>Irányitó szám</label>	
		<input type="text" id="irsz" value="<? echo $irany ?>" name="irsz">
		</div>
			<div class="large-3 columns">
		 <label>Város</label>	
		<input type="text" id="varos" value="<? echo $varos ?>" name="varos">
		 	</div>
		 		<div class="large-3 columns">
		 <label>Cim</label>	
		<input type="text" id="cim" value="<? echo $cim ?>" name="cim">
		 </div>
		 <div class="large-3 columns">
		 <label>Tel</label>	
		<input type="text" id="tel" value="<? echo $tel ?>" name="tel">
 		 	</div>
  
 </form>
 

 	
 	<div class="large-12 columns">

 	<div class="large-3 columns">
 	<label>Tevékenység</label>	
 	<div id="act_tev">
 	<? include ('act_tev.php');?>
 	</div>
 	</div>
 	 	
 		<div class="large-3 columns">
<div id="select_tevekenyseg">
<? include ('select_tev.php');?>
</div>
 	</div>
 	<div class="large-3 columns">
 
 	<div class="row">
 	
 	<label>uj tevékenység</label>	
 	<div style="float:left;" class="large-9 columns "><form id="new_tev">	<input type="text" name="tev"></form></div>
 	<div id="<? echo $db_id  ?> " onclick="add_newtev(this.id);" class="large-1 columns button tiny">+</div>
 	</div>
 	 	</div>
 	
 </div>

  <div class="large-12 columns">
  	<div onclick="update_email();" class="button">Szerkeszt</div>
  	  	<div id="email_save"></div>
 	

 	</div>
  	 </div>	
  
 <?} if($sub_cont == "email_szures"){
unset($_SESSION['regio']);
unset($_SESSION['megye']);
unset($_SESSION['varos']);
unset($_SESSION['iranyitszam']);   	
$_SESSION['regio'][0] = "";
$_SESSION['megye'][0] = "";
$_SESSION['varos'][0] = "";
$_SESSION['iranyitszam'][0] = "";	
unset($_SESSION['save']);
$_SESSION['save'][0]['id']="0";
 	?>
 <script>
 function set_megye(r) {

		$.ajax( {
				url: "<? echo $local ?>/php/megye.php?set_loc="+r,
							success: function(html) {
					$("#megye_box").empty().append(html);
				}
		} );
	
		}
		 function set_varos(r) {

		$.ajax( {
				url: "<? echo $local ?>/php/varos.php?set_loc="+r,
							success: function(html) {
					$("#varos_box").empty().append(html);
				}
		} );
	
		}
function szures_felt(r) {

		$.ajax( {
				type: 'POST',
				url: "<? echo $local ?>/php/szures_felt.php?add_szur="+r,
				data: $("#szures_form").serialize(),
				success: function(html) {
					$("#szures_felt").empty().append(html);
				}
		} );

		return false;

		}
		
			 function save_project() {
var project_name= (document.getElementById('project_name').value);
		$.ajax( {
				url: "<? echo $local ?>/php/save_project.php?save_project="+project_name,
							success: function(html) {
					$("#save_msg").empty().append(html);
				}
		} );
	
		}	
	</script>
	<style>
	.plusz{
		margin-top:20px;
		}	
	</style>	
  <div class="large-12 columns ">
  	<fieldset>
  	<legend>Szürés </legend>
<form id="szures_form">  	
<div  class="large-3 columns"><label>Régió</label>
<div	id="regio_box">
	<? include('regio.php'); ?>
</div>
</div>
	
<div id="" class="large-3 columns"><label>Megye</label>
	<div	id="megye_box">
	<? include('megye.php'); ?>
	</div>
	</div>

<div id="" class="large-2 columns"><label>Város</label>
		<div	id="varos_box">
		<? include('varos.php'); ?>
	</div>
	</div>
<div  class="large-1 columns">
<div onclick="szures_felt();" class="plusz button tiny">+</div>	
</div>	

<div class="large-2 columns">
	<label>Tevékenység</label>
	
	
	<? include('select_tev_szuro.php');	?>


	
</div>

<div  class="large-1 columns">
<div  class="plusz button tiny">+</div>	
</div>
 </form>	 
  </fieldset>
  </div>
    <div class="large-12 columns ">
  	<fieldset>
  	<legend>Szürési feltételek</legend>
  	<div id="szures_felt">
  	<? include('szures_felt.php');	?>
  	</div>
  	 </fieldset>
  </div>	
<?} 
 ?>

</div>

  </div>