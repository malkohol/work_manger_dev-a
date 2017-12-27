
<?php
 
/*
 * Following code will delete a product from table
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
if (isset($_POST['pid']))  {
 
    $pid = $_POST['pid'];
    $phase = $_POST['phase'];

		$today = date("Y-m-d H:i:s"); 
		if($phase == 3){
			$phase_var = "updated_at";
			}
if($phase == 1){
			$phase_var = "end_date";
			}
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
		 $today = date("Y-m-d H:i:s"); 
    // mysql update row with matched pid
    $result = mysql_query("UPDATE kuldemeny SET szallitas ='$phase' ,  $phase_var = '$today'  WHERE pid = $pid");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>