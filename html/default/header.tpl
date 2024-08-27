<!DOCTYPE HTML>
<html>
	<head>
		<title>{title}</title>
		  <meta charset="UTF-8">
		  <meta name="description" content="{description}">
		  <meta name="author" content="Arkadiusz Haduch">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<style>
			
			body {
			    background-image: url("/html/{template_name}/images/background.png");
			    background-repeat: repeat;
			    font-family: "Trebuchet MS", Helvetica, sans-serif;
			    color: black;
			}

			#contrainer
			{
				width: 80%;
				margin: 0 auto;
				margin-top: 15px;

			}
			#top
			{
				background-color: #92B6D5;
				width: 100%;
				height: 48px;
				border-radius: 1px;
				text-align: center;
				border-bottom: 2px solid #4C6A92;

			}	
			.topBelow
			{
				background-color: #4C6A92;
				width: 100%;
				height: 36px;
  				line-height: 36px;	
				text-align: center;
				margin: 0 auto;
				text-align: center;
				border-bottom-left-radius: 20px 20px;
				border-bottom-right-radius: 20px 20px;
				margin-bottom: 10px;

			}
			.button
			{
				display: inline-block;
				padding-left: 5px;
				padding-right: 5px;
				background-color: #92B6D5;
  				vertical-align: middle;
  				line-height: normal;
  				border-radius: 5px;
			}

			#content
			{
				min-height: 600px;
				width: 100%;
				background-color: #92B6D5;

			}
			.subcategory
			{
				padding-bottom: 10px;
				border-bottom: 2px solid #4C6A92;

			}
			.cattitle
			{
				font-size: 18px;
				font-weight: bold;
			}
			.subcattitle
			{
				border-bottom: 1px dotted black;
				font-style: italic;
				font-weight: bold;
			}
			a
			{
				text-decoration: none;
				color: black;
			}
			.subcat
			{
				padding-left: 2%; width: 58%;  float: left;
			}
			span {
			  float: left;
			  clear: left;
			}
			.description
			{
				font-size: 14px;
				padding-left: 5px;
			}
			#footer {
			    clear: both;
			    position: relative;
			    z-index: 10;
			    height: 3em;
			    margin-top: -3em;
			    text-align: center;
			    width: 80%;
			    margin: 0 auto;
			}
			.center {
			    margin: auto;
			    width: 50%;
			}
		</style>
	</head>
	<body>
		<div id="contrainer">
			<div id="top">
				<h1>{header}</h1>
			</div>	
			<div class="topBelow">
				<div style="text-align: left; padding-left: 10px; position: absolute; text-decoration: underline;">Witaj, <b><i>{username}</i></b></div>
				<div class="button"><a href="/index.php">Strona Głowna</a></div>
				[group=0]
				<div class="button"><a href="/register.php">Rejestracja</a></div>
				<div class="button"><a href="/login.php">Logowanie</a></div>
				[/group]
				[not-group=0]
				<div class="button"><a href="/profile.php">Profil</a></div>
				[/not-group]
				[group=3]<div class="button"><a href="/admin.php">Panel Admina</a></div>[/group]
				[group=2]<div class="button"><a href="/admin.php">Panel Moderatora</a></div>[/group]
				<div class="button"><a href="">Kontakt</a></div>
				<div class="button"><a href="">Regulamin</a></div>
				[not-group=0]
				<div class="button"><a href="/login.php?logout=true">Wyloguj</a></div>
				[/not-group]
				<div class="button"><a href="/pdf.php">Generuj PDF</a></div>
			</div>