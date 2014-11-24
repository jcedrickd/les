<?php
function redirect($url){
    if (!headers_sent()){    
        header('location:'.$url);
        exit;
        }
    else{  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function validate_input($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
$data = pg_escape_string($data);  
return $data;
}
?>