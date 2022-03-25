<?

	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/connection.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/fighter_calculator.php';

	function create_user($login, $password) {
		$q = "insert into users (login, password) values ('$login', '$password')";
		$qGetNewUser = "select LAST_INSERT_ID()";

		$c = connect();
		$inserted = $c->query($q);
		$new_user = $c->query($qGetNewUser)->fetch_assoc()['LAST_INSERT_ID()'];
		
		$qCreateNewUserItems = "insert into users_items (id, user_id, item_id, item_type, item_unique_id) values 
		(null, $new_user, 17, 'creatures', UUID()),
		(null, $new_user, 6, 'weapons', UUID()),
		(null, $new_user, 12, 'defense', UUID())";

		$c->query($qCreateNewUserItems);

		disconnect($c);

		return ["inserted" => $inserted, "new_user" => $new_user];
	}

	function find_user($login, $password) {
		$q = "select * from users where login = '$login' and password = '$password'";

		$c = connect();
		$found = $c->query($q)->fetch_assoc();
		
		disconnect($c);

		return $found;
	}

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

	function create_warrior($user_id, $name, $items) {
		$params = calculate_fighter($items);
		$prod = $params['prod'];
		$dur = $params['dur'];
		$creature_id = $items[0]['item_id'];
		$slot2_id = $items[1]['item_id'];
		$slot3_id = $items[2]['item_id'];

		$rarity = 0;
		foreach ($items as $k => $it) {
			$rarity += $it['rarity'];
		}
		$rarity /= 3;
		$img_url = $items[0]['image_url'] ?? '';

		$creature_u_id = $items[0]['item_unique_id'];
		$slot2_u_id = $items[1]['item_unique_id'];
		$slot3_u_id = $items[2]['item_unique_id'];

		$qCreate = "insert into warriors (user_id, name, production, duration, rarity, image_url, creature_slot_id, slot2_id, slot3_id)
		values ($user_id, '$name', $prod, $dur, $rarity, '$img_url', $creature_id, $slot2_id, $slot3_id)";
		$qGetWarrior = "select LAST_INSERT_ID()";
		$qDeleteItems = "delete from users_items where item_unique_id in ('$creature_u_id', '$slot2_u_id', '$slot3_u_id')";

		$c = connect();
		$create = $c->query($qCreate);
		$warrior_id = $c->query($qGetWarrior)->fetch_assoc()['LAST_INSERT_ID()'];
		// $del = $c->query($qDeleteItems);

		disconnect($c);

		return ["created" => $create, "warrior_id" => $warrior_id];
	}

	function set_favs($user_id, $favs, $token) {
		$likes = $token['likes_count'];
		$item_id = $token['id'];
		$favs_str = implode("-", $favs);
		$q = "update users set favorites = '$favs_str' where id = $user_id";
		$qUpdateToken = "update items set likes_count = $likes where id = $item_id";

		$c = connect();
	
		$data = $c->query($q);
		$likes = $c->query($qUpdateToken);
		
		disconnect($c);

		return [$data, $likes];
	}

?>