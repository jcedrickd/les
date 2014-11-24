$(document).ready(function(){
    $("#btnClose").click(function (e){
    HideDialog();
    e.preventDefault();
    });
});

function ShowDialog(modal){
$("#overlay").show();
$("#dialog").fadeIn(300);
    if (modal){
    $("#overlay").unbind("click");
    }else{
	$("#overlay").click(function (e){
	HideDialog();
        });
    }
}

function HideDialog(){
$("#overlay").hide();
$("#dialog").fadeOut(300);
}