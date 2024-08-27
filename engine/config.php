<?php

	define("TEMPLATE_PATH", "html/");
	define("CLASS_PATH", "class/");

	$config = array(
		'title' => 'Twoja-strona.pl - Forum o Komputerach',
		'description' => 'Forum internetowe zrzeszające pasjonatów informatyki',
		'header' => 'Forum o komputerach - Twoja-strona.pl'
	);

	$mysql = array(
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_password' => ''
	);

	class MyDB
	{
		private $db_name;
		private $mysql;
		private $db;

		public function __construct($db_name)
		{
			$this->db_name = $db_name;

			global $mysql;
        	$this->mysql =& $mysql;
		}

		function connect()
		{
			if(empty($this->db_name))
				return false;

			@$this->db = new mysqli(
		       $this->mysql['db_host'],
		       $this->mysql['db_user'],
		       $this->mysql['db_password'],
		       $this->db_name
		    );

		    if ($this->db->connect_error) {
			    die("Brak połączenia z bazą danych: " . $db->connect_error);
			} 

			return true;
		}

		public function query($string)
		{
			$this->db->query("SET NAMES utf8");
			return $this->db->query($string);
		}

		public function close()
		{
			$this->db->close();
		}
	}

?>