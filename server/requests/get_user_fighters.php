<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/fighters_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$id = $body['userId'];

	$fighters = get_user_warriors($id);

	echo json_encode(["fighters" => $fighters]);
?>