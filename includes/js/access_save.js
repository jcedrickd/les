function access_save(insert_id,update_id){
			if(insert_id.trim() == "hide"){
			alert("You have no insert access!");
			return false;
			}
			if(update_id.trim() == "hide"){
			alert("You have no update access!");
			return false;
			}
}