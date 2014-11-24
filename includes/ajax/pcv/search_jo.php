<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
$jo_numb=  validate_input(strtoupper($_GET['jo_numb']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$result=sybase_query("SELECT mawbno,hawbno,trucking_dr FROM oth_services WHERE jo_numb='$jo_numb'");
    if(sybase_num_rows($result) == 1){
    $jo=  sybase_fetch_array($result);
?>
<div><label class="field">MAWB/MBL:</label> <input type="text" name="mcarref" value="<?php echo $jo['mawbno']; ?>" maxlength="20" class="input" id="mcarref" readonly="readonly" /> </div>
<div><label class="field">HAWB/HBL:</label> <input type="text" name="hcarref" value="<?php echo $jo['hawbno']; ?>" maxlength="20" class="input" id="hcarref" readonly="readonly" /></div>
<div><label class="field">DR No.:</label> <input type="text" name="dr_no" value="<?php echo $jo['trucking_dr']; ?>" maxlength="20" class="input" id="dr_no" readonly="readonly" /></div>    
<?php        
    }else{
?>
<div><label class="field">MAWB/MBL:</label> <input type="text" name="mcarref" value="" maxlength="20" class="input" id="mcarref" readonly="readonly" /> </div>
<div><label class="field">HAWB/HBL:</label> <input type="text" name="hcarref" value="" maxlength="20" class="input" id="hcarref" readonly="readonly" /></div>
<div><label class="field">DR No.:</label> <input type="text" name="dr_no" value="" maxlength="20" class="input" id="dr_no" readonly="readonly" /></div>    
<?php
    }
sybase_free_result($result);
sybase_close($link);
?>
