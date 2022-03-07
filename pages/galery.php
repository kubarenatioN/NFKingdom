<? 
	$title = "Galery";
	$links = "<link rel='stylesheet' href='/styles/galery.css'>"
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<h2 id="galery-header">Gallery</h2>

	<div id="galery" class="galery">

	</div>

	<script>
		const galery = document.querySelector('#galery')
		const galeryHeader = document.querySelector('#galery-header')

		const loadColItems = (id) => {
			loadCollectionItems(id)
				.then(({ items, collection }) => {
					galeryHeader.innerHTML = `Gallery "${collection.name}"`
					return displayCollectionItems(items, collection)
				})
				.then(html => galery.innerHTML = html)
		}

		const loadQueryItems = (q) => {
			galery.innerHTML = q
		}
	</script>

	<?
		$collection = $_GET['c'];
		$query = $_GET['q'];
		
		if (!is_null($collection)) {
			echo "<script>loadColItems($collection)</script>";
		} else {
			echo "<script>loadQueryItems('$query')</script>";
		}
	?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>