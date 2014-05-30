$(document).ready(
function() {
    $("#newgrp").click(function(event) {
        event.preventDefault();
        $.ajax({
                       //pegando a url apartir do href do link
            url: '_aux_submit_form_group.php',
            type: 'GET',
            success: function(data){
                $("#grupos").append(data);
            }
        });
       $("#newgrp").hide();
       $("#grp_save").show();
       $("#grp_cancel").show();
    });
    
    $("#grp_cancel").click(function(event) {
    	$("#grupos").load('_blank.php');
       $("#newgrp").show();
       $("#grp_save").hide();
       $("#grp_cancel").hide();    	 
    });
    
    $("#grp_save").click(function(event) {
        event.preventDefault();
        $.ajax({
                       //pegando a url apartir do href do link
            url: '_aux_submit_form_group.php',
            type: 'POST',
            data: jQuery('form').serialize(),            	
            success: function(data){
                $("#grupos").html(data); 
            }
        });
       $("#grupos").append('===>'+$("#grupos").html.length);
	   if ($("#grupos").html.length >= 40)
	   	{  
       		$("#newgrp").show();
       		$("#grp_save").hide();
       		$("#grp_cancel").hide();
       }
    });    
    
    
});