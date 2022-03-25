<div id="login-tabs" class="login-tabs">
	<div class="tab-btns__wrapper">
		<h4 data-form="login-form" id="login-tab-btn" class="tab__btn active">
			<span>Log In</span>
		</h4>
		<h4 data-form="register-form" id="register-tab-btn" class="tab__btn">
			<span>Register</span>
		</h4>
	</div>

	<div class="tabs__wrapper">
		<form id="login-form" class="form active" action="/modules/login/auth-manager.php" method="POST">
			<input type="text" hidden name="action" value="login">

			<span class="error-msg input-error"><? echo $auth_login_err; ?></span>
			<input type="text" name="login" id="login" placeholder="Login">
			
			<span class="error-msg input-error"><? echo $auth_password_err; ?></span>
			<input type="text" name="password" id="password" placeholder="Password">

			<button class="form-btn btn">Login</button>
		</form>

		<form id="register-form" class="form" action="/modules/login/auth-manager.php" method="POST">
			<input type="text" hidden name="action" value="reg">

			<span class="error-msg input-error"><? echo $reg_login_err; ?></span>
			<input type="text" name="login" placeholder="Login">
			
			<span class="error-msg input-error"><? echo $reg_password_err; ?></span>
			<input type="text" name="password" placeholder="Password">

			<button class="form-btn btn">Register</button>
		</form>
	</div>

</div>

<script>
	const tabBtns = document.querySelectorAll('.tab__btn');
	const tabs = document.querySelectorAll('.form');

	tabBtns.forEach(b => {
		b.addEventListener('click', () => {
			tabs.forEach(t => {
				t.classList.remove('active')
				if (t.id === b.dataset.form) {
					t.classList.add('active')
				}
			})
			tabBtns.forEach(b => b.classList.remove('active'))
			b.classList.add('active')
		})
	})

</script>