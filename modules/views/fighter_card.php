<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$fighters = $body['fighters'];

	$html = "";

	foreach ($fighters as $k => $fighter) {
		$name = $fighter['name'];
		$dur = $fighter['duration'];
		$prod = $fighter['production'];
		$rarity = (int)$fighter['rarity'];
		$id = $fighter['id'];
		$img_url = $fighter['image_url'];
		$isInFight = intval($fighter['isInFight']);
		$hasLoot = intval($fighter['hasLoot']);
		
		$canFight = !$isInFight ? '' : 'hidden';
		$showCountdown = $isInFight && !$hasLoot ? 'show' : '';
		$canCollect = $hasLoot ? '' : 'hidden';

		$html .=
			"
			<div class='fighter__card-wrapper' id='w-$id'>
				<div class='fighter__card'>
					<img class='fighter__img' src='$img_url' />
					<div class='fighter__name'>$name</div>
					<span class='fighter__stat fighter__dur'>$dur</span>
					<span class='fighter__stat fighter__prod'>$prod</span>
					<span class='fighter__stat fighter__rarity'>$rarity</span>
				</div>
				<div class='fighter__card-footer'>
					<button 
						$canFight
						class='fighter__btn start-fight__btn btn' 
						type='button'>
						Fight! ($dur sec)	
					</button>
					<button 
						$canCollect
						class='fighter__btn collect__btn btn'
						type='button'
						onclick='collectLoot($id, event)'>
						Collect loot	
					</button>
					<span class='fighter__countdown $showCountdown'>in fight countdown</span>
				</div>
			</div>";
	}

	echo json_encode(["html" => $html]);
?>