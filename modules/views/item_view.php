<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$item = $body['item'];
	$col = $body['col'];

	$id = $item['id'];
	$rarity = $item['rarity'];
	$price = $item['price'];
	$col_id = $col['id'];
	$col_name = $col['name'];

	$html =
		"<div 
			class='token__inner'>
			<h3>Token #$id</h3>
			<p>rarity: $rarity</p>
			<p>collection: $col_name</p>
			<p>price: $price$</p>
			<button class='token__purchase'>Purchase</button>
		</div>";

	echo json_encode(["html" => $html]);
?>