<? 
	$title = "Login"; 
	$links = "<link rel='stylesheet' href='/styles/login.css'>";
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

<? 

	$msg = $_POST;

	$general = $msg['general'];

	$auth_login_err = $msg['auth_login_err'];
	$auth_password_err = $msg['auth_password_err'];

	$reg_login_err = $msg['reg_login_err'];
	$reg_password_err = $msg['reg_password_err'];	

	$user_id = get_user_id();

?>

<p class="white-text">
	<? var_dump($msg); ?>
</p>

<div class="login__wrapper">

	<p class="error-msg general-error"><? echo $general; ?></p>

	<?
		if ($user_id == '') {
			require_once $_SERVER['DOCUMENT_ROOT'].'/modules/login/log-in.php';
		} else {
			// echo "<p>User #$user_id info...</p>";
			require_once $_SERVER['DOCUMENT_ROOT'].'/modules/login/log-out.php';
		}
	?>

</div>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>