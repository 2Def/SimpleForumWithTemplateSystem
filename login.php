<?php
session_start();
include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

if(isset($_GET['logout']))
{
	session_unset();
	header("Location: /index.php");
}

if(isset($_SESSION['login']))
{
	header("Location: /index.php");
	die();
}

if(isset($_POST['login']) && isset($_POST['pass']))
{

	$username = $_POST['login'];
	$password = $_POST['pass'];

	$username = htmlentities($username, ENT_QUOTES, "UTF-8");


	$db = new MyDB("forum");
	$db->connect();


	$result = $db->query("SELECT * FROM users WHERE `username` = '" . $username . "'");
	if($result->num_rows == 1)
	{
		$query = $result->fetch_assoc();
				
		if (password_verify($password, $query['password']))
		{
			$_SESSION['login'] = true;
			$_SESSION['id'] = $query['id'];
			$_SESSION['username'] = $query['username'];
			$_SESSION['group'] = $query['group_id'];
			
			$db->query("UPDATE users SET last_login='".date('Y-m-d H:i:s')."' WHERE id=".$query['id']);
			
			echo 1;
		}else
		{
			echo 0;
		}
}else
	{
		echo 0;
	}

}else
{
	$tpl = new Template('default');

	try {
		$tpl->init();
		$tpl->loadTemplate('header.tpl');

		$tpl->loadTemplate("login.tpl");

		$tpl->loadTemplate('footer.tpl');
		$tpl->showTemplate();

	} catch( Exception $e )
	{
		echo "Error: " .  $e->getMessage();
		die();
	}
}


?>