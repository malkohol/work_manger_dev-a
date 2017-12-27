 <? if(empty($_SESSION['local'])){
 	session_start();
 	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];

}else{
	$root =  $_SESSION['root'];
	$local =  $_SESSION['local'];
	}

	 
 include($root.'/script/conn.php');	
 ?>
 
 <script>
 	 	  	function load_elonezet(){


 	jQuery.ajax(
        {	
        	 type: 'POST',
            url: "<? echo $local; ?>php/convert_text.php",
					  data: $("#textfield").serialize(),
            success: function(html)
           
            {
                $("#elonezet").empty().append(html);
            }
        });

 	}
 	 	  	function save_sabon(){


 	jQuery.ajax(
        {	
        	 type: 'POST',
            url: "<? echo $local; ?>php/sablon_lista.php?save_sablon=1",
					  data: $("#textfield").serialize(),
            success: function(html)
           
            {
                $("#sablon_lista").empty().append(html);
            }
        });

 	}
 	
 	 	 	  	function edit_sabon(r){


 	jQuery.ajax(
        {	
        	 type: 'POST',
            url: "<? echo $local; ?>php/sablon_lista.php?edit_sablon="+r,
					  data: $("#textfield").serialize(),
            success: function(html)
           
            {
                $("#sablon_lista").empty().append(html);
            }
        });

 	}
 	
 	 	 	  	function load_sabon(r){


 	jQuery.ajax(
        {	
      
            url: "<? echo $local; ?>php/sablon_proc.php?load_sablon="+r,
			            success: function(html)
                     {
                $("#sablon_proc").empty().append(html);
            }
        });

 	}
 	
 	</script>
<? 
if(isset($_GET["load_sablon"])){
$load_sablon = $_GET["load_sablon"];
							$sql_sablon="SELECT * FROM `mail_sablon` where id = $load_sablon";
  						$result_sablon = mysql_query($sql_sablon);
  						while($sablon = mysql_fetch_array($result_sablon)){
  					
  						$sbalon_id = $sablon['id'];
      				$sbalon_nev = $sablon['nev'];
  						$sbalon_subject = $sablon['subject'];
  						$sbalon_date = $sablon['date'];
							$sbalon_szoveg = $sablon['szoveg'];
							$szoveg_var = "Szerkeszt";
							$script_var = "edit_sabon";
}
}else{
							$sbalon_id = "";
      				$sbalon_nev ="";
  						$sbalon_subject = "";
  						$sbalon_date = "";
							$sbalon_szoveg = "";	
							$szoveg_var = "ment";
							$script_var = "save_sabon";
	}
	
?> 
 
 
 
<form id="textfield" name="textfield">
	<div class="col-md-12" id="">
	<h4><b>Levél sablon:</b></h4>
	<label>Sablon neve:</label><input class="form-control" placeholder="Placeholder" type="text" name="nev" value="<? echo $sbalon_nev ?>" id="subject">	
	<label>Fejléc:</label><input class="form-control" placeholder="Placeholder" type="text" name="subject" value="<? echo $sbalon_subject ?>" id="subject">
</div>
<div class="col-md-9" id="">
<h4>Levél:</h4>  

<i class="glyphicon glyphicon-bold" onclick="makeit('b');" ></i>
<i class="glyphicon glyphicon-italic" onclick="makeit('i');"></i>
<i class=" 	glyphicon glyphicon-text-width" onclick="makeit('u');"></i>
<i class="glyphicon glyphicon-align-left" onclick="makeit_aligment('left');"></i>
<i class="glyphicon glyphicon-align-center" onclick="makeit_aligment('center');"></i>
<i class="glyphicon glyphicon-align-right" onclick="makeit_aligment('right');"></i>


<textarea class="form-control" rows="3" rows="10" style="background-color:#e3e3e3;"  name="my_textarea" id="my_textarea"><? echo $sbalon_szoveg ?></textarea>
</div>



  <div class="col-md-3 " id="">

<h4>Vátozok:</h4>  

  <div data-role="main" class="ui-content scroll">

    <ol data-role="listview">
      <li><a href="#" onclick="insertAtCaret('my_textarea','#cegnev#');load_elonezet();return false;">Cegnév</a></li>
      <li><a href="#" onclick="insertAtCaret('my_textarea','#telfonszam#');load_elonezet();return false;">Telefonszám</a></li>
      <li><a href="#" onclick="insertAtCaret('my_textarea','#email#');load_elonezet();return false;">Email</a></li>
      <li><a href="#" onclick="insertAtCaret('my_textarea','#szam_cim#');load_elonezet();return false;">Cím</a></li>
			<li><a href="#" onclick="insertAtCaret('my_textarea','#act_date#');load_elonezet();return false;">Előfizetés</a></li>
			<li><a href="#" onclick="insertAtCaret('my_textarea','#user_id#');load_elonezet();return false;">Felhasználó id</a></li>
    </ol>


</div>	

</div>
<div class="col-md-12" id="">
<div onclick="load_elonezet();" class="btn btn-primary">Előnézet</div>
<div id="<? echo $sbalon_id ?>" onclick="<? echo $script_var ?>(this.id);" class="btn btn-primary"><? echo $szoveg_var ?></div>
</div>
</form>