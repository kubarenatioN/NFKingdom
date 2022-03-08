<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$id = $body['id'];
	$value = $body['value'];

	$user = update_account($id, $value);

	echo json_encode(["user" => $user]);
?>