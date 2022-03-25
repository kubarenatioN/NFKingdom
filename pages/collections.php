<? 
	$title = "Collections";
	$links = "<link rel='stylesheet' href='/styles/collections.css'>"
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<section class="collections section">
		<h2 class="section-title">Explore NFT Collections</h2>
	
		<div id="collections" class="collections__inner">
			<div class="collections__galery">

			</div>
		</div>
	</section>

	<script>
		const galery = document.querySelector('.collections__galery')

		loadAllCollections()
			.then(collections => displayCollections(collections))
			.then(html => galery.innerHTML = html)
	</script>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>