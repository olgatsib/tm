<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<base href="<?php echo $this->config->item('base_url') ?>www/" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<title>Kalasoft</title>
</head>
<body>
<a href="http://olgatsib.com/projects">Back to the site</a> 
	<img src="img/title.jpg" alt="header"
		style="display: block; margin-top: 15px; margin-left: auto; margin-right: auto">
	<!--  <p id="title">KalaSoft&trade;</p><br>
    	<marquee id="tape" behavior="slide" direction="left">Procrastination is the grave in which opportunity is buried (Author Unknown)</marquee>
    	-->
	<div id="outer">
		<div id="cont">
			<a
				href="<?php echo $this->config->item('base_url')?>index.php/schedule">
				<span id="box1" class="box"><span id="text"><br>Schedule</span> <img
					id="image" src="img/schedule.png" alt="schedule" /> </span>
			</a> <a
				href="<?php echo $this->config->item('base_url')?>index.php/editor">
				<span id="boxL" class="box"><span id="text"><br>Editor</span> <img
					id="image" src="img/Edit.png" alt="editor" /> </span>
			</a> <a href="other.html"> <span id="boxR" class="box"><span
					id="text"><br>Other</span> <img id="image" src="img/question.png"
					alt="other" /> </span>
			</a>
		</div>
		<script>
				$(".box").mouseenter(function() {
					$(this).fadeTo('fast', 0.7);
				});
				$(".box").mouseleave(function() {
					$(this).fadeTo('fast', 1);
				});
    		</script>
	</div>
</body>
</html>