<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$items = $body['items'];
	$collection = $body['collection'];

	$html = "";

	foreach ($items as $k => $item) {
		$id = $item['id'];
		$rarity = $item['rarity'];
		$price = $item['price'];
		$img_url = $item['image_url'];
		$col_id = $collection['id'];
		$col_name = $collection['name'];
		$html .=
			"<a 
				class='item__card'
				href='/pages/item.php?c=$col_id&i=$id'>
				<img 
					class='item__card-img'
					src='$img_url' 
					alt='$col_name-$id'/>
				<p>rarity: $rarity</p>
				<p>collection: $col_name</p>
				<p>price: $price$</p>
			</a>";
	}

	echo json_encode(["html" => $html]);
?>