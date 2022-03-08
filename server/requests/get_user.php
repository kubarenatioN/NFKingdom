<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$id = $body['id'];

	$user = get_user($id);

	echo json_encode(["user" => $user]);
?>