<?php
session_start();
include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );

$tpl = new Template('default');
$tpl->init();

$template = new Template("default");
$template->init();

if(isset($_GET['mod']))
{
	$mod = $_GET['mod'];

	switch($mod)
	{
		case 'showall':
		{
			if(!isset($_GET['id']))
			{
				header("Location: /index.php");
			}else
			{
				$id = intval($_GET['id']);

				$db = new MyDB("forum");
				$db->connect();

				$query = $db->query("SELECT topics.id, `title`, `content`, topics.date, users.username FROM `topics` JOIN users ON users.id = topics.user_id WHERE subcategory_id = $id");

				$title = $db->query("SELECT title FROM subcategories WHERE id = $id")->fetch_assoc();
				$template->addRule('subcategory_title', $title['title']);
				$template->addRule('id', $id);
				$template->loadTemplate('topicHeader.tpl');

				while($row = $query->fetch_assoc())
				{
					$template->addRule('id', $row['id']);
					$template->addRule('subcategory_title', $row['title']);
					$template->addRule('subcategory_description', substr($row['content'], 0, 25) . '...');
					$template->addRule('subcategory_date', $row['date']);
					$template->addRule('subcategory_user', $row['username']);
					$template->loadTemplate("topic.tpl");
				}

			}
		}
		break;
		case 'add':
		{
			if(!isset($_GET['id']))
			{
				header("Location: /index.php");
			}else
			{
				$id = intval($_GET['id']);

				$db = new MyDB("forum");
				$db->connect();
				$result = "";

				if(isset($_POST['send']) && isset($_SESSION['login']))
				{
					$error = false;
					$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
					$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
					$user_id = $_SESSION['id'];
					$date = date('Y-m-d H:i:s');

					if(empty($title) || strlen($title) < 4)
					{
						$error = true;
						$result = "<center><h1><font color='red'>Tytuł za krótki.</font></h1></center>";
					}
					if(empty($content) || strlen($content) < 4)
					{
						$error = true;
						$result = "<center><h1><font color='red'>Treść za krótka.</font></h1></center>";
					}

					if(!$error){
						if($db->query("INSERT INTO `topics` VALUES('', $id, '$title', '$content', $user_id, '$date')"))
						{
							$myid = $db->query("SELECT id FROM `topics` ORDER by 1 desc")->fetch_assoc();

							$result = "<center><h1><font color='green'>Dodano nowy temat pomyślnie. <a style='text-decoration: underline;' href='/topic.php?mod=show&id=".$myid['id']."'>Pokaż twoj temat</a> lub dodaj kolejny</font></h1></center>";
						}else
						{
							$result = "<center><h1><font color='red'>Wystąpił błąd przy dodawaniu Tematu.</font></h1></center>";
						}
					}
					$template->addRule('result', $result);
				}
				$template->loadTemplate('addTopic.tpl');

			}
		}
		break;
		case 'show':
		{
			if(!isset($_GET['id']))
			{
				header("Location: /index.php");
			}else
			{
				$id = intval($_GET['id']);

				$db = new MyDB("forum");
				$db->connect();

				$topic = $db->query("SELECT title, content, username, topics.date FROM `topics` JOIN users ON topics.user_id = users.id WHERE topics.id = $id" )->fetch_assoc();

				$template->addRule('topic_title', $topic['title']);
				$template->addRule('topic_content', $topic['content']);
				$template->addRule('topic_username', $topic['username']);
				$template->addRule('topic_date', $topic['date']);
				$template->addRule('topic_comments', 0);
				$template->loadTemplate('showTopic.tpl');

				//Posty
				$posts = $db->query("SELECT posts.id, `content`, `username`, `date` FROM posts JOIN users ON users.id = posts.user_id WHERE topic_id = $id");
				while($row = $posts->fetch_assoc())
				{
					$template->addRule('post_content', $row['content']);
					$template->addRule('post_author', $row['username']);
					$template->addRule('post_date', $row['date']);
					$template->addRule('id', $row['id']);
					$template->loadTemplate('post.tpl');
				}

				if(isset($_POST['content']) && !empty($_POST['content']))
				{
					$user_id = $_SESSION['id'];
					$date = date('Y-m-d H:i:s');
					$content = $_POST['content'];
					$result = "Gratulacje dodałeś odpowiedź poprawnie!\\nOdpowiedź będzie widoczna za pare sekund.";

					if(strlen($content) < 4)
					{
						$result = "Odpowiedź jest za krótka.";
					}else
					{
						if(!$db->query("INSERT INTO posts VALUES('', $id, '$content', '$date', $user_id)"))
						{
							$result = "Błąd bazy danych...";
						}
					}
					$result = '<script>alert("' . $result . '"); </script>';
					$template->addRule('result', $result);
					header("refresh: 3;");
				}

				$template->loadTemplate('addPost.tpl');
			}
		}

	}
}else
{
	header("Location: /index.php");
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