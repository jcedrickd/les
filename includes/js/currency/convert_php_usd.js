function convert_php_usd(exrate_id,php_id,usd_id){
var usd=document.getElementById(php_id).value * document.getElementById(exrate_id).value;    
document.getElementById(usd_id).value=usd;
}