<?php
session_start();
include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

if(!isset($_SESSION['login']))
{
	echo <<<HTML
	<script>7
	alert("Jesteś niezalogowany!");
	window.history.back();
	</script>
HTML;
	die();
}


$db = new MyDB("forum");
$db->connect();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
if(isset($_GET['what']) && isset($_GET['id']) && $id)
{
	$what = $_GET['what'];
	$table_name = "";
	$protection_level = "";

	/*
	 1 - Moze usunąć użytkownik - autor
	 2 - Może usunac moderator
	 3 - Może usunąć administrator
	*/

	switch($what)
	{
		case 'topic':
		{
			$table_name = "topics";
			$protection_level = 2;
		}
		break;
		case 'post':
		{
			$table_name = "posts";
			$protection_level = 1;
		}
		break;
		case 'category':
		{
			$table_name = "categories";
			$protection_level = 3;
		}
		break;
		case 'subcategory':
		{
			$protection_level = 2;
			$table_name = "subcategories";
		}
		break;
		default:
		{
			echo <<<HTML
			<script>
				alert("Błąd w parametrze what!");
			window.history.back();
			</script>
HTML;
			die();
		}
		break;
	}

	switch ($protection_level) {
		case 1:
			{
				$user_id = $_SESSION['id'];
				$can_delete = true;

				if($_SESSION['group'] == $protection_level){
					$is_author = $db->query("SELECT * FROM $table_name WHERE user_id = " . $user_id)->num_rows;

					if($is_author == 0)
					{
						echo <<<HTML
						<script>
							alert("Nie jesteś autorem, nie możesz usunąć.");
						window.history.back();
						</script>
HTML;
					die();	
					}
				}

				if($db->query("DELETE FROM `$table_name` WHERE id = $id"))
				{
					echo <<<HTML
						<script>
							alert("Usunięto poprawnie.");
						window.history.back();
						</script>
HTML;
					die();	
				}

			}
			break;
		case 2:
			{
				if($_SESSION['group'] >= $protection_level)
				{
					if($db->query("DELETE FROM `$table_name` WHERE id = $id"))
					{

						echo <<<HTML
							<script>
								alert("Usunięto poprawnie.");
							window.history.back();
							</script>
HTML;
						die();	
					}
				}else
				{
					echo <<<HTML
						<script>
							alert("Brak uprawnien do usunięcia tego.");
						window.history.back();
						</script>
HTML;
					die();	
				}
			}
			break;
		case 3:
			{
				if($_SESSION['group'] == $protection_level)
				{
					if($db->query("DELETE FROM `$table_name` WHERE id = $id"))
					{
						if($table_name == 'categories')
							$db->query("DELETE FROM `subcategories` WHERE category_id = $id");
						echo <<<HTML
							<script>
								alert("Usunięto poprawnie.");
							window.history.back();
							</script>
HTML;
						die();	
					}
				}else
				{
					echo <<<HTML
						<script>
							alert("Brak uprawnien do usunięcia tego.");
						window.history.back();
						</script>
HTML;
					die();	
				}
			}
			break;
	}

}else
{
	echo <<<HTML
	<script>
		alert("Błąd danych wejściowych!");
	window.history.back();
	</script>
HTML;
die();
}


?>