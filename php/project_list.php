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
      
            url: "<? echo $local; ?>php/project_proc.php?szures="+value,
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
      
            url: "<? echo $local; ?>php/save_level.php?save_level="+nev,
			            success: function(html)
                     {
                $("#mail_info_box").empty().append(html);
            }
        });

 	}
}
</script>
 <div class="row" id="">
<h4>Csoportos levél leválogatás:</h4>
<div class="left">
<select onchange="szures(this);" id="select_feltetel name="select_feltetel">  
<option value="0">Vállasszon szürési feltételt </option>	
<option value="1"> Összes</option>	
<option value="2">Csak a Férfiak </option>	
<option value="3">Csak a Nök </option>
<option value="4">Admin</option>		
			
</select>
</div>
<div class=" small left" style="margin:0 10px;"></div>  <div class=" left" style="margin:0 10px;">Név</div> <div class=" left" style="margin:0 10px;"><input type="text" id="nev" name="nev"> </div>
<div onclick="save_level()" class="btn btn-success btn-md" style="margin:0 10px;"> Ment   </div>
</div>
 <div id="project_proc">
<? include ('project_proc.php');?>

</div>


