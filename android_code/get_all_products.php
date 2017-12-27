<?php

/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
$user_id = $_GET['user_id']; 
// connecting to db
$db = new DB_CONNECT();
 mysql_query("SET NAMES utf8", $db);
// get all products from products table
$dt1 = new DateTime();
$today = $dt1->format("Y-m-d");
$result = mysql_query("SELECT *FROM kuldemeny where futar = '$user_id' and start_date = '$today' order by pid DESC") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["pid"] = $row["pid"];
        $product["szallitas"] = $row["szallitas"];
        $felvetel = $row["csomag_felvetel"];
        $felvetel_var = explode("&", $felvetel);
        
        $product["f_ceg_var"] = $felvetel_var[0];
        $product["f_cim_var"] = $felvetel_var[1];
        $product["f_kap_var"] = $felvetel_var[2];
        $product["f_kap_tel_var"] = $felvetel_var[3];
        
        $csomag_cel = $row["csomag_cel"];
        $csomag_cel_var = explode("&", $csomag_cel);
        $product["c_ceg_var"] = $csomag_cel_var[0];
        $product["c_cim_var"] = $csomag_cel_var[1];
        $product["c_kap_var"] = $csomag_cel_var[2];
        $product["c_kap_tel_var"] = $csomag_cel_var[3];
        
       	$csomag_adat = $row["csomag_adat"];
        $csomag_cel_var = explode("&", $csomag_adat);
       
       	$product["szolg_dij"] = $csomag_adat[0];
        $product["kuldemeny"] = $csomag_adat[1];
        $product["darab"] = $csomag_adat[2];
        $product["utanvet"] = $csomag_adat[3];
       
        $product["futar"] = $row["futar"];
        $product["start_date"] = $row["start_date"];
        $product["updated_at"] = $row["updated_at"];
 
        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
    
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>