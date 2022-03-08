<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user_id = $body['userId'];
	$item_id = $body['tokenId'];
	$item_type = $body['tokenType'];

	$res = purchase_item($user_id, $item_id, $item_type);

	echo json_encode($res);
?>