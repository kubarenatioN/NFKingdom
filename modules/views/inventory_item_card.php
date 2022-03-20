<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$items = $body['items'];

	$html = "";
	// $i = 1;

	foreach ($items as $k => $item) {
		$item_id = $item['item_id'];
		$rarity = $item['rarity'];
		$price = $item['price'];
		$type = $item['item_type'];
		$token = $item['item_unique_id'];
		
		$html .=
			"<div 
				class='inventory__item inventory__$type'
				data-id='$type[0]-$item_id'
				data-token='$token'>
				<h4>item: #$item_id</h4>
				<p>rarity: $rarity</p>
				<p>price: $price$</p>
				<p>type: $type</p>
			</div>";
		// $i++;
	}

	echo json_encode(["html" => $html]);
?>