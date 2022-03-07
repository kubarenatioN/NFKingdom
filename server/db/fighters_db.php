<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';

	function get_all_warriors() {
		$q = "select * from warriors";
		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);
		
		disconnect($c);

		return $data;
	}

	function get_user_warriors($userId) {
		$q = "select * from warriors where user_id = $userId";
		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);

		disconnect($c);

		return $data;
	}

	function get_all_warriors_fights() {
		$q = "select *, w.id as warrior_id, f.id as fight_id, w.duration
			from warriors w
			left join
			fights f
			on f.id_warrior = w.id and f.isCollected = 0";
		$c = connect();
	
		$data = $c->query($q);

		disconnect($c);

		return $data;
	}

	function get_all_fights() {
		$q = "select * from fights";
		$c = connect();
	
		$data = $c->query($q);

		disconnect($c);

		return $data;
	}

	function start_fight($id) {
		$c = connect();
	
		$qUpdateFighterState = "update warriors set isInFight = 1 where id = $id";
		$c->query($qUpdateFighterState);
		
		$qWarrior = "select * from warriors where id = $id";
		$warrior = $c->query($qWarrior)->fetch_assoc();
		$duration = $warrior['duration'];
		$production = $warrior['production'];
		$start = time();
		
		$qAddFight = "call add_fight($id, $start, $duration, $production)";
		$c->query($qAddFight);
		
		disconnect($c);

		$countdown = ["warrior_id" => $id, "start_time" => $start, "end_time" => $start + $duration];

		return ["warrior" => $warrior, "countdown" => $countdown];
	}

	function collect_loot($warrior_id) {	
		$qCollectFight = "update fights set isCollected = 1 where id_warrior = $warrior_id and isCollected = 0";
		$qRefreshFighter = "update warriors set isInFight = 0, hasLoot = 0 where id = $warrior_id";
		$qGetRefreshedWarrior = "select * from warriors where id = $warrior_id";

		$c = connect();

		$c->query($qCollectFight);
		$c->query($qRefreshFighter);
		$newFighter = $c->query($qGetRefreshedWarrior)->fetch_assoc();

		disconnect($c);

		return $newFighter;
	}

	function finish_fight($warrior_id) {
		$c = connect();
	
		$qUpdateWarrior = "update warriors set hasLoot = 1 where id = $warrior_id";
		$qGetRefreshedWarrior = "select * from warriors where id = $warrior_id";

		$c->query($qUpdateWarrior);
		$newFighter = $c->query($qGetRefreshedWarrior)->fetch_assoc();
		
		disconnect($c);

		return $newFighter;
	}
?>