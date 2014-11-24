function disable_buttons(pcv_stat,validate_stat){
var s=document.getElementById(pcv_stat).value.trim();
var t=document.getElementById(validate_stat).value.trim();
	if(s == "Posted" && (t=="" || t=="No")){
	document.getElementById('save').setAttribute("disabled","disabled");
	document.getElementById('print_or_post').setAttribute("disabled","disabled");
	document.getElementById('post').setAttribute("disabled","disabled");
	document.getElementById("unpost").removeAttribute("disabled");
        document.getElementById("re_print").removeAttribute("disabled");
        document.getElementById("cancel").removeAttribute("disabled");
        document.getElementById('remove_fn').setAttribute("disabled","disabled");
	document.getElementById('force_post').setAttribute("disabled","disabled");
        document.getElementById('print_jli_aai').setAttribute("disabled","disabled");
	document.getElementById("print_pcv_per_jo").removeAttribute("disabled");
        document.getElementById("validate").removeAttribute("disabled");
        document.getElementById('unvalidate').setAttribute("disabled","disabled");
        document.getElementById("force_validate").removeAttribute("disabled");
        document.getElementById("add_jo").removeAttribute("disabled");
        document.getElementById('add').setAttribute("disabled","disabled");
        document.getElementById('delete').setAttribute("disabled","disabled");
        document.getElementById('view_tariff').setAttribute("disabled","disabled");
	$(".hidable_column").hide();
	}
        
        if(s == "Posted" && t=="Validated"){
	document.getElementById('save').setAttribute("disabled","disabled");
	document.getElementById('print_or_post').setAttribute("disabled","disabled");
	document.getElementById('post').setAttribute("disabled","disabled");
	document.getElementById("unpost").setAttribute("disabled","disabled");
        document.getElementById("re_print").removeAttribute("disabled");
        document.getElementById("cancel").setAttribute("disabled","disabled");
        document.getElementById('remove_fn').removeAttribute("disabled");
	document.getElementById('force_post').setAttribute("disabled","disabled");
        document.getElementById('print_jli_aai').setAttribute("disabled","disabled");
	document.getElementById("print_pcv_per_jo").removeAttribute("disabled");
        document.getElementById("validate").setAttribute("disabled","disabled");
        document.getElementById('unvalidate').setAttribute("disabled","disabled");
        document.getElementById("force_validate").setAttribute("disabled","disabled");
        document.getElementById("add_jo").removeAttribute("disabled");
        document.getElementById('add').setAttribute("disabled","disabled");
        document.getElementById('delete').setAttribute("disabled","disabled");
        document.getElementById('view_tariff').setAttribute("disabled","disabled");
	$(".hidable_column").hide();
	}
    
	if(s == "Cancel"){
	document.getElementById('save').setAttribute("disabled","disabled");
	document.getElementById('print_or_post').setAttribute("disabled","disabled");
	document.getElementById('post').setAttribute("disabled","disabled");
	document.getElementById("unpost").setAttribute("disabled","disabled");
        document.getElementById("re_print").setAttribute("disabled","disabled");
        document.getElementById("cancel").setAttribute("disabled","disabled");
        document.getElementById('remove_fn').setAttribute("disabled","disabled");
	document.getElementById('force_post').setAttribute("disabled","disabled");
        document.getElementById('print_jli_aai').setAttribute("disabled","disabled");
	document.getElementById("print_pcv_per_jo").removeAttribute("disabled");
        document.getElementById("validate").setAttribute("disabled","disabled");
        document.getElementById('unvalidate').setAttribute("disabled","disabled");
        document.getElementById("force_validate").setAttribute("disabled","disabled");
        document.getElementById("add_jo").setAttribute("disabled","disabled");
        document.getElementById('add').setAttribute("disabled","disabled");
        document.getElementById('delete').setAttribute("disabled","disabled");
        document.getElementById('view_tariff').setAttribute("disabled","disabled");
	$(".hidable_column").hide();
	}
	
	if(s == "Active"){
	document.getElementById('save').removeAttribute("disabled");
        document.getElementById("print_or_post").removeAttribute("disabled");
	document.getElementById('post').removeAttribute("disabled");
        document.getElementById("cancel").removeAttribute("disabled");
	document.getElementById("force_post").removeAttribute("disabled");
	document.getElementById("print_pcv_per_jo").removeAttribute("disabled");
	document.getElementById('add_jo').removeAttribute("disabled");
        document.getElementById('add').removeAttribute("disabled");
        document.getElementById('delete').removeAttribute("disabled");
        document.getElementById('view_tariff').removeAttribute("disabled");
	$(".hidable_column").show();
	}
}