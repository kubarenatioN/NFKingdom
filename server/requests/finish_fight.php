<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/fighters_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$warrior_id = $body['warrior_id'];

	$newFighter = finish_fight($warrior_id);
	
	echo json_encode(["newFighter" => $newFighter]);
?>