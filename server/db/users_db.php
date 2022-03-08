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

?>