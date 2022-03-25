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
				class='galery__card'
				href='/pages/item.php?c=$col_id&i=$id'>
				<img 
					class='galery__card-img'
					src='$img_url' 
					alt='$col_name-$id'/>
				<div class='galery__card-footer'>
					<p class='galery__card-rarity'>rarity: $rarity</p>
					<p class='galery__card-price'>price: $price</p>
				</div>
			</a>";
	}

	echo json_encode(["html" => $html]);
?>