<?php
session_start();

include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

if(!isset($_SESSION['login']))
{
	header("Location: /index.php");
}

$tpl = new Template('default');

try {
	$tpl->init();
	$tpl->loadTemplate('header.tpl');

	$tpl->loadTemplate("profile.tpl");

	$tpl->loadTemplate('footer.tpl');
	$tpl->showTemplate();
} catch( Exception $e )
{
	echo "Error: " .  $e->getMessage();
	die();
}

?>