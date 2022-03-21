<? $title = "Login" ?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<?
		$user_id = get_user_id();
		var_dump($user_id);
		if ($user_id == '') {
			require_once $_SERVER['DOCUMENT_ROOT'].'/modules/login/log-in.php';
		} else {
			require_once $_SERVER['DOCUMENT_ROOT'].'/modules/login/log-out.php';
		}
	?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>