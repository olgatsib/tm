<p id="title_schedule">Results</p>
<hr id="line" />
<br>
<br>
<table id="table_results">
	<tr style="text-align: center; background-color:#CCFF99">
		<?php
			if ($flag === 'w') { ?>
				<td>Date</td>
				<td>Day of Week</td>
		<?php } ?>
		<td>Start</td>
		<td>Finish</td>
		<td>Subject</td>
		<td>Accomplishment</td>
		<td>Time</td>
		<td>Submit</td>
		<?php
			if ($flag === 'w') { ?>
				<td>Modify</td>
		<?php } ?>
		<?php
			if ($flag === 'w') { ?>
				<td>Remove</td>
		<?php } ?>
	</tr>