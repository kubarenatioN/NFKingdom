<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';

	function get_all_warriors() {
		$q = "select * from warriors";
		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);

		return $data;

		disconnect($c);
	}

	function get_all_warriors_fights() {
		$q = "select *, w.id as warrior_id, f.id as fight_id, w.duration
			from warriors w
			left join
			fights f
			on f.id_warrior = w.id and f.isCollected = 0";
		$c = connect();
	
		$data = $c->query($q);

		return $data;

		disconnect($c);
	}

	function get_all_fights() {
		$q = "select * from fights";
		$c = connect();
	
		$data = $c->query($q);

		return $data;

		disconnect($c);
	}
?>