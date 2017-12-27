<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];
 
    // get a product from products table
    $result = mysql_query("SELECT *FROM kuldemeny WHERE pid = $pid ");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $product = array();
        $product["pid"] = $result["pid"];
        $felvetel = $result["csomag_felvetel"];
        $felvetel_var = explode("&", $felvetel);
        
        $product["f_ceg_var"] = $felvetel_var[0];
        $product["f_cim_var"] = $felvetel_var[1];
        $product["f_kap_var"] = $felvetel_var[2];
        $product["f_kap_tel_var"] = $felvetel_var[3];
        $product["f_coord"] = $felvetel_var[4];
        
        $csomag_cel = $result["csomag_cel"];
        $csomag_cel_var = explode("&", $csomag_cel);
        $product["c_ceg_var"] = $csomag_cel_var[0];
        $product["c_cim_var"] = $csomag_cel_var[1];
        $product["c_kap_var"] = $csomag_cel_var[2];
        $product["c_kap_tel_var"] = $csomag_cel_var[3];
        $product["c_coord"] = $csomag_cel_var[4];
        
        $szam_cim = $result["szam_cim"];
        $szam_cim_var = explode("&", $szam_cim);
        
        $product["r_ceg_var"] = $szam_cim_var[0];
        $product["r_cim_var"] = $szam_cim_var[1];
        $product["r_kap_var"] = $szam_cim_var[2];
        $product["r_kap_tel_var"] = $szam_cim_var[3];
        $product["r_coord"] = $szam_cim_var[4];
        
        
        
       	$csomag_adat = $result["csomag_adat"];
        $csomag_adat_var = explode("&", $csomag_adat);
       
       	$product["szolg_dij"] = $csomag_adat_var[0];
        $product["kuldemeny"] = $csomag_adat_var[1];
        $product["darab"] = $csomag_adat_var[2];
        $product["utanvet"] = $csomag_adat_var[3];
        $product["fiz_var"] = $result["fizetes"];
        $product["futar"] = $result["futar"];
        $product["description"] = $result["description"];
        $product["szallitas"] = $result["szallitas"];
        $product["start_date"] = $result["start_date"];
        $product["munkaszam"] = $result["munkaszam"];
        $product["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["product"] = array();
 
            array_push($response["product"], $product);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>