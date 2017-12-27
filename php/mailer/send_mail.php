<?	
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=utf-8";
$headers[] = "From: Autoszervizek App <info@autoszervizekapp.hu>";
$headers[] = "Reply-To: Autoszervizek App <info@autoszervizekapp.hu>";


mail($email, $subject, $mail,implode("\r\n", $headers) ); 
          
          ?>