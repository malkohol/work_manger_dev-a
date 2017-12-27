	<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 

if(empty($_SESSION["cimlista"])){
	$_SESSION["cimlista"][0]["nev"] ="";
	$_SESSION["cimlista"][0]["id"] = 0;
	}
if(empty($_SESSION["ugyfel"])){
	$_SESSION["ugyfel"][0]["nev"] ="";
	$_SESSION["ugyfel"][0]["id"] = 0;
	}
	
		include ($root.'script/conn.php');
	unset($_SESSION['futar']);
		$count_futar = 0;
		$sql_futar ="SELECT * FROM `user` ";
		$result_futar = mysql_query($sql_futar);
		while($futar_list = mysql_fetch_array($result_futar)){ 
		$_SESSION['futar'][$count_futar]['id'] = $futar_list['user_id'];
		$_SESSION['futar'][$count_futar]['nev'] = $futar_list['teljes_nev'];
		$count_futar++;
		}
$_SESSION['megrendelo'] = 0;
$_SESSION['cel'] = 0;
$_SESSION['felvetel'] = 0;

if(isset($_GET['edit'])){
	$edit = 1;
			$edit_id = $_GET['edit'];
		$sql_products ="SELECT * FROM `kuldemeny` where pid =  $edit_id";
		$result_products = mysql_query($sql_products);
		while($product_list = mysql_fetch_array($result_products)){ 
		$pid = $product_list['pid'];
		$csomag_felvetel = $product_list['csomag_felvetel'];
		$csomag_cel = $product_list['csomag_cel']; 
		$csomag_adat = $product_list['csomag_adat'];
		$price = $product_list['price'];
		$szam_cim = $product_list['szam_cim'];
		$suly = $product_list['suly'];
		$comment = $product_list['description'];
		$created_at = $product_list['created_at'];
		$start_date = $product_list['start_date'];
		$end_date = $product_list['end_date'];
		$button_var = "edit_munka(this.id);";
		$futar = $product_list['futar'];
		$comment = $product_list['description'];
		$start_date = $product_list['start_date'];
		$fizetes = $product_list['fizetes'];
		$megrendelo_id = $product_list['megrendelo_id'];
$felvetel = explode("&", $csomag_felvetel);
$cel = explode("&", $csomag_cel);
$csomag = explode("&", $csomag_adat);
$szamlazas = explode("&", $szam_cim);

$cel_sub = explode("#", $cel[5]);

$c_iranyio = $cel_sub[0];
$c_varos	=  $cel_sub[1];
$c_utca	 =  $cel_sub[2];
$c_emelt	= $cel_sub[3];

$fel_sub = explode("#", $felvetel[5]);

$f_iranyio = $fel_sub[0];
$f_varos	= $fel_sub[1];
$f_utca	 = $fel_sub[2];
$f_emelt	= $fel_sub[3];

$button_text ="Szerkeszt";




}
}else{
	$edit = 0;
	$pid ="";
$felvetel[0] ="";
$felvetel[1] ="";
$felvetel[2] ="";
$felvetel[3] ="";
$felvetel[4] ="";


$f_iranyio ="";
$f_varos="";
$f_utca="";
$f_emelt="";

$c_iranyio ="";
$c_varos="";
$c_utca="";
$c_emelt="";

$cel[0] ="";
$cel[1] ="";
$cel[2] ="";
$cel[3] ="";
$cel[4] ="";

$csomag[0] ="";
$csomag[1] ="";
$csomag[2] ="";
$csomag[3] ="";
$csomag[4] ="";

$szamlazas[0] ="";
$szamlazas[1] ="";
$szamlazas[2] ="";
$szamlazas[3] ="";
$szamlazas[4] ="";
$szamlazas[5] ="";
$szamlazas[6] ="";
$szamlazas[7] ="";
$comment ="";
$megrendelo_id="";
$suly = 0;
$start_date=date("Y-m-d");
$munkaszam = date("YmdHis");
$button_var ="add_munka();";
$m_id = "";
$button_text ="Ment";
}
		?>
				<script>
					$(document).ready(function() {
    $('#start_date')
        .datepicker({
            format: 'yyyy-mm-dd'
           
        })
        
});
					
			   var felvTag = [
    <?
      for ($iuv = 0; $iuv <= count($_SESSION['cimlista'])-1; $iuv++) {	
      echo '{
      label:	"'.$_SESSION["cimlista"][$iuv]["nev"].'",
      id:	"'.$_SESSION["cimlista"][$iuv]["id"].'",	
      	},';
       
      
    }?>
    ];		
   var cimzettTag = [
    <?
      for ($iu = 0; $iu <= count($_SESSION['cimlista'])-1; $iu++) {	
      echo '{
      label:	"'.$_SESSION["cimlista"][$iu]["nev"].'",
      id:	"'.$_SESSION["cimlista"][$iu]["id"].'",	
      	},';
       
      
    }?>
    ];
 
 
  var availableTags = [
    <?
      for ($iua = 0; $iua <= count($_SESSION['ugyfel'])-1; $iua++) {	
      echo '{
      label:	"'.$_SESSION["ugyfel"][$iua]["nev"].'",
      id:	"'.$_SESSION["ugyfel"][$iua]["id"].'",	
      	},';
 
     
   
      
    }?>
    ];
    
    $( ".addresspicker" ).autocomplete({
      source: availableTags,
      focus: function( event, ui ) {
        $( "#szam_nev" ).val( ui.item.label );
     
        return false;
      },
          select: function( event, ui ) {
        $( "#szam_nev" ).val( ui.item.label );
    			
				add_urlap(ui.item.id);
        
      }
    
    });
   
       $( ".addresspicker1" ).autocomplete({
      source: cimzettTag,
      focus: function( event, ui ) {
        $( "#f_nev" ).val( ui.item.label );
     
        return false;
      },
          select: function( event, ui ) {
        $( "#f_nev" ).val( ui.item.label );
    			
				add_cim(ui.item.id);
        
      }
    
    }); 
    
    
           $( ".addresspicker2" ).autocomplete({
      source: felvTag,
      focus: function( event, ui ) {
        $( "#cim_nev" ).val( ui.item.label );
     
        return false;
      },
          select: function( event, ui ) {
        $( "#cim_nev" ).val( ui.item.label );
    			
				add_cel(ui.item.id);
        
      }
    
    });
    
$('#modalIns').modal('show');
$( ".addresspicker" ).autocomplete( "option", "appendTo", ".eventInsForm" );
  
  
  
   	         		function add_urlap(r) {

    $.ajax( {
        type: 'GET',
        url: "<? echo $local; ?>php/add_urlap.php?ceg_adatok="+r,
 				success: function(html) {
            $("#xxx").empty().append(html);
        }
       
    } );


  }
     	         		function add_cim(r) {

    $.ajax( {
        type: 'GET',
        url: "<? echo $local; ?>php/add_urlap.php?add_cim="+r,
 				success: function(html) {
            $("#xxx").empty().append(html);
        }
       
    } );


  }
      	         		function add_cel(r) {

    $.ajax( {
        type: 'GET',
        url: "<? echo $local; ?>php/add_urlap.php?add_cel="+r,
 				success: function(html) {
            $("#xxx").empty().append(html);
        }
       
    } );


  } 
  
    function get_coord_f() {
  		  var f_cim = document.getElementById("f_cim").value; 

var geocoder = new google.maps.Geocoder();
var address = f_cim;

geocoder.geocode( { 'address': address}, function(results, status) {

if (status == google.maps.GeocoderStatus.OK) {
var latitude = results[0].geometry.location.lat();
var longitude = results[0].geometry.location.lng();
    document.getElementById("f_coord").value = latitude+"|"+longitude;
    } 
}); 
 
}
    function get_coord_c() {
  		  var c_cim = document.getElementById("cim_cim").value; 
 
 
        var geocoder = new google.maps.Geocoder();
var address = c_cim;

geocoder.geocode( { 'address': address}, function(results, status) {

if (status == google.maps.GeocoderStatus.OK) {
var latitude = results[0].geometry.location.lat();
var longitude = results[0].geometry.location.lng();
    document.getElementById("c_coord").value = latitude+"|"+longitude;
    } 
}); 
  
}

function fill_cim_f(){

var f_iranyio = $('#f_iranyio').val();
var f_varos = $('#f_varos').val();
var f_utca = $('#f_utca').val();
var f_emelet = $('#f_emelt').val();
var f_cim_var = f_iranyio+' '+f_varos+' '+f_utca+' '+f_emelet;
$('#f_cim').val(f_cim_var);
get_coord_f();
}

function fill_cim_c(){

var c_iranyio = $('#c_iranyio').val();
var c_varos = $('#c_varos').val();
var c_utca = $('#c_utca').val();
var c_emelet = $('#c_emelt').val();
var c_cim_var = c_iranyio+' '+c_varos+' '+c_utca+' '+c_emelet;
$('#cim_cim').val(c_cim_var);
get_coord_c();
}

function get_irsz_f(r){
   var input = $("#f_varos");
    $.ajax( {
        type: 'GET',
        url: "<? echo $local; ?>php/get_irany.php?irany="+r,
 				success: function(data) {
       	 data = data.replace(/\s+/g, '');
          input.val(data); 
          fill_cim_f();
        }
     
    } );

}

function get_irsz_c(r){
   var input = $("#c_varos");
    $.ajax( {
        type: 'GET',
        url: "<? echo $local; ?>php/get_irany.php?irany="+r,
 				success: function(data) {
         data = data.replace(/\s+/g, '');
         input.val(data); 
       	fill_cim_c();
        }
       
    } );

}



</script>
<style>
.ui-autocomplete-input {
  border: none; 
  font-size: 14px;
  width: 100%;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
#modalIns{
    width:100%;
}	
	
</style>
      <div class="modal-body">
      
				
							<h4 align="center">Felvételi hely:</h4>
							<form id="munka_form">
							
								<div class="form-group">
									<label for="nev">Cég/személy neve:</label>
									<input name="f_nev" class="form-control addresspicker1 " value="<? echo $felvetel[0];  ?>" placeholder="Cég/személy neve:">
								</div>
								
									<div class="form-group">
									<label>Címe:</label>
									<div class="row">	
									<div class="col-lg-2"><label>Irányítószám:*</label>	<input onchange="get_irsz_f(this.value);" name="f_iranyio" id="f_iranyio" value="<? echo $f_iranyio  ?>"   class="form-control " placeholder="Irányitószám"></div>
									<div class="col-lg-3"><label>Város:*</label>	<input name="f_varos" id="f_varos" value="<? echo $f_varos;  ?>"  onchange="fill_cim_f();" class="form-control " placeholder="Város"></div>
									<div class="col-lg-4"><label>Utca házszám:*</label>	<input name="f_utca" id="f_utca" value="<? echo $f_utca  ?>"  onchange="fill_cim_f();" class="form-control " placeholder="Utca házszám"></div>
									<div class="col-lg-3"><label>Emelet/Ajtó:</label>	<input name="f_emelt" id="f_emelt" value="<? echo $f_emelt  ?>"  onchange="fill_cim_f();" class="form-control " placeholder="Emelet Ajtó"></div>
								</div>
									<input name="f_cim" id="f_cim" value="<? echo $felvetel[1]  ?>" class="form-control" onchange="get_coord_f();" placeholder="Megrendelés cime:">
								</div>
									<div class="form-group">
									<label>Kapcsolattartó neve:</label>
									<input id="f_kap_nev" name="f_kap_nev" value="<? echo $felvetel[2]  ?>" class="form-control" placeholder="Kapcsolattartó neve:">
								</div>
										<div class="form-group">
									<label>Kapcsolattartó Telefonszáma:</label>
									<input id="f_tel" name="f_tel" value="<? echo $felvetel[3]  ?>" class="form-control" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
									<div class=""><input value="<? echo $felvetel[4]  ?>" name="f_coord" id="f_coord"  type="text"></div>							
								
								<h4 align="center">Címzett:</h4>
						
							
								<div class="form-group">
									<label for="nev">Cég/személy neve:</label>
						
									<input id="cim_nev" name="cim_nev" class="form-control addresspicker2" value="<? echo $cel[0]  ?>" placeholder="Cég/személy neve:">
								</div>
								
									<div class="form-group">
									<label>Címe:</label>
									<div class="row">	
									<div class="col-lg-2"><label>Irányítószám:*</label>	<input name="c_iranyio" id="c_iranyio" value="<? echo $c_iranyio  ?>"  onchange="get_irsz_c(this.value);" class="form-control " placeholder="Irányitószám"></div>
									<div class="col-lg-3"><label>Város:*</label>	<input name="c_varos" id="c_varos" value="<? echo $c_varos;  ?>"  onchange="fill_cim_c();" class="form-control " placeholder="Város"></div>
									<div class="col-lg-4"><label>Utca házszám:*</label>	<input name="c_utca" id="c_utca" value="<? echo $c_utca  ?>"  onchange="fill_cim_c()" class="form-control  placeholder="Utca házszám"></div>
									<div class="col-lg-3"><label>Emelet/Ajtó:</label>	<input name="c_emelt" id="c_emelt" value="<? echo $c_emelt  ?>" onchange="fill_cim_c();"  onchange="" class="form-control " placeholder="Emelet Ajtó"></div>
								</div>
									<input name="cim_cim" id="cim_cim" value="<? echo $cel[1]  ?>"  onchange="get_coord_c();" class="form-control" placeholder="Megrendelés cime:">
								</div>
									<div class="form-group">
									<label>Kapcsolattartó neve:</label>
									<input id="cim_kap" name="cim_kap" class="form-control" value="<? echo $cel[2]  ?>" placeholder="Kapcsolattartó neve:">
								</div>
										<div class="form-group">
									<label>Kapcsolattartó Telefonszáma:</label>
									<input id="cim_tel" name="cim_tel" class="form-control" value="<? echo $cel[3]  ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>	
								<div class=""><input name="c_coord" id="c_coord" value="<? echo $cel[4]  ?>" type="text"></div>
								<h4 align="center">Küldemény:</h4>
													<div class="form-group">
									<label>Kiszállítás módja: </label>
									<input name="kiszal_dij" class="form-control" value="<? echo $csomag[4]  ?>" placeholder="Szolgáltatás díja:">
								</div>
										<div class="form-group">
									<label>Szolgáltatás díja: </label>
									<input name="kuld_dij" class="form-control" value="<? echo $csomag[0]  ?>" placeholder="Szolgáltatás díja:">
								</div>
										<div class="form-group">
									<label>Küldemény megnevezése:</label>
									<input name="kuld_nev" class="form-control" value="<? echo $csomag[1]  ?>" placeholder="Küldemény megnevezése: ">
								</div>
									<div class="form-group">
									<label>Csomagok db száma: </label>
									<input name="kuld_db" class="form-control" value="<? echo $csomag[2]  ?>" placeholder="Csomagok db száma:">
								</div>
										<div class="form-group">
									<label>Csomagok Súlya:(kg) </label>
									<input name="suly" class="form-control" value="<? echo $suly  ?>" placeholder="Csomagok Súlya:(kg)">
								</div>
										<div class="form-group">
									<label>Utánvét összege: </label>
									<input name="kuld_ossz" class="form-control" value="<? echo $csomag[3]  ?>" placeholder="Utánvét összege:">
								</div>	


								<h4 align="center">Számlázási cím:</h4> 
								<div class="form-group">
																<div class="radio">
<?

 if($megrendelo_id == 1){
	$radio_var = 'checked="checked"';
	$radio_var1 = "";
}else{
	$radio_var = "";
	$radio_var1 = 'checked="checked"';
	}
	?>
  <label><input type="radio" value="1" <? echo $radio_var ?> name="optradio">Eseti megrendelő</label>
  <label><input type="radio" <? echo $radio_var1 ?> name="optradio">Kiemelt megrendelő</label>
</div>

</div>
								<div class="form-group">
									<div class=""><input id="megrend_id" name="megrend_id" class="form-control" value="<? echo $megrendelo_id ?>"></div>
									<label for="nev">Cég/személy neve:</label>
									<input id="szam_nev" name="szam_nev" class="form-control addresspicker ui-autocomplete-input" value="<? echo $szamlazas[0]  ?>" placeholder="Cég/személy neve:">
								</div>
										<div class="form-group">
									<label>Cég/személy címe:</label>
									<input id="szam_cim" name="szam_cim" class="form-control" value="<? echo $szamlazas[1]  ?>" placeholder="Kapcsolattartó neve:">
								</div>
										<div class="form-group">
									<label>Kapcsolattartó neve:</label>
									<input id="szam_kap"  name="szam_kap" class="form-control" value="<? echo $szamlazas[2]  ?>" placeholder="Kapcsolattartó neve:">
								</div>
										<div class="form-group">
									<label>Kapcsolattartó Telefonszáma:</label>
									<input id="szam_tel" name="szam_tel" class="form-control" value="<? echo $szamlazas[3]  ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
												<div class="form-group">
									<label>Kapcsolattartó Email:</label>
									<input id="szam_email" name="szam_email" class="form-control" value="<? echo $szamlazas[4]  ?>" placeholder="Kapcsolattartó Telefonszáma:">
								</div>
										<div class="form-group">
									<label>Adoszám:</label>
									<input id="szam_ado" name="szam_ado" class="form-control" value="<? echo $szamlazas[5]  ?>" placeholder="Adószám:">
								</div>
												<div class="form-group">
									<label>Számlavezető Bank:</label>
									<input id="bank" name="bank" class="form-control"  value="<? echo $szamlazas[6]  ?>" placeholder="bank">
								</div>
										<div class="form-group">
									<label>Bankszamlaszám:</label>
									<input id="szam_bank" name="szam_bank" class="form-control" value="<? echo $szamlazas[7]  ?>" placeholder="Bankszamlaszám">
								</div>
						
								<div class="form-group">
									<label>Megjegyzés</label>
									<textarea  name="comment" class="form-control" value="" placeholder="comment" rows="3"><? echo $comment ?></textarea>
								</div>
										<div class="form-group">
									<label>Munka Megkezdese:</label>
									<input id="start_date" name="start_date" class="form-control" value="<? echo $start_date;  ?>" placeholder="2017-06-14">
								</div>
										<div class="form-group">
									<label>Fizetés modja:</label>
								<select class="form-control" id="fizetes" name="fizetes">
								
								
									<?	for ($iff = 0; $iff <= count($_SESSION['fizetes'])-1; $iff++) {
					
									
									
									if($fizetes == $iff){
										$select_var = "SELECTED";	
										}else{
										$select_var  ="";
									}
									
									echo 	"<option value='".$iff."' ".$select_var.">".$_SESSION['fizetes'][$iff]."</option>";
								}
								
								
								
								
									?>
								</select>
								</div>
								<div class="form-group">
									<label>Futár</label>
									<select name="futar" value='0' class="form-control">
								<?	for ($ifa = 0; $ifa <= count($_SESSION['futar'])-1; $ifa++) {
					
									
									
									if($futar == $_SESSION['futar'][$ifa]['id']){
										$select_var = "SELECTED";	
										}else{
										$select_var  ="";
									}
									
									echo 	"<option value='".$_SESSION['futar'][$ifa]['id']."' ".$select_var.">".$_SESSION['futar'][$ifa]['nev']."</option>";
								}
								
								
								
								
									?>
								
									</select>
								</div>
							
						
					
						</form>
						<div class="row">
												<div class="col-md-12">
								<div  id="<? echo $pid; ?>" onclick="<? echo $button_var; ?>" class="btn btn-primary"><? echo $button_text ?></div>
						<? if($edit == 1) {?>
								<div  id="<? echo $pid; ?>" onclick="delet_kuldemeny(this.id);" class="btn btn-danger">Töröl</div>
							<? } ?>
								</div>		
	</div>	
	<div id="xxx"></div>
    </div>





