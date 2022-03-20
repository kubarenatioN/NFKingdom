<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';

	function get_user($id) {
		$q = "select * from users where id = $id";
		$c = connect();
	
		$data = $c->query($q)->fetch_assoc();
		
		disconnect($c);

		return $data;
	}

	function update_account($id, $value) {
		$qCurrentAccount = "select gold from users where id = $id";
		
		$c = connect();
	
		$account = $c->query($qCurrentAccount)->fetch_assoc()['gold'];
		$account += $value;

		$qUpdateAccount = "update users set gold = $account where id = $id";
		$c->query($qUpdateAccount);

		$qGetUser = "select * from users where id = $id";
		$user = $c->query($qGetUser)->fetch_assoc();
		
		disconnect($c);

		return $user;
	}

	function purchase_item($user_id, $token_id, $token_type) {
		$q = "insert into users_items (id, user_id, item_id, item_type, item_unique_id) values (null, $user_id, $token_id, '$token_type', UUID())";

		$c = connect();
	
		$data = $c->query($q);
		
		disconnect($c);

		return $data;
	}

	function get_items($user_id, $type) {
		$q = "select * 
		from users_items u
		inner join items i
		on u.item_id = i.id and u.user_id = $user_id and item_type in ($type)";

		$c = connect();
	
		$data = $c->query($q)->fetch_all(MYSQLI_ASSOC);
		
		disconnect($c);

		return $data;
	}

?>