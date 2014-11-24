function disable_buttons(status){
var s=document.getElementById(status).value.trim();
	if(s == "Posted"){
	document.getElementById('save').setAttribute("disabled","disabled");
	document.getElementById("recall").removeAttribute("disabled");
    document.getElementById('post').setAttribute("disabled","disabled");
	document.getElementById("print").removeAttribute("disabled");
	document.getElementById("cancel").removeAttribute("disabled");
	document.getElementById("force_to_recall").removeAttribute("disabled");
	document.getElementById('delete_jo_numb').setAttribute("disabled","disabled");
	document.getElementById('add').setAttribute("disabled","disabled");
	document.getElementById('delete').setAttribute("disabled","disabled");
	document.getElementById('get_pcv_cost').setAttribute("disabled","disabled");
	$(".hidable_column").hide();
	}
    
	if(s == "Cancel"){
	document.getElementById('save').setAttribute("disabled","disabled");
    document.getElementById('recall').setAttribute("disabled","disabled");
    document.getElementById('post').setAttribute("disabled","disabled");
	document.getElementById('print').setAttribute("disabled","disabled");
    document.getElementById('cancel').setAttribute("disabled","disabled");
    document.getElementById('force_to_recall').setAttribute("disabled","disabled");
    document.getElementById('delete_jo_numb').setAttribute("disabled","disabled");
	document.getElementById('add').setAttribute("disabled","disabled");
	document.getElementById('delete').setAttribute("disabled","disabled");
	document.getElementById('get_pcv_cost').setAttribute("disabled","disabled");
	$(".hidable_column").hide();
	}
	
	if(s == "Active"){
	document.getElementById('save').removeAttribute("disabled");
	document.getElementById("recall").removeAttribute("disabled");
    document.getElementById('post').removeAttribute("disabled");
	document.getElementById("print").removeAttribute("disabled");
	document.getElementById("cancel").removeAttribute("disabled");
	document.getElementById("force_to_recall").removeAttribute("disabled");
	document.getElementById('delete_jo_numb').removeAttribute("disabled");
	document.getElementById('add').removeAttribute("disabled");
	document.getElementById('delete').removeAttribute("disabled");
	document.getElementById('get_pcv_cost').removeAttribute("disabled");
	$(".hidable_column").show();
	}
}