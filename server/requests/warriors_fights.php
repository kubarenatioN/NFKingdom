<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	$json = file_get_contents('php://input');

	header("Content-Type: application/json");

	$c = connect();

	$q = "select *, w.id as warrior_id, f.id as fight_id, w.duration
			from warriors w
			left join
			fights f
			on f.id_warrior = w.id and f.isCollected = 0";
	
	$warriors = $c->query($q)->fetch_all(MYSQLI_ASSOC);
	
	disconnect($c);

	echo json_encode($warriors);
?>