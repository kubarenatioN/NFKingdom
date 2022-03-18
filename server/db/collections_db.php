<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';

	function get_all_collections() {
		$q = "select * from collections";
		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);
		
		disconnect($c);

		return $data;
	}

	function get_collection($id) {
		$q = "select * from collections where id = $id";
		$c = connect();

		$collection = $c->query($q)->fetch_assoc();
		
		disconnect($c);

		return $collection;
	}

	function get_collection_items($id) {
		// $q = "select type from collections where id = $id";
		$c = connect();
	
		// $type = $c->query($q)->fetch_assoc()['type'];
	
		$qItems = "select * from items where collection_id = $id";

		$items = $c->query($qItems)->fetch_all(MYSQLI_ASSOC);
		
		disconnect($c);

		return $items;
	}

	function get_item($colId, $itemId) {
		// $q = "select type from collections where id = $colId";
		$c = connect();
	
		// $type = $c->query($q)->fetch_assoc()['type'];
	
		$qItem = "select * from items where collection_id = $colId and id = $itemId";

		$item = $c->query($qItem)->fetch_assoc();
		
		disconnect($c);

		return $item;
	}

?>