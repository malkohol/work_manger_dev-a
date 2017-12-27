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
function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
        "ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart ('character', -txtarea.value.length);
        range.moveStart ('character', strPos);
        range.moveEnd ('character', 0);
        range.select();
    }
    else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}


 function makeit(tag){
  var $tb = document.getElementById("my_textarea");
 
  if (document.selection){
    var str=document.selection.createRange().text;
    var sel=document.selection.createRange();
    sel.text="<b>"+str+"</b>";
  }else if (typeof $tb.selectionStart != 'undefined'){
    var $before, $after, $selection;
    $before= $tb.value.substring(0, $tb.selectionStart)
    $selection = $tb.value.substring($tb.selectionStart, $tb.selectionEnd)
    $after = $tb.value.substring($tb.selectionEnd, $tb.value.length)
 
    $tb.value= String.concat($before, "<"+tag+">", $selection, "</"+tag+">", $after)
  }
   $tb.focus();
 load_elonezet();
}

 function makeit_aligment(tag){
  var $tb = document.getElementById("my_textarea");
 
  if (document.selection){
    var str=document.selection.createRange().text;
    var sel=document.selection.createRange();
    sel.text="<b>"+str+"</b>";
  }else if (typeof $tb.selectionStart != 'undefined'){
    var $before, $after, $selection;
    $before= $tb.value.substring(0, $tb.selectionStart)
    $selection = $tb.value.substring($tb.selectionStart, $tb.selectionEnd)
    $after = $tb.value.substring($tb.selectionEnd, $tb.value.length)
 
    $tb.value= String.concat($before, '<div align="'+tag+'">', $selection, '</div>\n', $after)
  }
   $tb.focus();
 load_elonezet();
}


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




	</script> 
<div class="col-sm-12  col-lg-12  main">	
	
		
		

				<div class="panel panel-info">
					<div class="panel-heading">Hirlevél - levélküldés</div>
								
						
				
					<a href="<? echo $local ?>/hirlevel.html">	<div  class="btn btn-primary btn-md">Cimlista</div></a>
					<a href="<? echo $local ?>/sablon.html">	<div class="btn btn-primary btn-md">Levél küldés</div></a>

</div> 
				<div class="panel-body">
<div class="col-md-6" id="sablon_lista">  	
<? include('sablon_lista.php'); ?>	
 	
</div> 
<div class="col-md-3 " id="sablon_lista"> 
<div class="col-md-12 panel" id="">  
<p>Leválogatot email:</p>
<p>Kiküldöt email:</p>
<p>Sablon:</p>
</div>
</div>
<div class="col-md-3 panel" id="sablon_lista">  
<select> 
<option value="0">Összes</option>	
<option value="1">Admin</option>
<option value="2">Ügyfél</option>	
<option value="3">Marketing</option>
<option value="4">Egyébb</option>			
</select>
<div class="btn btn-primary btn-sm">Szürés</div>
<div class="btn btn-primary btn-sm">Ürités</div>
</div>		
<div id="sablon_proc">
<? include('sablon_proc.php'); ?>	
	
</div>

<div class="col-md-12" id="">
<h4>Levél előnézet:</h4> 
<div class="panel">
<div id="elonezet" class="elonezet"></div>
</div> 
</div>
</div>
</div> 


