<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Titre de ma page</title>
		<meta name="description" content="description de ma page">

		<link rel="stylesheet" href="<?php echo PATH_RELATIVE;?>assets/css/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo PATH_RELATIVE;?>assets/css/bootstrap/bootstrap-theme.min.css">

	</head>
	<body>

	<?php
		//include "views/".$this->view.".view.php";
		include $this->view.".view.php";
	?>


	<script src="<?php echo PATH_RELATIVE;?>assets/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo PATH_RELATIVE;?>assets/js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>