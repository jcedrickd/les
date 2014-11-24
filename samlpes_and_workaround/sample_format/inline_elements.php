<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">
	
        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
        
        <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
       
    </head>
    <body>
<div id="wrapper">
<b class="module">PCV Entry New</b>
<span id="inputError"><?php //include 'logic.php'; show errors here! ?></span>
<form method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
    <div class="form-group">
        <input type="submit" class="btn btn-danger css_button btn-xs" name="save" onClick="return wf_check();" value="Save" <?php //echo @$save_disabled; ?> id="save" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_or_post" onClick="" value="Print/Post" <?php //echo @$print_or_post_disabled; ?> id="print_or_post" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs  <?php //echo @$access_post; ?>" name="post" onClick="return wf_check();" value="Post" <?php //echo @$post_disabled; ?>  id="post" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs <?php //echo @$access_unpost; ?>" name="unpost" value="Unpost" onClick="unpost_pcv(pcv_no.value);" <?php //echo @$unpost_disabled; ?> id="unpost" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="re_print" onClick="" value="Re-print" <?php //echo @$re_print_disabled; ?>  id="re_print" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs <?php //echo @$access_cancel; ?>" name="cancel" value="Cancel" onClick="cancel_pcv(pcv_no.value);" <?php //echo @$cancel_disabled; ?>  id="cancel" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="reset" onClick="" value="Reset" id="reset" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="remove_fn" onClick="" value="Remove FN" id="remove_fn" <?php //echo @$remove_fn_disabled; ?>  />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_force_post; ?>" name="force_post" onClick="" value="Force Post" id="force_post" <?php //echo @$force_post_disabled; ?> />
    </div>
</div>

<div class="form-inline col-xs-12">
    <div class="form-group">
<input type="text" name="pcv_numb_search" class="input-xs input" value="<?php //echo @$pcv_numb_search; ?>" placeholder="PCV No." id="pcv_numb_search" autocomplete="off" onKeyUp="search_pcv(this.value);" onFocus="search_pcv(this.value);" onInput="this.value=this.value.toUpperCase();" />
<input type="button" class="btn btn-search btn-xs" onClick="open_pcv_list();return false;" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_jli_aai" onClick="" value="Print JLI-AAI" <?php //echo @$print_jli_aai_disabled; ?> id="print_jli_aai" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_pcv_per_jo" onClick="" value="Print PCV per JO" <?php //echo @$print_pcv_per_jo_disabled; ?> id="print_pcv_per_jo" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_validate; ?>" name="validate" onClick="return wf_check_validate2(validate_by.value,type_by.value,'inputError');" value="Validate" <?php //echo @$validate_disabled; ?>  id="validate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_unvalidate; ?>" name="unvalidate" onClick="" value="Unvalidate" <?php //echo @$unvalidate_disabled; ?>  id="unvalidate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="force_validate" onClick="" value="Force Validate" <?php //echo @$force_validate_disabled; ?> id="force_validate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_insert; ?>" name="add_jo" onClick="return open_jo_list();" value="Add Job Order" <?php //echo @$add_jo_disabled; ?> id="add_jo" />

    </div>
	<div class="form-group">
<input type="text" name="jo_numb_search" value="" class="input-xs input" value="<?php //echo @$jo_numb_search; ?>" placeholder="Search" id="jo_numb_search" onFocus="search_jo(this.value);return false;" onKeyup="search_jo(this.value);return false;" autocomplete="off" onInput="this.value=this.value.toUpperCase();" />
<!--input type="button" class="btn btn-search btn-xs" onClick="search_jo(this.value);return false;" /-->
    </div>
</div>

<!--form here! NOTE: look on form.php-->
</form>    
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
