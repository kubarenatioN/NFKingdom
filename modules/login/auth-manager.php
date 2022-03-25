<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/users_db.php';
	session_start();

	$action = $_POST['action'];
	$action_get = $_GET['action'];
	$rand_form = rand();

	// var_dump($_GET);
	// return;

	if ($action === 'login') {
		$login = $_POST['login'];
		$password = $_POST['password'];
		echo "<br>";
		echo "Login";
		echo "<br>";

		$validation = validate_auth($login, $password);
		$login_err = $validation['login'];
		$password_err = $validation['password'];

		// validations here...
		if (
			$login_err !== ""
			|| $password_err !== ""
		) {
			echo "<form id='auth-error' action='/pages/login.php' method='POST'>
				<input type='text' hidden name='auth_login_err' value='$login_err'>
				<input type='text' hidden name='auth_password_err' value='$password_err'>
			</form>
			<script>document.getElementById('auth-error').submit()</script>
			";
			return;
		}

		$user = find_user($login, $password);
		$user_id = $user['id'];
		// if there is no such user
		if (is_null($user['id'])) {
			echo "<form id='no-user' action='/pages/login.php' method='POST'>
				<input type='text' hidden name='general' value='Такого пользователя не существует'>
			</form>
			<script>document.getElementById('no-user').submit()</script>
			";
			return;
		}

		$_SESSION['user_id'] = $user_id;
		header("Location: /pages/camp.php");
	}

	if ($action === 'reg') {
		$login = $_POST['login'];
		$password = $_POST['password'];
		echo "<br>";
		echo "Register";
		echo "<br>";

		$validation = validate_reg($login, $password);
		$login_err = $validation['login'];
		$password_err = $validation['password'];

		// validations here...
		if (
			$login_err !== ""
			|| $password_err !== ""
		) {
			echo "<form id='reg-error' action='/pages/login.php' method='POST'>
				<input type='text' hidden name='reg_login_err' value='$login_err'>
				<input type='text' hidden name='reg_password_err' value='$password_err'>
			</form>
			<script>document.getElementById('reg-error').submit()</script>
			";
			return;
		}
		
		$user = find_user($login, $password);
		if (isset($user)) {
			echo "<form id='no-user' action='/pages/login.php' method='POST'>
				<input type='text' hidden name='general' value='Пользователь уже зарегистрирован'>
			</form>
			<script>document.getElementById('no-user').submit()</script>
			";
			return;
		}

		$res = create_user($login, $password);
		$user_id = $res['new_user'];
		$_SESSION['user_id'] = $user_id;

		header("Location: /pages/camp.php");
		return;
	}

	if ($action === 'logout') {
		$_SESSION['user_id'] = "";
		header("Location: /pages/login.php");
	}

	if ($action_get === 'logout') {
		$_SESSION['user_id'] = "";
		header("Location: /pages/login.php");
	}

	// header("Location: /pages/collections.php");

	function validate_auth($login, $password) {
		$login_v = validate_login($login);
		$password_v = validate_password($password);

		return ["login" => $login_v, "password" => $password_v];
	}

	function validate_reg($login, $password) {
		$login_v = validate_login($login);
		$password_v = validate_password($password);

		return ["login" => $login_v, "password" => $password_v];
	}

	function validate_login($login) {
		$res = trim($login);
		if ($res === "") {
			return "Логин не может быть пустым.";
		}
		return "";
	}

	function validate_password($password) {
		$res = trim($password);
		if ($res === "") {
			return "Пароль не может быть пустым.";
		}
		return "";
	}

?>