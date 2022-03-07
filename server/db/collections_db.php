<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';

	function get_all_collections() {
		$q = "select * from collections";
		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);
		
		disconnect($c);

		return $data;
	}

?>