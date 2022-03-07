<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$collections = $body['collections'];

	$html = "";

	foreach ($collections as $k => $collection) {
		$name = $collection['name'];
		$id = $collection['id'];
		
		$html .=
			"<a 
				class='collection__item'
				href='/pages/galery.php?c=$id'>
				$name
			</a>";
	}

	echo json_encode(["html" => $html]);
?>