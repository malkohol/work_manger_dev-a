<? if(empty($_SESSION['local'])) {
session_start();

	
	$local = $_SESSION['local'];
	$root = $_SESSION['root'];
}else{
	$root = $_SESSION['root'];
	$local = $_SESSION['local'];
	} 
if(empty($_SESSION['s_date'])){
$_SESSION['s_date'] = date("Y-m-d");
$_SESSION['e_date'] =date('Y-m-d');
}else{
$today = $_SESSION['s_date'];
$end_date = $_SESSION['e_date'];
}	
include('php/site_info.php');
	
	?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>
  <style> 
#ask_panel{
    position:fixed;
   	top:20px;
    margin: auto;
    width: 50%;

    padding: 10px;	
		z-index:20;
	}	
	.hidden{
		display:hidden;
		}
		
		
</style>

 <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/styles.css" rel="stylesheet">
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyB5EsNZ5DKZcsY_iI6pCkz4rzsmovYjxFc"></script>		

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>


<?

 include('script/conn.php'); 
$name = "";
if(isset($_GET['logout'])){
	$_SESSION['login'] = 0;
	session_destroy();
			}

if(empty($_SESSION['login'])){
		$_SESSION['login'] = 0;
		}

if(isset($_POST['email']) && isset($_POST['password'])){

	$user = $_POST["email"];
	$pass = MD5($_POST["password"]);
		$count_u = 1;
		$sql_sub_szoveg ="SELECT * FROM `user` WHERE `name` LIKE '$user' AND `pass` LIKE '$pass'"; 
    $result_sub_szoveg = mysql_query($sql_sub_szoveg);
    while($sub_szoveg_menu = mysql_fetch_array($result_sub_szoveg)){
    $name =	$sub_szoveg_menu['name'];
    }
  
if($name ==""){
$_SESSION['login'] = 0;	
}else{
$_SESSION['login'] = 1;		
	}

}
		unset($_SESSION['futar']);
		$_SESSION['futar'][0]['id'] =0;
		$_SESSION['futar'][0]['nev'] = "nincs megadva";
		$count_futar = 1;
		$sql_futar ="SELECT * FROM `user` ";
		$result_futar = mysql_query($sql_futar);
		while($futar_list = mysql_fetch_array($result_futar)){ 
		$_SESSION['futar'][$count_futar]['id'] = $futar_list['user_id'];
		$_SESSION['futar'][$count_futar]['nev'] = $futar_list['teljes_nev'];
		$count_futar++;
		}

	
		unset($_SESSION['ugyfel']);
		$count_ugyfel = 0;
		$sql_ugyfel ="SELECT * FROM `ugyfel` order by nev asc";
		$result_ugyfel = mysql_query($sql_ugyfel);
		while($ugyfel_list = mysql_fetch_array($result_ugyfel)){ 
		$_SESSION['ugyfel'][$count_ugyfel]['id'] =$ugyfel_list['ugyfel_id'];
		$_SESSION['ugyfel'][$count_ugyfel]['nev'] = $ugyfel_list['nev'];
		$count_ugyfel++;
		}

		unset($_SESSION['cimlista']);
		$count_cimlista = 0;
		$sql_cimlista ="SELECT * FROM `cim_lista` where partner_id =0 ";
		$result_cimlista = mysql_query($sql_cimlista);
		while($cimlista_li = mysql_fetch_array($result_cimlista)){ 
		$_SESSION['cimlista'][$count_cimlista]['id'] =$cimlista_li['id'];
		$_SESSION['cimlista'][$count_cimlista]['nev'] = $cimlista_li['nev'];
		$_SESSION['cimlista'][$count_cimlista]['kapcsolat'] = $cimlista_li['kapcsolat'];
		$_SESSION['cimlista'][$count_cimlista]['kapcsolat_tel'] = $cimlista_li['kapcsolat_tel'];
		$count_cimlista++;
		}

$_SESSION['fizetes'][0] = "készpénz";
$_SESSION['fizetes'][1] = "utalás";

	
$_SESSION['mail_user'][0] = "ügyfél";
$_SESSION['mail_user'][1] = "marketing";
$_SESSION['mail_user'][2] = "egyébb";	

$_SESSION['user'][0] = "futár";
$_SESSION['user'][1] = "diszpécser";
$_SESSION['user'][2] = "admin";	
 ?>
<body>
	<?  echo $_SESSION['login']; ?>
<? if($_SESSION["login"] == 1){ ?>
	
	<div id="ask_panel"></div>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>ASAP </span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <? echo $name  ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="<? echo $_SESSION['local_a'] ?>index.php?logout=1"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<ul class="nav menu">
			<li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Föoldal</a></li>
			<li><a href="<? echo $local ?>user_list.html"><svg class="glyph stroked male-use"><use xlink:href="#stroked-male-user"></use></svg> Felhasználok</a></li>
			<li><a href="<? echo $local ?>munka_list.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Munka követés</a></li>
			<li><a href="<? echo $local ?>data.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Kimutatások</a></li>
			<li><a href="<? echo $local ?>partner.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Ugyfelek</a></li>
			<li><a href="<? echo $local ?>cim_list.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Cimek</a></li>
			<li><a href="<? echo $local ?>hirlevel.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Hírlevélküldés</a></li>


			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			

		

		
	
		


								
		<div class="row">
	
			
			<div class="">
			

						<div id="munka_list_box">
			
				<?	
		
				if(isset($_GET['content'])){
					 $content = $_GET['content'];
				if($content == "user_list"){
						include('php/user_list.php');
					}
				if($content == "munka_list"){
						include('php/munka_list.php');
					}
					if($content == "data"){
						include('php/data_list.php');
					}
					if($content == "partner"){
						include('php/partner_list.php');
					}
						if($content == "cim_list"){
						include('php/cim_list.php');
					}
					
					
						if($content == "hirlevel"){
							include('php/mailer/mail_list.php');
						}
						
							if($content == "sablon"){
							include('php/mailer/create_sablon.php');
						}
				}else{
		
				include('php/munka_list.php');
				}
				
				 ?>
				
			
		
					</div>

					
				</div>
							<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body" id="modal-body">
     
        </div>
     
      </div>
      
    </div>
  </div>	
			</div><!--/.col-->
		</div><!--/.row-->


  <script>
$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
<? }else{ ?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form id="login" action="index.php" method="post" role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control"   placeholder="E-mail" name="email" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<input  type="submit" value="Submit" class="btn btn-primary"/>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
		<?}?>			
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>


		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
