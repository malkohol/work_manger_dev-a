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

<style>
#mail_panel{
position:absolute;		
margin-top:5%;	
margin-left:35%;	
margin-right:35%;
z-index:50;
}
</style>

<script>
	var count = 0;
	var timerId = null;
function myTimeoutFunction()
{
    	
    	var send_mail	 = document.getElementById('send_mail').value;
    	var sablon	= document.getElementById('sablon').value;		
		jQuery.ajax(
        {
            url: "<? echo $local ?>php/mail_send.php?send_mail="+send_mail+"&sablon="+sablon,
             success: function(html)
            {
                $("#mail_ifo_box").append(html);
            }
        });
    timerId = setTimeout(myTimeoutFunction, 2000);
document.getElementById('count').innerHTML = "Kiküldve: "+count++
}



function stop_timer(){
clearTimeout(timerId);
alert('Levél küldés kész !')

}
function end_timer(){
clearTimeout(timerId);
alert('Levél küldés kész !')

}	
function close_panel(){
document.getElementById('mail_panel').innerHTML = "";
}
	 </script>

<? $send_mail = $_GET['send_mail'];
	 $sablon = $_GET['sablon'];	
	 
	$sql_sablon="SELECT * FROM `mail_sablon` where id =  $sablon";
  						$result_sablon = mysql_query($sql_sablon);
  						while($sablon_a = mysql_fetch_array($result_sablon)){

      				$sbalon_nev = $sablon_a['nev'];
} 
	 
	 ?>	
<div class="" id="mail_panel">
<div class="panel" id="">
<div class="row">
<div style="float:left"><h4>Levél Küldés</h4></div> <div style="float:right"><h4 onclick="close_panel();">x</h4></div>
</div>	
<div style="display:none;">
<input type="text" value="<? echo $send_mail ?>" id="send_mail" name="send_mail">

<input type="text" value="<? echo $sablon ?>" id="sablon" name="sablon">
</div>
<div class="row">
<label>Sablon Neve:<br><? echo $sbalon_nev; ?></label><br>
</div>
<div id="count"></div>
<div id="mail_ifo_box"> </div>

<div onclick="myTimeoutFunction();" class="tiny button"> Küldés</div>
<div onclick="stop_timer();" class="tiny button"> Stop</div>
</div>
</div>