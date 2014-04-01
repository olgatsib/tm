<p id="title_schedule">Schedule</p>
<hr id="line" />
<table style="width: 100%">
	<tr>
		<td style="width: 40%" id="clock">
			<div id="clock_a"></div>
		</td>
		<td rowspan="2">
			<div id="calendar">
				<script type="text/javascript">
              document.write(droplists());
              document.write(createMonth());
            </script>
			</div>
		</td>
	</tr>
	<tr>
		<td id="form_schedule">
			<form method="POST"
				action="<?php echo $this->config->item('base_url')?>index.php/display/"
				name="day">
				<input type="submit" id="button" name="day" value="Today" /><br />
				<input type="submit" id="button" name="day" value="Week" /><br /> 
				<input type="submit" id="button" name="day" value="Month" /><br />
				<input type="submit" id="button" name="day" value="Demo" /><br />
			</form>
		</td>
	</tr>
</table>
</body>
</html>
