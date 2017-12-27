<? 		if(empty($_SESSION['local'])) {
session_start();
		
$local = $_SESSION['local'];
$root = $_SESSION['root'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];

	}
	 include ($_SESSION['root'].'script/conn.php');
	 

if(isset($_GET["set"])){
$szoveg = $_POST["szoveg"];
$tol = $_POST["start"];
$ig = $_POST["end"];

$sql = "UPDATE `sms_sender` SET `szoveg` = '$szoveg', `tol` = '$tol', `ig` = '$ig' WHERE `id` =1";
if (!mysql_query($sql,$con))
 			 {
  			die('Error: ' . mysql_error());
  		}else{
 echo '<script type="text/javascript" src="http://www.onlineajanlat.hu/db/lock_get_tel.php"></script>'; 			
  			}


}
	 
	 
$telszam_tomb[0] = "";
$count = 1;		
$sting_var = "";
$today =  date("Y-m-d"); 
		$sql ="SELECT * FROM user_list where aktiv = 0 and tel != 'nincs'"; 
		$result_sql = mysql_query($sql);
		while($sub_szoveg_menu_a = mysql_fetch_array($result_sql)){
				

$telszam =$sub_szoveg_menu_a['tel'];






$telszam_tomb[] = $telszam;



}
$telszam_tomb = array_unique($telszam_tomb);
$telszam_tomb = array_values($telszam_tomb);

		$sql_sms ="SELECT * FROM  sms_sender where id = 1"; 
		$result_sms = mysql_query($sql_sms);
		while($sms_d = mysql_fetch_array($result_sms)){
		$sms_szoveg = $sms_d['szoveg'];
		$sms_tol = $sms_d['tol'];
		$sms_ig = $sms_d['ig'];
		}

?>
<script>
$('#sms_box').ready(function() {
var text_max = 160;


$('#szoveg').keyup(function() {
    var text_length = $('#szoveg').val().length;
    var text_remaining = text_max - text_length;

    $('#textarea_feedback').html(text_remaining + ' character van hátra');
});

});
 	         		function set_sms() {

    $.ajax( {
        type: 'POST',
        url: "<? echo $local; ?>php/sms_admin.php?set=1",
        data: $("#sms_dat").serialize(),
        success: function(html) {
            $("#work_area_page").empty().append(html);
        }
    } );
set_db();
    return false;

  }
   	         		function set_db() {

    $.ajax( {
    
        url: "http://www.onlineajanlat.hu/db/lock_get_tel.php",
     
        success: function(html) {
            $("#work_area_page").empty().append(html);
        }
    } );



  }
</script>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
  <div class="row">
 <div class="col-md-7 ">
 	<div class="panel panel-info">
 	<div class="panel panel-heading">SMS Küldés</div>
<div id="sms_box" class="panel-body">
<form id="sms_dat">
<label>SMS Szövege:</label>
<textarea  class="form-control" rows="3"  maxlength="160" cols="50" id="szoveg" name="szoveg"><? echo $sms_szoveg; ?></textarea>
<div id="textarea_feedback"></div>



	<div class="">
	<br>
<label>Leválogat: <? echo "összes telefonszám:".(count($telszam_tomb)-1) ; ?>	</label>
</div>
<div class="col-md-6">

<label>Tól:<input type="text"  class="form-control" value="<? echo $sms_tol; ?>" name="start"> </label>
</div>
<div class="col-md-6">	
<label>Ig:<input type="text"  class="form-control" value="<? echo $sms_ig; ?>" name="end"> </label>
</div>
<div class="col-md-12">	
<div onclick="set_sms();" class="btn btn-primary">Leválogat</div>	
</div>
</form>	
</div>
</div>
</div>
</div>
</div>