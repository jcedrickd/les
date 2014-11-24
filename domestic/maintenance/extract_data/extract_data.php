<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- css of bootstrap-->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">
	
    <!-- css for forms-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />	
	
    <!-- jQuery library -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	
	<!-- css for table-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
	
	<!-- jQuery hover table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
	
    <!-- jQuery highlight table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>

    <!--javascript datepicker -->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/date_picker.js"></script>

<script>
</script>
</head>

<body>		
<div id="wrapper">
<b class="module">Extract Data</b>
<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="Extract" onclick="" value="Extract" />
	</div><!--div class="form-group"-->
</div><!--div class="form-inline col-xs-12 inline_elements"-->
<div style="height:25px;width:inherit;"> </div><br/>
<div style="float:left;">
<fieldset style="float:left;">
<div><label class="field">Option:</label> <select name="productiondesc" class="input"><option>--</option><option>HAWB Production</option><option>HBL Production</option><option>MAWB Production</option></select></div>
<div><label class="field">From:</label> <input type="text" class="input datepicker" name="ProductionFrom" value="<?php echo date("m/d/Y")?>"/></div>
<div><label class="field">To:</label> <input type="text" class="input datepicker" name="ProductionTo" value="<?php echo date("m/d/Y")?>"/></div>
	</fieldset><br/>
	<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
</thead>
<tbody>
</tbody>
<!--tfoot><tr><td colspan="13"><div id="paging"><ul>
	<li><a href="#"><span>Previous</span></a></li>
	<li><a href="#" class="active"><span>1</span></a></li>
	<li><a href="#"><span>2</span></a></li>
	<li><a href="#"><span>3</span></a></li>
	<li><a href="#"><span>4</span></a></li>
	<li><a href="#"><span>5</span></a></li>
	<li><a href="#"><span>Next</span></a></li>
</ul></div></tr></tfoot-->
</table>
<p></p>
</div>
</form>
</div>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</body>
</html>