<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user_id = $body['userId'];
	$type = $body['itemsType'];

	$items = get_items($user_id, $type);

	echo json_encode(["items" => $items]);
?>