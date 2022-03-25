<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user_id = $body['userId'];
	$favs = $body['favorites'];
	$token = $body['token'];

	$res = set_favs($user_id, $favs, $token);

	echo json_encode(["favs" => $res]);
?>