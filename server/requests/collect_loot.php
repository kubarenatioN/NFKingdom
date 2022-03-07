<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$warrior_id = $body['warriorId'];

	header("Content-Type: application/json");

	$c = connect();
	
	$qCollectFight = "update fights set isCollected = 1 where id_warrior = $warrior_id and isCollected = 0";
	$qRefreshFighter = "update warriors set isInFight = 0, hasLoot = 0 where id = $warrior_id";
	$qGetRefreshedWarrior = "select * from warriors where id = $warrior_id";

	$c->query($qCollectFight);
	$c->query($qRefreshFighter);
	$newFighter = $c->query($qGetRefreshedWarrior)->fetch_assoc();

	disconnect($c);

	echo json_encode(["newFighter" => $newFighter]);
?>