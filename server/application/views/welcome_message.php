<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="60">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">

	<title>Knock-Knock | Who is there?</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<link rel="stylesheet" href="./assets/fonts/styles.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style type="text/css">
	body {
		background: #000;
	}
	.container {
		max-width: 650px;
	}
	.plate {
		text-align: center;
		font-family: 'DotsAllForNowJL';
		font-size: 3em;
		padding-top: 50px;
	}
	@media(min-width: 768px) {
		.plate {
			padding-top: 100px;
			font-size: 7em;
		}
	}
	.text_open {
		line-height: 1em;
		color: #00FF00;
		text-shadow: 0 0 1em rgba(0,255,0,0.9);
	}
	.text_close {
		line-height: 1em;
		color: #FF0000;
		text-shadow: 0 0 1em rgba(255,0,0,0.9);
	}
	.macs {
		text-align: center;
		color: #fff;
	}
	</style>
</head>

<body>

<div class="container">
	<div class="plate">
	<?php
		if (count($active_ignore) > 0) {
			echo "<span class='text_open'>ABERTO</span><br/>";
		} else {
			echo "<span class='text_close'>FECHADO</span><br/>";
		}
	?>
	</div>


	<br><br>
	<div class="col-xs-12 macs">
		<div class="col-xs-12 col-sm-6">
		<strong>Todos os aparelhos online (<?=count($active_ignore);?>)</strong><br/>
		(menos fixos)<br/><br/>
		<?php
			foreach ($active_ignore as $value) {
				echo $value->name . "<br/>";
			}
		?>
		</div>
		<div class="col-xs-12 col-sm-6">
		<strong>Todos os aparelhos online (<?=count($active);?>)</strong><br/>
		(inclusive fixos)<br/><br/>
		<?php
			foreach ($active as $value) {
				echo $value->name . "<br/>";
			}
		?>
		</div>
	</div>

</div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


</body>

</html>