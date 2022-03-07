<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$id = $body['id'];

	header("Content-Type: application/json");

	$c = connect();
	
	$qUpdateFighterState = "update warriors set isInFight = 1 where id = $id";
	$c->query($qUpdateFighterState);
	
	$qWarrior = "select * from warriors where id = $id";
	$warrior = $c->query($qWarrior)->fetch_assoc();
	$duration = $warrior['duration'];
	$start = time();
	
	$qAddFight = "call add_fight($id, $start, $duration)";
	$c->query($qAddFight);
	
	disconnect($c);

	// $warrior["isInFight"] = 1;
	$countdown = ["warrior_id" => $id, "start_time" => $start, "end_time" => $start + $duration];

	echo json_encode(["warrior" => $warrior, "countdown" => $countdown]);
?>