<?php
session_start();

include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

if(!isset($_SESSION['login']))
{
	header("Location: /index.php");
}

if($_SESSION['group'] < 2)
{
	header("Location: /index.php");
}

$tpl = new Template('default');
$tpl->init();

$template = new Template("default");
$template->init();


$db = new MyDB("forum");
$db->connect();

if(isset($_GET['mod']))
{
	$mod = $_GET['mod'];

	switch($mod)
	{
		case 'addcat':
		{
			if(isset($_POST['category']) && !empty($_POST['category']))
			{
				$result = "Dodano pomyślnie";
				$cat = $_POST['category'];

				if(strlen($cat) < 4)
				{
					$result = "Nazwa za krótka";
				}else
				{
					if(!$db->query("INSERT INTO categories VALUES('', '$cat')"))
					{
						$result = "Błąd bazy danych";
					}
				}

				$template->addRule('result', $result);

			}
			$template->loadTemplate('addCat.tpl');	
		}
		break;
		case 'addsubcat':
		{
			$categories = $db->query("SELECT * FROM categories");
			$options = "<option> -- Wybierz kategorię --</option>";

			while($row = $categories->fetch_assoc())
			{
				$options = $options . '<option value="'.$row['id'].'">'.$row['title'].'</option>';
			}

			$template->addRule('options', $options);

			if(isset($_POST['subcat']) && !empty($_POST['subcat']))
			{
				$result = "Dodano pomyślnie";
				$cat = $_POST['subcat'];
				$desc = $_POST['description'];
				$cat_id = intval($_POST['kat_id']);
				$ok = true;

				if(empty($cat_id))
				{
					$ok = false;
					$result = "Nie wybrałeś kategorii";
				}

				if(strlen($cat) < 4)
				{
					$ok = false;
					$result = "Nazwa za krótka";
				}
				if($ok){
					if(!$db->query("INSERT INTO subcategories VALUES('', $cat_id, '$cat', '$desc')"))
					{
						$result = "Błąd bazy danych";
					}
				}
				$template->addRule('result', $result);

			}
			$template->loadTemplate('addSubcat.tpl');	
		}
		break;
		case 'delcat':
		{
			$template->loadTemplate('delete.tpl');
			$cats = $db->query("SELECT * FROM categories");

			while($row = $cats->fetch_assoc())
			{
				$template->addRule('delete_id', $row['id']);
				$template->addRule('delete_title', $row['title']);
				$template->addRule('delete_what', 'category');
				$template->loadTemplate('singleDelete.tpl');
			}

		}
		break;

		case 'delsubcat':
		{
			$template->loadTemplate('delete.tpl');
			$cats = $db->query("SELECT * FROM subcategories");

			while($row = $cats->fetch_assoc())
			{
				$template->addRule('delete_id', $row['id']);
				$template->addRule('delete_title', $row['title']);
				$template->addRule('delete_what', 'subcategory');
				$template->loadTemplate('singleDelete.tpl');
			}

		}
		break;
	}

}else
{
	// Strona główna
	$users = $db->query("SELECT count(id) AS 'count' FROM users ")->fetch_assoc();
	$posts = $db->query("SELECT count(id) AS 'count' FROM posts ")->fetch_assoc();
	$topics = $db->query("SELECT count(id) AS 'count' FROM topics ")->fetch_assoc();
	$cat = $db->query("SELECT count(id) AS 'count' FROM categories ")->fetch_assoc();
	$subcat = $db->query("SELECT count(id) AS 'count' FROM subcategories ")->fetch_assoc();

	$template->addRule('admin_user', $users['count']);
	$template->addRule('admin_topic', $topics['count']);
	$template->addRule('admin_post', $posts['count']);
	$template->addRule('admin_cat', $cat['count']);
	$template->addRule('admin_subcat', $subcat['count']);
	$template->loadTemplate('adminMain.tpl');

}

try {
	
	$tpl->loadTemplate('header.tpl');
	$tpl->addRule('show_all', $template->returnTemplate());
	$tpl->loadTemplate('main.tpl');
	$tpl->loadTemplate('footer.tpl');
	$tpl->showTemplate();

} catch( Exception $e )
{
	echo "Error: " .  $e->getMessage();
	die();
}

?>