function check_csr(csr,error_message){
	csr_strlen=document.getElementById(csr).value;
		if(csr_strlen.length < 5){
		alert("No CSR found, Please input CSR");
		document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: No CSR found, Please input CSR</b></span>";
		}else{
		document.getElementById(error_message).innerHTML="<span id='inputError'></span>";
		}
}