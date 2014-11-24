$(document).ready(function(){
		$('#pcv_numb_search').autocomplete({
			      	source: function( request, response ) {
			      		$.ajax({
			      			url : 'http://wmsonline.aai.com.ph/les/includes/ajax/pcv/pcv_hdr.php',
			      			dataType: "json",
							data: {
							   pcv_numb_search: request.term,
							   type: 'pcv_entry',
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
			      	minLength: 11,
			      	focus: function( event, ui ) {
						var names = ui.item.data.split("|");
						console.log(names[1],names[2],names[3],names[4],names[5],names[6],names[7],names[8],names[9],names[10],names[11],names[12],names[13],names[14],names[15],names[16],
						names[17],names[18],names[19],names[20],names[21],names[22],names[23],names[24],names[25],names[26],names[27],names[28],names[29],names[30],names[31],names[32],
                                                names[33],names[34],names[35],names[36],names[37],names[38],names[39],names[40]);						
						//$('#jo_numb_search').val(names[15]);
						//$('#csr').val(names[33]);
						//$('#c_code').val(names[1]);
						$('#payee_code').val(names[2]);
						$('#payee_name').val(names[3]);
						$('#cust_code').val(names[4]);
						$('#cust_name').val(names[5]);
						$('#service_type').val(names[6]);
						$('#transmit_no').val(names[7]);
						$('#fin_transmit_no').val(names[8]);
						$('#petty_cash_replenish').val(names[9]);
						$('#tot_cash').val(names[10]);
						$('#tot_cheque').val(names[11]);
						$('#grand_total').val(names[12]);
						$('#job_order_no').val(names[13]);
						$('#mcarref').val(names[14]);
						$('#hcarref').val(names[15]);
                                                $('#dr_no').val(names[16]);
						$('#shipper_code').val(names[17]);
						$('#shipper_name').val(names[18]);
						$('#pcv_stat').val(names[19]);
						$('#pcv_type').val(names[20]);
						$('#pcv_date').val(names[21]);
						$('#bill_no').val(names[22]);
						$('#miscellaneous_pcv').val(names[23]);
						$('#type_by').val(names[24]);
						$('#validate_by').val(names[25]);
						$('#verified_by').val(names[26]);
						$('#approved_by').val(names[26]);
						$('#station_id').val(names[27]);
						$('#tot_rcpt_cost').val(names[28]);
						$('#tot_urcpt_cost').val(names[29]);
						$('#arrival_date').val(names[30]);
						$('#commodity').val(names[31]);
						$('#rcv_by').val(names[32]);
                                                $('#act_wt').val(names[33]);
                                                $('#chg_wt').val(names[34]);
                                                $('#nopcs').val(names[35]);
                                                $('#exrate').val(names[36]);
                                                $('#other_ref').val(names[37]);
                                                $('#instruction').val(names[38]);
                                                $('#release_type').val(names[39]);
                                                $('#fd_bd').val(names[40]);
						//showBookingCharges(foreign_recno_dbid.value);
						//showCustAddress(c_code.value);
					}		      	
			      });
});