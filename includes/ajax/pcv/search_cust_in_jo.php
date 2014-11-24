<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$jo_numb=validate_input(strtoupper($_GET['jo_numb']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=  sybase_query("SELECT c_code,client FROM oth_services WHERE jo_numb='$jo_numb'");
$jo=sybase_fetch_array($query1);
?>
<div><label class="field">Customer:</label> <input type="text" name="cust_code" value="<?php echo @$jo['c_code']; ?>" maxlength="15" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="cust_code" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('cust_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <input type="text" name="cust_name" value="<?php echo $jo['client']; ?>" maxlength="50" class="input bigtxt" readonly="readonly" id="cust_name" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address">
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql = "SELECT partners.customer.address,partners.customer.city,partners.customer.state_province,partners.customer.zipcode,public.country.country_desc 
FROM partners.customer LEFT OUTER JOIN public.country ON partners.customer.country_code = public.country.country_code 
WHERE partners.customer.aaigoc_code='$jo[c_code]'";
$result = pg_query($con,$sql) or die("Cannot execute query: $sql\n");
$address = pg_fetch_array($result);
echo @$address['address'].', '.@$address['city'].' '.@$address['state_province'].' '.@$address['country_desc'].' '.@$address['zipcode']; 
pg_free_result($result);
pg_close($con);
?>
</textarea>
</div>
<?php 
sybase_free_result($query1);
sybase_close($link);
?>