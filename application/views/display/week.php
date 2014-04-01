<div id='result'>
</div>

<script type='text/javascript' language='javascript'>
$(function() {
	
	$("#dialog").dialog({
		
    	autoOpen: false,
    	height: 250,
    	width: 240,
    	modal: true,
    	buttons: { 
        	"Submit": function() {
        		$( this ).dialog( "close" );
        		var id = $(this).data('id'); 
        		$.ajax({
            		url: '<?php echo base_url().'index.php/editor/modify';?>',
        			type: 'POST',
        			data: "id="+ id + "&start="+ $("#start").val() + "&finish="+ $("#finish").val() + "&course="+ $("#course").val(),
        			success: function() {
        					if ($("#start").val() != "")
        	                	$("#start_"+id).html($("#start").val());
        					if ($("#finish").val() != "")
        	                	$("#finish_"+id).html($("#finish").val());
    	                	if ($("#course").val() != "")
        	                	$("#course_"+id).html($("#course").val());
        	            }
                }); 
     
      		},
        	Cancel: function () {
            	$(this).dialog("close");
        	}
    	}
    	
	});

	$(".modify").click(function () {
		var nameButton = this.name;
		$('#dialog').data('id', nameButton);
    	$("#dialog").dialog("open");
	});
	
	$(".remove").click(function() {
		var id = this.name;
		var s = "Are you sure you want to delete the entry?";
		 $('<div>' + s + '</div>').dialog({
		        resizable: false,
		        buttons: {
		            "Yes": function() {
		                $(this).dialog("close");
		                $.ajax({
		            		url: '<?php echo base_url().'index.php/editor/delete';?>',
		        			type: 'POST',
		        			data: "id="+ id,
		        			success: function() {
	        					$("tr[id="+id+"]").html("");
	        					
	        	            }
		                }); 
		            },
		            Cancel: function() {
		                $(this).dialog("close"); 
		            }
		        }
		 });
		
	});
});
</script>
<?php 
	$datePrevious = null;
	foreach ($row as $row_item): 
		if ($datePrevious != strtotime($row_item['date'])) { 
			$day = date('l', strtotime($row_item['date'])); ?>
			<tr><th colspan="11">&nbsp;</th></tr>
		<?php } ?> 	
<tr id="<?php echo $row_item['id']?>" class="<?php if ($day === "Saturday" || $day === "Sunday") echo "yellow"; else echo "green"?>">
	<form method="POST"
		action="<?php echo $this->config->item('base_url')?>index.php/display/update"
		name="Ok">
		<!-- id -->	
		<input type="hidden" name="id" value="<?php echo $row_item['id']?>">
		
		<td style="text-align: center; width:10%"><?php echo $row_item['date'] ?></td>
		<td style="text-align: center; width:10%"><?php echo date('l', strtotime($row_item['date']))?></td>
		<!-- print start and finish time -->
		<td id="start_<?php echo $row_item['id']?>" style="text-align: center; width:5%"><?php echo $row_item['time_start'] ?></td>
		<td id="finish_<?php echo $row_item['id']?>"style="text-align: center; width:5%"><?php echo $row_item['time_finish'] ?></td>

		<!-- print subject name  -->
		<td id="course_<?php echo $row_item['id']?>"style="text-align: center; width:10%"><?php echo $row_item['subject'] ?></td>

		<!-- print indicator -->	
      	<?php
	if (strcmp ( $row_item ['type'], "1" ) == 0) { // not study
		if (strcmp ( $row_item ['time_spent'], "0" ) == 0) // 0 minutes studied
			print ("\t\t<td style=\"width:20%;text-align:center\"><div style=\"background-color:pink\">0%</div></td>\n") ;
		else
			print ("\t\t<td style=\"width:20%;text-align:center\"><div style=\"background-color:blue\">100%</div></td>\n") ;
	} else { // study
		$start = explode ( ':', $row_item ['time_start'] );
		$finish = explode ( ':', $row_item ['time_finish'] );
		$timeDue = ($finish [0] * 60 + $finish [1]) - ($start [0] * 60 + $start [1]);
		if ($timeDue != 0)
			$timePercent = round ( $row_item ['time_spent'] * 1.0 / $timeDue * 100 );
		else 
			$timePercent = 100;
		if ($timePercent > 0) {
			if ($timePercent < 100) { // did something
				$timeRest = 100 - $timePercent;
				print ("\t\t<td><div style=\"background-color:green;text-align:center;width:$timePercent%;float:left\">$timePercent%</div>\n\t\t
  <div style=\"background-color:red;text-align:center\">$timeRest%</div></td>\n") ;
			} else { // more than enough
				print ("\t\t<td><div style=\"background-color:green;text-align:center\">$timePercent%</div></td>") ;
			}
		} else {
			print ("\t\t<td style=\"width:20%;text-align:center\"><div style=\"background-color:red\">$timePercent%</div></td>\n") ;
		}
	}
	?>
      		<!-- input minutes of work -->
      	<input type="hidden" name="day" value="Week">
		<td style="width: 5%"><input type="text" name="time"
			style="width: 3em"></td>
		<td style="text-align: center; width: 10%"><input type="submit" name="action"
			value="OK"></td>
	</form>
	<!-- <form name="mod" action="">	
		<input type="hidden" name="id" value="<?php echo $row_item['id']?>"> -->
		<td style="text-align: center; width: 10%"><button class="modify" name="<?php echo $row_item['id']?>">Modify</button></td>
		<td style="text-align: center; width: 10%"><button class="remove" name="<?php echo $row_item['id']?>">Remove</button></td>

	
</tr>

	

<?php 
	$datePrevious = strtotime($row_item['date']);
	endforeach 
?>
<div id="dialog" title="Enter new data">
   	<form>
	<fieldset>
    	<label for="start">Start time</label>
    	<span><input type="text" name="start" id="start" 
    		class="text ui-widget-content ui-corner-all" /></span>
    	<label for="finish">Finish time</label>
    	<span><input type="text" name="start" id="finish" 
    		value="" class="text ui-widget-content ui-corner-all" /></span>
    	<label for="course">Course</label>
    	<span><input type="text" name="start" id="course" 
    		value="" class="text ui-widget-content ui-corner-all" /></span>
  	
  	</form>
  	
  	
            </fieldset>
</div>

