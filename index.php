<?php
session_start();
include ( 'engine/config.php' );
include ( CLASS_PATH . 'Template.class.php' );



$db = new MyDB("forum");
$db->connect();

$tpl = new Template('default');

try {
	$tpl->init();
	$tpl->loadTemplate('header.tpl');
} catch( Exception $e )
{
	echo "Error: " .  $e->getMessage();
	die();
}


try {

	// POBIERANIE I WYŚWIETLANIE KATEGORII I SUB KATEGORII
	$result = $db->query("SELECT * FROM `categories`");

	$inner = new Template('default');
	$inner->init();

	while($row = $result->fetch_assoc())
	{

		$inner->addRule('category_title', $row['title']);
		$inner->loadTemplate("category.tpl");

		$innerResult = $db->query("SELECT * FROM `subcategories` WHERE category_id = " . $row['id']);
		if($innerResult->num_rows > 0)
		{
			while($innerRow = $innerResult->fetch_assoc())
			{
				$posts = $db->query("SELECT count(posts.id) as `count` FROM topics LEFT JOIN posts ON topics.id = posts.topic_id WHERE subcategory_id = " . $innerRow['id'])->fetch_assoc();
				$topics = $db->query("SELECT count(id) AS `count` FROM topics WHERE subcategory_id = " . $innerRow['id'] )->fetch_assoc();
				$last = $db->query("SELECT topics.id, username FROM topics JOIN users ON users.id = topics.user_id WHERE subcategory_id = " . $innerRow['id'] . " ORDER BY 1 DESC LIMIT 1" )->fetch_assoc();

				if($last['username'] == "")
					$last['username'] = "  - ";

				$inner->addRule('id', $innerRow['id']);
				$inner->addRule('subcategory_title', $innerRow['title']);
				$inner->addRule('subcategory_description', $innerRow['description']);
				$inner->addRule('subcategory_post', $posts['count']);
				$inner->addRule('subcategory_topic', $topics['count']);
				$inner->addRule('subcategory_user', $last['username']);
				$inner->loadTemplate("subcategory.tpl");
			}
		}
	}
	// KONIEC POBIERANIA I WYŚWIETLANIA KATEGORII I SUB KATEGORII


	$tpl->addRule('show_all', $inner->returnTemplate());
	$tpl->loadTemplate("main.tpl");


	$tpl->loadTemplate('footer.tpl');
	$tpl->showTemplate();

	unset($inner);
	unset($tpl);

} catch( Exception $e )
{
	echo "Error: " .  $e->getMessage();
	die();
}

?>