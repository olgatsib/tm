<?php foreach ($row as $row_item): ?>

<tr>
	<form method="POST"
		action="<?php echo $this->config->item('base_url')?>index.php/display/update"
		name="Today">
		<!-- id -->
		<input type="hidden" name="id"
			value="<?php echo $row_item['id']?>"> 
			
		<!-- print start and finish time -->
		<td style=""><?php echo $row_item['time_start'] ?></td>
		<td style=""><?php echo $row_item['time_finish'] ?></td>

		<!-- print subject name  -->
		<td style=""><?php echo $row_item['subject'] ?></td>

		<!-- print indicator -->	
      	<?php
	if (strcmp ( $row_item ['type'], "1" ) == 0) { // not study
		if (strcmp ( $row_item ['time_spent'], "0" ) == 0) // 0 minutes studied
			print ("\t\t<td style=\"width=40%;text-align:center\"><div style=\"background-color:pink\">0%</div></td>\n") ;
		else
			print ("\t\t<td style=\"width=40%;text-align:center\"><div style=\"background-color:blue\">100%</div></td>\n") ;
	} else { // study
		$start = explode ( ':', $row_item ['time_start'] );
		$finish = explode ( ':', $row_item ['time_finish'] );
		$timeDue = ($finish [0] * 60 + $finish [1]) - ($start [0] * 60 + $start [1]);
		$timePercent = round ( $row_item ['time_spent'] * 1.0 / $timeDue * 100 );
		if ($timePercent > 0) {
			if ($timePercent < 100) { // did something
				$timeRest = 100 - $timePercent;
				print ("\t\t<td><div style=\"background-color:green;text-align:center;width:$timePercent%;float:left\">$timePercent%</div>\n\t\t
  <div style=\"background-color:red;text-align:center\">$timeRest%</div></td>\n") ;
			} else { // more than enough
				print ("\t\t<td><div style=\"background-color:green;text-align:center\">$timePercent%</div></td>") ;
			}
		} else {
			print ("\t\t<td style=\"width=40%;text-align:center\"><div style=\"background-color:red\">$timePercent%</div></td>\n") ;
		}
	}
	?>
      		<!-- input minutes of work -->
		<td style="width: 6%"><input type="text" name="time"
			style="width: 3em"></td>
		<input type="hidden" name="day" value="Today">
		<td style="text-align: center; width: 10%"><input type="submit"
			value="OK"></td>
	</form>
</tr>
<?php endforeach ?>