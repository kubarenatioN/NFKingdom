<?
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	$user = $body['user'];

	$login = $user['login'];
	$gold = $user['gold'];
	
	$html =
		"
			<h4 class='profile__widget-username'>$login</h4>
			<p class='profile__widget-account'>$gold</p>
		";

	echo json_encode(["html" => $html]);
?>