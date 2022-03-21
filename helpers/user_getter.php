<?

	session_start();
	// $_SESSION['user_id'] = 1;
	function get_user_id() {
		return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
	}
?>