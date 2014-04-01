<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<base href="<?php echo $this->config->item('base_url') ?>www/" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/calendar.css" rel="stylesheet" type="text/css" />
<link href="css/s_calendar.css" rel="stylesheet" type="text/css">
<title>
<?php
switch ($page) {
case 's':
	print ("Schedule") ;
	break;
case 'r':
	print ("Results") ;
	break;
case 'e':
	print ("Editor") ;
	break;
}
?>
    	</title>
<script type="text/javascript" src="js/clock/clockp.js"></script>
<script type="text/javascript" src="js/clock/clockh.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events/reoccurringEventsCal.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<style>
	
	fieldset {
	   	padding:0;
	   	border:0;
       	margin-top:12px;
    }
	fieldset label {
		float:left;
		width:100px;
		padding-top:8px;
 	}
 	fieldset span{
        display: block;
        overflow: hidden;
        
    }
	fieldset input { 
		width:90px;
        border:none;
        background:none;
    }
   
</style>

</head>
<body>
	<div id="button-home" class="button-header">
		<span id="span-text">Home</span>
	</div>
	<div id="button-back" class="button-header">
		<span id="span-text">Back</span>
	</div>
	<br />
	
	<script>
      		$(".button-header").css('cursor', 'pointer');
      		$(".button-header").mouseenter(function() {
      			$(this).fadeTo('fast', 0.6);
      		});
      		$(".button-header").mouseleave(function() {
      			$(this).fadeTo('fast', 1);
      		});
      		$("#button-home").click(function() {
      			window.location="<?php echo $this->config->item('base_url') ?>";
      		});
    	</script>
		<?php
		if ($page === 's' || $page === 'e') { ?>
			<script>
				$('#button-back').click(function() {
      				window.location="<?php echo $this->config->item('base_url') ?>" 
          		});
          	</script>
		<?php } else if ($page === 'r') { ?>
			<script>
				$('#button-back').click(function() {
      				window.location="<?php echo $this->config->item('base_url')?>index.php/schedule";
      			});
      		</script>
		<?php } ?>
		