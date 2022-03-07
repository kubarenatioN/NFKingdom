<? $title = "Token" ?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<h2 id="token-header">Token Page</h2>

	<div id="token" class="token">

	</div>

	<script>
		const token = document.querySelector('#token')
		const tokenHeader = document.querySelector('#token-header')

		const loadToken = (c, item) => {
			loadItem(c, item)
				.then(({ item, collection }) => {
					return getItemHTML(collection, item)
				})
				.then(html => token.innerHTML = html)
		}

		const loadQueryItems = (q) => {
			galery.innerHTML = q
		}
	</script>

	<?
		$collection = $_GET['c'];
		$item = $_GET['i'];
		
		if (!is_null($collection) && !is_null($item)) {
			echo "<script>loadToken($collection, $item)</script>";
		} else {
			echo "Error...";
		}
	?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>