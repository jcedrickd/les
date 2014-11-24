$(document).ready(function(){
		$('#csr').autocomplete({
			      	source: function( request, response ) {
			      		$.ajax({
			      			url : 'http://wmsonline.aai.com.ph/les/includes/ajax/validation/validate_attached_csr.php',
			      			dataType: "json",
							data: {
							   csr_value: request.term,
							   type: 'attached_csr',
							   row_num : 1
							},
							 success: function( data ) {
								 response( $.map( data, function( item ) {
								 	var code = item.split("|");
									return {
										label: code[0],
										value: code[0],
										data : item
									}
								}));
							}
			      		});
			      	},
			      	autoFocus: true,
			      	minLength: 20,
			      	focus: function( event, ui ) {
						var names = ui.item.data.split("|");
						console.log(names[1]);				
						//$('#csr_level').val(names[1]);
						//var csr_level=document.getElementById("csr_level").value;
						var csr_level=names[1];
							if(csr_level == 0){
							document.getElementById("inputError").innerHTML="<span id='inputError'><b>Error: CSR "+document.getElementById("csr").value+" not found</b></span>";
							}else if(csr_level == 1){
							document.getElementById("inputError").innerHTML="<span id='inputError'></span>";
							search_csr(csr.value);
							}else if(csr_level == 2){
							document.getElementById("inputError").innerHTML="<span id='inputError'></span>";
							check_attached_csr(csr.value);
							}	
					}		      	
			      });
});