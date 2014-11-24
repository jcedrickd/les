function delete_jo_numb(jo_numb,foreign_recno_dbid,url){
    if (confirm("Are you sure you want to delete? " +jo_numb) == true) {
        $(document).ready(function(){
            jQuery.ajax({
				type: "POST",
				url: "http://wmsonline.aai.com.ph/les/includes/ajax/delete_jo_numb.php",
				data: foreign_recno_dbid,
				success: function(responseTxt) { // if no errors
                                alert(jo_numb+" has been deleted");
                                window.location.href=url;
                                },
				timeout: 15000, // timeout if 15 secs
				error: function(jqXHR, textStatus, errorThrown) { // connection error handler
					switch(textStatus) {
						case "timeout": // connection timeout handler
							alert('Connection Timeout, Please Try Later');
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> Connection Timeout, Please Try Later.');
							//$("form#recall_form input[name='submit_now']").attr('disabled', false);
						break;
						case "error":
							alert('Connection Error'); // connection 404 handler
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> Connection Error.');
							//$("form#recall_form input[name='submit_now']").attr('disabled', false);
						break;
						default:
							//alert(textStatus);
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> ' + textStatus);
							//$("form#recall_form input[name='submit_now']").attr('disabled', false);
						}
				}
			}); // ajax end
        });
    }
}