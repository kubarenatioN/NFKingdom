<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user_id = $body['userId'];
	$warrior_name = $body['name'];
	$items = $body['items'];

	$warrior = create_warrior($user_id, $warrior_name, $items);

	echo json_encode($warrior);
?>