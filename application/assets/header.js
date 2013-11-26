$(function() {

	$('#new_obj_add').click(function() {
		$('#new_obj_form').show();
	});

	$('#new_obj_cancel').click(function() {
		$('#new_obj_form').hide();
		$('#obj_name').val('');
	});
	
	function deletechecked()
	{
	    var answer = confirm("Delete selected messages ?");
	    if (answer){
	        document.messages.submit();
	    }
	    
	    return false;  
	} 
	
});