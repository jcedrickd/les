<?php
$host = "192.168.2.52"; 
$user = "postgres"; 
$pass = "javasr"; 
$db = "AAIGOC"; 

$con=pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n"); 
?>
