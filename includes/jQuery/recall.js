$(document).ready(function(){
    $("form#recall_form input[name='submit_now']").click(function(e) {

		var recall_reason=document.getElementById("recall_reason").value;
		
		/* simple alert validation */
		if(recall_reason.trim().length < 1){
		alert("Reason is required!");
		return false;
        }
		/* simple alert validation end */

		/* ajax process */

		/* option1: get data manually */
		//var datastring = 'name='+ name +'&message=+ message';

		/* option 2:  get data automatically */
		var datastring = $("form#recall_form").serialize();

		$("span.ajax_loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/ajax-text-loader.gif" />'); // loading...
		$("form#recall_form input[name='submit_now']").attr('disabled', true); // disable the submit button
		jQuery.ajax({
				type: "POST",
				url: "http://wmsonline.aai.com.ph/les/includes/ajax/unpost.php",
				data: datastring,
				success: function(responseTxt) { // if no errors
                alert("Recalled!");
				document.getElementById("inputError").innerHTML="<span id='inputError' style='color:green'><b>Recalled!</b></span>";
				HideDialog();
				document.getElementById("status").value="Active";
				$("#save").removeAttr("disabled");
				$("#post").removeAttr("disabled");
				$("#delete_jo_numb").removeAttr("disabled");
				$("#add").removeAttr("disabled");
				$("#delete").removeAttr("disabled");
				$("#get_pcv_cost").removeAttr("disabled");
				$(".hidable_column").show();
				$("form#recall_form input[name='submit_now']").attr('disabled', false); // enable the submit button
				},
				timeout: 15000, // timeout if 15 secs
				error: function(jqXHR, textStatus, errorThrown) { // connection error handler
					switch(textStatus) {
						case "timeout": // connection timeout handler
							alert('Connection Timeout, Please Try Later');
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> Connection Timeout, Please Try Later.');
							$("form#recall_form input[name='submit_now']").attr('disabled', false);
						break;
						case "error":
							alert('Connection Error'); // connection 404 handler
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> Connection Error.');
							$("form#recall_form input[name='submit_now']").attr('disabled', false);
						break;
						default:
							//alert(textStatus);
							//$("span.ajax_loader").html('<img alt="" src="img/invalid.png" /> ' + textStatus);
							$("form#recall_form input[name='submit_now']").attr('disabled', false);
						}
				}
		}); // ajax end
	e.preventDefault();
	}); // click end

        $("#recall").click(function(){
        $("#recall_type").val('RECALL');    
        });
        
        $("#force_to_recall").click(function(){
        $("#recall_type").val('FORCE RECALL');    
        });
});

