<?

	$routes = [
		"Home" => "/",
		"Login" => "/pages/login.php",
		"Camp" => "/pages/camp.php",
		"Collections" => "/pages/collections.php",
		// "Catalog" => "/pages/catalog.php",
	];

	$header = "<ul class='header__menu'>";

	foreach ($routes as $name => $link) {
		$header .=
			"<li class='header__menu-item'><a class='header__menu-link' href='$link'>$name</a></li>";	
	}

	echo $header."</ul>";

?>