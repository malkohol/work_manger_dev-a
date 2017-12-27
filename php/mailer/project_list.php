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
 	 	 	  	function szures(sel){
			var value = sel.value;
 	jQuery.ajax(
        {	
      
            url: "<? echo $local; ?>php/admin/project_proc.php?szures="+value,
			            success: function(html)
                     {
                $("#project_proc").empty().append(html);
            }
        });

 	}
 	
 		 	 	  	function save_level(r){

var nev = $('#nev').val();

if(nev === "") {
alert('név megadása kötelező');
}else{

 	jQuery.ajax(
        {	
      
            url: "<? echo $local; ?>php/admin/save_level.php?save_level="+nev,
			            success: function(html)
                     {
                $("#mail_info_box").empty().append(html);
            }
        });

 	}
}
</script>
<div class="col-sm-12  col-lg-12  main">	
	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">Hirlevél</div>
											<div class="input-group">
						
							<span class="input-group-btn">
<a href="<? echo $local ?>/project.html">	<div o class="btn btn-primary btn-md">Leválogatás</div></a>>
					<a href="<? echo $local ?>/sablon.html">	<div class="btn btn-primary btn-md">Levél küldés</div>	
							</span>
						</div>
							</div>
							<div class="panel-body">
<h4>Csoportos levél leválogatás:</h4>
<div class="left">
<select onchange="szures(this);" id="select_feltetel name="select_feltetel">  
<option value="0">Vállasszon szürési feltételt </option>	
<option value="1">Csak a Pérmium Tagok </option>	
<option value="2">Még Nem fizetek elő </option>	
<option value="3">Előfizetek Már de lejárt ! </option>
<option value="4">Összes</option>		
<option value="5">Admin</option>	
<option value="6">Invitel</option>			
</select>
</div>
<div class=" small left" style="margin:0 10px;"></div>  <div class=" left" style="margin:0 10px;">Név</div> <div class=" left" style="margin:0 10px;"><input type="text" id="nev" name="nev"> </div>
<div onclick="save_level()" class="button small left" style="margin:0 10px;"> Ment   </div>
</div>
 <div id="project_proc">
<? include ('project_proc.php');?>


</div>
</div>
</div>
</div>


