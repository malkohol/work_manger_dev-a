  <? if(empty($_SESSION['local'])){
 	session_start();
	$local =  $_SESSION['local'];



 	}
if(isset($_GET['macro_cont'])){
	$macro_cont = 	$_GET['macro_cont'];	
	}else{
 $macro_cont = 	"sablon_keszito";		
}
 	
 	?>
 	<div id="" class="row">
<div id="mail_box" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

<div class="col-md-12">


<ol class="breadcrumb">


	<li style="padding:5px;" class="left <? if($macro_cont=="sablon_keszito"){echo "active";}else{echo "";} ?>"><a href="<? echo $local; ?>index.php?cont=mail"><i class="fa fa-lg fa-user"></i>&nbsp;Levél sablon</a></li>
  <li style="padding:5px;"  class="left <? if($macro_cont=="szures"){echo "active";}else{echo "";} ?>"><a href="<? echo $local; ?>index.php?cont=mail&macro_cont=project_list"><i class="fa fa-lg fa-user"></i>&nbsp;Szurések</a></li>
  <li style="padding:5px;"   class="left <? if($macro_cont=="kuldes"){echo "active";}else{echo "";} ?>"><a href="<? echo $local; ?>index.php?cont=mail&macro_cont=kuldes"><i class="fa fa-lg fa-user"></i>&nbsp;Levélküldés</a></li>

 </ol>
</div>

<div class="col-md-7 ">
	 	<div id="" class="row	">
 <?


if($macro_cont == "sablon_keszito"){?>
    <div  id="work_box">
    <?  	include ($root.'php/create_sablon.php'); ?>
    </div>
  
<? }

if($macro_cont == "email"){?>
    <div id="work_box">
    <?  	include ($root.'php/email_admin.php'); ?>
    </div>
<? }
if($macro_cont == "project_list"){?>
    <div id="work_box">
    <?  	include ($root.'php/project_list.php'); ?>
    </div>
  
<? }

if($macro_cont == "kuldes"){?>
    <div id="work_box">
    <?  	include ($root.'php/kuldes.php'); ?>
    </div>
  
<? }
?>
</div>	

</div>

</div>

</div>