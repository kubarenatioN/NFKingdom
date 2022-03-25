<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$item = $body['item'];
	$col = $body['col'];

	$id = $item['id'];
	$rarity = $item['rarity'];
	$price = $item['price'];
	$url = $item['image_url'];
	$col_id = $col['id'];
	$col_name = $col['name'];

	$html =
	"
		<img src='$url' alt='$col_name-$id' />
		<div 
			class='token__inner'>
			<h2>Token #$id</h2>
			<p>rarity: $rarity</p>
			<p>collection: $col_name</p>
			<p class='token__inner-price'>price: $price</p>
			<button class='token__purchase btn'>Purchase</button>
			<div class='favorites__btns'>
				
			</div>
		</div>";

	echo json_encode(["html" => $html]);
?>