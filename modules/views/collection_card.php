<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$collections = $body['collections'];

	$html = "";

	foreach ($collections as $k => $collection) {
		$name = $collection['name'];
		$type = $collection['type'];
		$id = $collection['id'];
		
		$html .=
			"<a 
				class='collection__item collection__$type'
				href='/pages/galery.php?c=$id'>
				<p class='collection__item-title'><span>$name</span></p>
				<p class='collection__item-type'>Type: <span>$type</span></p>
			</a>";
	}

	echo json_encode(["html" => $html]);
?>