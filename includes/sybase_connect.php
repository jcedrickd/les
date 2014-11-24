<?php
//$link=odbc_connect("Driver={Adaptive Server Anywhere 7.0};Server=192.168.2.52;Database=wms_barcode;", "dba", "sql");

	@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
		@$db = @sybase_select_db("dbcentral");

	/*if ($link) {
		echo "Sybase Connection Successful";
	}
	else {
		echo "Sybase Connection Failed";
	}*/
        //sybase_close($link);
?>
