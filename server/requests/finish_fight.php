<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$warrior_id = $body['warrior_id'];

	header("Content-Type: application/json");

	$c = connect();
	
	$qUpdateWarrior = "update warriors set hasLoot = 1 where id = $warrior_id";
	$qGetRefreshedWarrior = "select * from warriors where id = $warrior_id";

	$c->query($qUpdateWarrior);
	$newFighter = $c->query($qGetRefreshedWarrior)->fetch_assoc();
	
	disconnect($c);
	
	echo json_encode(["newFighter" => $newFighter]);
?>