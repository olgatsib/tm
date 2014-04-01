<p id="title_schedule">Editor</p>
<hr id="line" />
<br />
<br />
<form method="POST"
	action="<?php echo $this->config->item('base_url')?>index.php/editor/new_entry">
	<div style="text-align: center">
   	Date: <?php $data['count']=0; $this->load->view('calendar', $data)?>
   	<p>
			Subject:<input type="text" size="5" name="subject">
		</p>
		<p>
			Start time: &nbsp; <select name="hourStart">
    	<?php
					for($i = 1; $i <= 24; $i ++)
						if ($i == 10)
							printf ( '<option value=%s selected>%s</option>', $i, $i );
						else
							printf ( '<option value=%s>%s</option>', $i, $i );
					?>
	    </select>: <select name="minStart">
	  	<?php
				for($i = 0; $i < 60; $i += 5) {
					if ($i == 0 || $i == 5)
						printf ( '<option value=0%s>0%s</option>', $i, $i );
					else
						printf ( '<option value=%s>%s</option>', $i, $i );
				}
				?>
		</select>
		</p>
		<p>
			Finish time: <select name="hourFinish">
	 	<?php
			for($i = 1; $i <= 24; $i ++)
				if ($i == 10)
					printf ( '<option value=%s selected>%s</option>', $i, $i );
				else
					printf ( '<option value=%s>%s</option>', $i, $i );
			?>
		</select>: <select name="minFinish">
	  	<?php
				for($i = 0; $i < 60; $i += 5) {
					if ($i == 0 || $i == 5)
						printf ( '<option value=0%s>0%s</option>', $i, $i );
					else
						printf ( '<option value=%s>%s</option>', $i, $i );
				}
				?>
		</select>
		</p>
		<p>
			Study<input type="radio" name="type" value="Study"> Other<input
				type="radio" name="type" value="Other">
		</p>
    Fill up till: <?php $data['count']=1; $this->load->view('calendar', $data)?>
    <p>
			Reset numeration: <input type="checkbox" name="reset" value="">
		</p>
		<p>
			<input type="submit" value="Add Entry">
		</p>
	</div>
</form>
</body>
</html>
