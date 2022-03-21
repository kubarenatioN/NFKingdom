<?



?>

<h4>Log In</h4>
<p>You have to login to join fights</p>
<form id="login-form" class="form">
	<input type="text" name="login">
	<input type="text" name="password">
	<button>Login</button>
</form>

<h4>Register</h4>
<p>You have to login to join fights</p>
<form id="register-form" class="form">
	<input type="text" name="login">
	<input type="text" name="password">
	<button>Register</button>
</form>

<script>
	const loginForm = document.querySelector('#login-form')
	const registerForm = document.querySelector('#register-form')

	const loginBtn = loginForm.querySelector('button')
	const registerBtn = registerForm.querySelector('button')

	const loginFormData = new FormData(loginForm)
	const registerFormData = new FormData(registerForm)

	console.log(loginFormData);

	loginBtn.addEventListener('click', () => {

	})
</script>