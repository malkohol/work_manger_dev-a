	<?	
	


include ('script/conn.php');

	
	$oldal ="";
	$lang ="";

	if(empty($lang)){
		$lang = "hun";
		}
		
			$sql_site ="SELECT * FROM `site_head`"; 
  		 $result_site = mysql_query($sql_site);
    
  	  while($menu_site = mysql_fetch_array($result_site)){
  	
		$menu_site_id  = $menu_site['id'];
		$site_nev  = $menu_site[$lang.'_name'];
		$local  = $menu_site['local'];
		$site_title  = $menu_site[$lang.'_title'];
		$site_key  = $menu_site[$lang.'_key'];
		$site_desc  = $menu_site[$lang.'_desc'];
		$site_welcome  = $menu_site[$lang.'_welc'];
		$site_root  = $menu_site['doc_root'];
		$hun_welcome  = $menu_site[$lang.'_welcome'];
		$hun_imp  = $menu_site[$lang.'_imp'];
		unset($_SESSION['local']);
		unset($_SESSION['root']);
		$_SESSION['local'] = 	$local;
		$root =  "/var/userdata/web/dataplace.hu/website/workdev/";
		$_SESSION['root'] = 	$root;

		
}




	?>
	
	