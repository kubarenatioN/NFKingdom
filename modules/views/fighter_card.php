<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$fighters = $body['fighters'];

	$html = "";

	foreach ($fighters as $k => $fighter) {
		$name = $fighter['name'];
		$duration = $fighter['duration'];
		$id = $fighter['id'];
		$isInFight = intval($fighter['isInFight']);
		$hasLoot = intval($fighter['hasLoot']);
		
		$canFight = !$isInFight ? '' : 'hidden';
		$showCountdown = $isInFight && !$hasLoot ? 'show' : '';
		$canCollect = $hasLoot ? '' : 'hidden';

		$html .=
			"<form 
				class='fighter__card'
				id='w-$id'>
				<input type='text' hidden name='fight_id' value=''>
				<div class='fighter__name'>$name</div>
				<button 
					$canFight
					class='fighter__btn' 
					type='button'
					onclick='startFight($id, event)'>
					Fight! ($duration sec)	
				</button>
				<button 
					$canCollect
					class='fighter__btn collect__btn'
					type='button'
					onclick='collectLoot($id, event)'>
					Collect loot	
				</button>
				<span class='fighter__countdown $showCountdown'>in fight countdown</span>
			</form>";
	}

	echo json_encode(["html" => $html]);
?>