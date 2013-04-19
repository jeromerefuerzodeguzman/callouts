<?php 
	//php class includes
	include 'class/record.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Singtel-Callouts</title>
<!-- Favicon -->
<link rel="shortcut icon" href="fav.ico" />

<!-- General CSS -->
<link type="text/css" href="css/style.css" rel="stylesheet" />

<!-- Inline Css for Table -->
<style>
	
	/*css of the whole table*/
	.contentTable {
		width: 778px;
		text-align: center;
	}

	/*css of the headers*/
	.tableHead tr th{
		font-family: verdana,arial,sans-serif;
		font-weight: bold; 
		font-size: 12px; 
		padding: 8px 0px 8px 0px;
		background-color: #86A8D6;
	}

	/*css for the contents*/
	.contentTable tr td{
		font-family: verdana,arial,sans-serif;
		font-size: 11px;
		padding: 5px 0px 5px 0px;
	}

	/*width of the columns in the table*/
	.contentTable tr td {
		width: 160px;
	}

	.contentTable tr {
		background-color: #FFFFFFF;
	}

	/*highlights the campaigns name*/
	.groupName {
		font-weight: bold;
	}

</style>


<!-- javascript for highlighting data-->
<script>

	
	function mouseOn(x) {
		x.style.backgroundColor='#D2E0F5';
	}

	function mouseOut(x) {
		x.style.backgroundColor='#FFFFFF';
	}

</script>

<!-- jQuery -->
<script type="text/javascript" src="js/lib/jquery/jquery-1.9.1.min.js"></script>

<!-- DatePicker -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script>
  $(function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>

</head>
<body>
	<div id="content">
		<div id="contentHeader">
			<div style="width: 820px; margin-left: 200px;">
				<div id="nslogo"></div>
				<div id="appTitle">Singtel Callouts</div>
			</div>
		</div>
		<br />
		<div class="clearFix"></div>