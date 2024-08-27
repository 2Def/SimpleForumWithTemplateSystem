<?php
session_start();

include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

if(isset($_SESSION['login']))
{
	header("Location: /index.php");
	die();
}

$tpl = new Template('default');
$db = new MyDB("forum");

$db->connect();

if(isset($_POST['send']))
{

	$valid = true;
	$username = $_POST['login'];
	$answer = "Zarejestrowano pomyślnie!";

	if ((strlen($username) < 3 || (strlen($username) > 20)))
	{
		$valid = false;
		$answer = "Twój login musi mieć od 3 do 20 znaków.";
	}

	if (ctype_alnum($username)==false)
	{
		$valid = false;
		$answer="Login może zawierać tylko cyfry i litery.";
	}

	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

	if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
		$valid=false;
		$answer="E-mail jest błedny.";
	}

	$pass = $_POST['pass'];
	$repass = $_POST['re_pass'];

	if ((strlen($pass)<6) || (strlen($pass)>24))
	{
		$valid=false;
		$answer = "Hasło musi mieć conajmniej 6 znaków i maksymalnie 24 znaki.";
	}

	if ($pass!=$repass)
	{
		$valid=false;
		$answer = "Podane hasła są różnie.";
	}

	$password_hash = password_hash($pass, PASSWORD_DEFAULT);

	if($valid)
	{
		$db = new MyDB("forum");
		$db->connect();

		$result = $db->query("SELECT id FROM users WHERE username='$username'");
				
		if (!$result) throw new Exception($db->error);
		
		$nick_count = $result->num_rows;
		if($nick_count>0)
		{
			$valid=false;
			$answer="Taki użytkownik już istenieje.";
		}

		$result = $db->query("SELECT id FROM users WHERE `email`='$email'");
		if (!$result) throw new Exception($db->error);
		
		$email_count = $result->num_rows;
		if($email_count > 0 )
		{
			$valid=false;
			$answer = "Taki email został już użyty.";
		}

		if($valid){
			if (!$db->query("INSERT INTO users VALUES (NULL, '$username', '$password_hash', '$email', 1, '".date('Y-m-d H:i:s')."', NULL)"))
			{
				$valid = "Wystąpił błąd z bazą danych. Spróbuj ponownie później.";		
			}
		}
	}

	if($valid)
	{
		$answer = "<font color='green'><b>" . $answer . "</b></font>";
	}else
	{
		$answer = "<font color='red'><b>" . $answer . "</b></font>";
	}

	try {
	
	$tpl->init();
	$tpl->loadTemplate('header.tpl');

	$tpl->addRule('result', $answer);
	$tpl->loadTemplate("register.tpl");

	$tpl->loadTemplate('footer.tpl');
	$tpl->showTemplate();

	} catch( Exception $e )
	{
		echo "Error: " .  $e->getMessage();
		die();
	}
}else
{

	try {
	
	$tpl->init();
	$tpl->loadTemplate('header.tpl');

	$tpl->loadTemplate("register.tpl");

	$tpl->loadTemplate('footer.tpl');
	$tpl->showTemplate();

	} catch( Exception $e )
	{
		echo "Error: " .  $e->getMessage();
		die();
	}

}


?>