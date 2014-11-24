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
	<div id="wrapper">
<b class="module">Edit</b>
<form method="post" id="form">
<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
    <div class="form-group">
    </div>
    <div class="form-group">
    <body>
<fieldset style="float:left;">
<legend>Edit Value</legend>
<div><label class="field">Edit</label> <input type="text" name="doc_ref" value="<?php echo @$doc_ref; ?>" class="input" id="doc_ref" /> </div>
<input type="submit" class="btn btn-danger css_button btn-xs" name="Save" value="Save" /> &nbsp; 
<a href="home.php"><input type="submit" class="btn btn-danger css_button btn-xs" name="Save" value="Back" /> &nbsp; 
</fieldset>

<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
