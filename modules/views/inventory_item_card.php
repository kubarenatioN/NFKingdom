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
		$img_url = $item['image_url'];
		$type = $item['item_type'];
		$token = $item['item_unique_id'];
		
		$html .=
			"<div 
				class='inventory__item inventory__$type'
				data-id='$type[0]-$item_id'
				data-token='$token'>
				<img 
					class='inventory__item-img'
					src='$img_url' />
				<h4 class='inventory__item-id'>#$item_id</h4>
				<span class='inventory__item-rarity'>$rarity</span>
			</div>";
		// $i++;
	}

	echo json_encode(["html" => $html]);
?>