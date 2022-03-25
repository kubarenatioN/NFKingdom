<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user_id = $body['userId'];

	header("Content-Type: application/json");

	$c = connect();

	$q = "select *, w.id as warrior_id, f.id as fight_id, w.duration
			from warriors w
			left join
			fights f
			on f.id_warrior = w.id 
			where f.isCollected = 0 and w.user_id = $user_id";
	
	$warriors = $c->query($q)->fetch_all(MYSQLI_ASSOC);
	
	disconnect($c);

	echo json_encode($warriors);
?>