<?

	function calculate_fighter($items) {
		$creature = $items[0];
		$slot2 = $items[1];
		$slot3 = $items[2];

		// base creature gold
		// the less rarity - the more gold
		$creature_prod = 100 + 100 * (1 - $creature['rarity'] / 100);

		// base creature fight time in seconds
		// the less rarity - the less duration - the faster fight
		$creature_dur = 60 * (1 + $creature['rarity'] / 25);
		
		$slot2_params = calculate_slot($slot2);
		$slot3_params = calculate_slot($slot3);

		$general_prod = $creature_prod + $slot2_params['prod'] + $slot3_params['prod'];

		$general_dur = $creature_dur * 0.4 + ($slot2_params['dur'] + $slot3_params['dur']) * 0.6;

		return ["prod" => $general_prod, "dur" => $general_dur];
	}

	function calculate_slot($slot) {
		$prod = calculate_production($slot);
		$dur = calculate_duration($slot);
		return ["prod" => $prod, "dur" => $dur];
	}

	// weapons increase production, defense - less increase
	function calculate_production($item) {
		$type = $item['item_type'];
		if ($type === 'weapons') {
			$k = 1;
		} else {
			$k = 0.5; // if item is defense - give less production
		}
		return 50 + 50 * (1 - $item['rarity'] / 100) * $k;
	}

	// defense decrease duration, weapons - give more duration
	function calculate_duration($item) {
		$type = $item['item_type'];
		if ($type === 'defense') {
			$k = 1;
		} else {
			$k = 2; // if item is weapon - give more duration
		}
		return 30 * (2 + $item['rarity'] / 50) * $k;
	}

?>