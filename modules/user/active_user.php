<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	$json = file_get_contents('php://input');
	$body = json_decode($json, true);
	// $warrior_id = $body['warriorId'];
	$user = get_user(1);
	$name = $user['login'];
	$gold = $user['gold'];
?>
<div class="wrapper">
	<h3 class="name">
		<? echo $name; ?>
	</h3>
	<p class="account">
		<? echo $gold; ?>
	</p>
</div>