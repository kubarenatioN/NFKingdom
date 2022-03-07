<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/fighters_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$warrior_id = $body['warriorId'];

	$res = collect_loot($warrior_id);

	echo json_encode($res);
?>