<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$items = $body['items'];

	$html = "";

	foreach ($items as $k => $item) {
		$id = $item['id'];
		$rarity = $item['rarity'];
		$price = $item['price'];
		
		$html .=
			"<div 
				class='inventory__item'>
				<p>rarity: $rarity</p>
				<p>price: $price$</p>
			</div>";
	}

	echo json_encode(["html" => $html]);
?>