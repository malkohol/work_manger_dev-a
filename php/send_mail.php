<?	
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=utf-8";
$headers[] = "From: ASAP Futarszolgalat <asap@dataplace.hu>";
$headers[] = "Reply-To: ASAP Futarszolgalat<asap@dataplace.hu>";


mail($email, $subject, $mail,implode("\r\n", $headers) ); 
 echo  "<script>alert('Értesités elküldve')</script>";         
          ?>