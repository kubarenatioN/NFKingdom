<? 
	$title = "Token"; 
	$links = "<link rel='stylesheet' href='/styles/token-page.css'>";
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<h2 id="token-header">Token Page</h2>

	<div id="token" class="token">

	</div>

	<script>
		const token = document.querySelector('#token')
		const tokenHeader = document.querySelector('#token-header')

		const buyToken = (token, tokenType) => {
			const id = userId
			const requests = []
			const purchase = purchaseToken({ userId: id, tokenId: token.id, tokenType })
			const account = updateUserAccount(id, -token.price)
			requests.push(purchase, account)
			Promise.all(requests)
				.then(([ isPurchased, user ]) => {
					// console.log(isPurchased, user);
					return displayUserProfile(user)
				})
				.then(html => profile.innerHTML = html)
		}

		const loadToken = (c, item) => {
			let tokenItem
			let collectionType
			loadItem(c, item)
				.then(({ item, collection }) => {
					tokenItem = item
					collectionType = collection.type
					return getItemHTML(collection, item)
				})
				.then(html => {
					token.innerHTML = html
					const buyBtn = document.querySelector('.token__purchase')
					buyBtn.addEventListener('click', () => {
						buyToken(tokenItem, collectionType)
					})
				})
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