$(function() {
	$("#dialog").dialog({
    	autoOpen: false,
    	height: 250,
    	width: 240,
    	modal: true,
    	buttons: { 
        	"Submit": function() {
        		$( this ).dialog( "close" );
        		$.ajax({
            		url: '<?php echo base_url().'index.php/ajax/modify';?>',
        			type: 'POST',
        			data: "start="+ $("#start").val() + "&finish="+ $("#finish").val() + "&course="+ $("#course").val(),
        			
                }); 
     
      		},
        	Cancel: function () {
            	$(this).dialog("close");
        	}
    	}
    	
	});

	$("#modify").click(function () {
    	$("#dialog").dialog("open");
	});
});