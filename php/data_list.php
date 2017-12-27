	
	<? if(empty($_SESSION['local'])) {
session_start();

	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 
	
		include ($root.'script/conn.php');
if(empty($_SESSION['s_date'])){
$_SESSION['s_date'] = date("Y-m-d");
$_SESSION['e_date'] =date('Y-m-d');
}else{
$today = $_SESSION['s_date'];
$end_date = $_SESSION['e_date'];
}
		?>
<script>
	function data_list() { 
	   $.ajax( {
        type: 'POST',
        url: "<? echo $local; ?>/php/data_list_proc.php?action=szures",
        data: $("#dateRangeForm").serialize(),
        success: function(html) {
            $("#munka_list").empty().append(html);
        }
    } );
    return false;


}		

$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
           
        })
        
});
$(document).ready(function() {
    $('#dateRangePicker2')
        .datepicker({
            format: 'yyyy-mm-dd'
           
        })
        
});

</script>
			<div class=" col-md-12">
					<div class="  row">
					<form id="dateRangeForm" action="<? echo $_SESSION['local'].'php/gen_pdf.php' ?>" method="post">
				<div class="col-lg-12">
						<div class="col-lg-4">
							<div class="col-lg-6"><label>Kezdő dátum:</label><input class="" class="form-control" id="dateRangePicker" name="s_date" value="<? echo $today ?>" type="text">
						</div>
				 			<div class="col-lg-6"><label>Utolsó dátum:</label><input class="" class="form-control" id="dateRangePicker2" name="e_date" value="<? echo $end_date ?>" type="text">
						</div>
					</div>
						<div class="col-lg-8">
						<div class="col-lg-5"><label>Megrendelő:</label>
							<select name="ugyfel">
									<option value="0">nincs</option>
			<?					for ($fu = 0; $fu <= count($_SESSION['ugyfel'])-1; $fu++) {
  							  if($_SESSION['ugyfel'][$fu]['nev'] !=""){
  							  echo "<option value='".$_SESSION['ugyfel'][$fu]['id']."'>".$_SESSION['ugyfel'][$fu]['nev']."</option>";
							}
						} ?>
								
							</select>
						</div>
						<div class="col-lg-2"><label>Futár:</label>
							<select name="futar">
								<option value="0">nincs</option>
			<?					for ($fut = 0; $fut <= count($_SESSION['futar'])-1; $fut++) {
  							  if($_SESSION['futar'][$fut]['nev'] !=""){
  							  echo "<option value='".$_SESSION['futar'][$fut]['id']."'>".$_SESSION['futar'][$fut]['nev']."</option>";
					}
						} ?>
								
							</select>
						</div>
						<div class="col-lg-4">
									<div class="btn btn-primary" onclick="data_list();">szürés</div>
								  <input   type="submit" class="btn btn-warning" value="PDF nyomtatás">
				</div>
				</div>
			</div>
						
				
					</form>
					
					
					</div>
						<p></p>
					<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Kimutatások</div>
					<div class="panel-body">
						<ul class="todo-list">
		<?
		
		
		
		
			 	 if(isset($_GET['over_statusz'])){
 		$id =	$_GET['over_statusz'];
 		$statusz =	$_GET['statusz'];
 	 	$sql ="UPDATE `kuldemeny` SET `over_statusz` = '$statusz' WHERE `pid` =$id";
 	 				if (!mysql_query($sql,$con))
	  {
 			 die('Error:  ' . mysql_error());

 	 	}
 	}
		
		

		
						

		
		?><div id="munka_list">
		<?	include('data_list_proc.php'); ?>
				</div>
						</ul>
							</div>
			
							<div class="panel-footer">
						<div class="input-group">
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