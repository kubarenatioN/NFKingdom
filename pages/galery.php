<? 
	$title = "Galery";
	$links = "<link rel='stylesheet' href='/styles/galery.css'>"
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<section class="galery section">
		<h2 id="galery-header" class="section-title">Gallery of </h2>

		<div id="galery" class="galery__inner">

		</div>
	</section>

	<script>
		const galery = document.querySelector('#galery')
		const galeryHeader = document.querySelector('#galery-header')
		let galeryItems
		const loadColItems = (id) => {
			loadCollectionItems(id)
				.then(({ items, collection }) => {
					galeryItems = items
					galeryHeader.innerHTML = galeryHeader.textContent + `"${collection.name}"`
					return displayCollectionItems(items, collection)
				})
				.then(html => {
					galery.innerHTML = html
					console.log('items:', galeryItems);
				})
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