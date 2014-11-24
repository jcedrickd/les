$(document).ready(function(){
		$('#jo_numb_search').autocomplete({
			      	source: function( request, response ) {
			      		$.ajax({
			      			url : 'http://wmsonline.aai.com.ph/les/includes/ajax/oth_services.php',
			      			dataType: "json",
							data: {
							   jo_numb_search: request.term,
							   type: 'oth_services',
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
			      	minLength: 9,
			      	focus: function( event, ui ) {
						var names = ui.item.data.split("|");
						console.log(names[1],names[2],names[3],names[4],names[5],names[6],names[7],names[8],names[9],names[10],names[11],names[12],names[13],names[14],names[15],names[16],
						names[17],names[18],names[19],names[20],names[21],names[22],names[23],names[24],names[25],names[26],names[27],names[28],names[29],names[30],names[31],names[32],names[33]);						
						//$('#jo_numb_search').val(names[15]);
						$('#csr').val(names[33]);
						$('#c_code').val(names[1]);
						$('#client').val(names[2]);
						$('#doc_type').val(names[3]);
						$('#doc_ref').val(names[4]);
						$('#hawbno').val(names[5]);
						$('#mawbno').val(names[6]);
						$('#oth_reference').val(names[7]);
						$('#item_description').val(names[8]);
						$('#agent_code').val(names[9]);
						$('#agent_name').val(names[10]);
						$('#exrate').val(names[11]);
						$('#qnty').val(names[12]);
						$('#wt').val(names[13]);
						$('#cbm').val(names[14]);
						$('#jo_numb').val(names[15]);
							switch(names[16]){
							case 'C':
							$('#status').val('Cancel');
							break;
							case 'A':
							$('#status').val('Active');
							break;
							case 'X':
							$('#status').val('Posted');
							break;
							default: $('#status').val('');
							}
						$('#trans_type').val(names[17]);
							switch(names[18]){
							case 'OS':
							$('#service_type').val('Other Services');
							break;
							case 'OT':
							$('#service_type').val('Wrong Other Services');
							break;
							default: $('#service_type').val('');
							}
						$('#transaction_date').val(names[19]);
						$('#bill_to_dept').val(names[20]);
						$('#total_charges').val(names[21]);
						$('#bill_no').val(names[22]);
						$('#prepared_by').val(names[23]);
						$('#prepared_datetime').val(names[24]);
						$('#transmit_no').val(names[25]);
						$('#transmit_date').val(names[26]);
						$('#transmit_time').val(names[26]);
						$('#transmit_by').val(names[27]);
						$('#trucking_from').val(names[28]);
						$('#trucking_to').val(names[29]);
						$('#trucking_dr').val(names[30]);
						$('#instructions').val(names[31]);
						$('#foreign_recno_dbid').val(names[32]);
						showBookingCharges(foreign_recno_dbid.value);
						showCustAddress(c_code.value);
					}		      	
			      });
});