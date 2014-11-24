function convert_usd_php(exrate_id,php_id,usd_id){
var php=document.getElementById(usd_id).value * document.getElementById(exrate_id).value;    
document.getElementById(php_id).value=php;
}