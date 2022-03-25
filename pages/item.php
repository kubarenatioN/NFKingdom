<? 
	$title = "Token"; 
	$links = "<link rel='stylesheet' href='/styles/token-page.css'>";
?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

	<script src="/js/collections.ajax.js"></script>
    <script src="/js/collections.service.js"></script>

	<!-- <h2 id="token-header">Token Page</h2> -->
	<p class="message-label hidden"></p>
	<div id="token" class="token">
		
	</div>

	<script>
		const token = document.querySelector('#token')
		const tokenHeader = document.querySelector('#token-header')
		const msgLabel = document.querySelector('.message-label')

		const buyToken = (token, tokenType) => {
			let userGold = getUserGold()
			if (userId == '') {
				displayMessage('Can\'t purchase item, login first...')
				throw new Error('can\'t purchase item, no user')
				return
			}
			if (+userGold < +token.price) {
				displayMessage('Can\'t purchase item, not enough gold')
				throw new Error('can\'t purchase item, not enough gold')
				return
			}
			const requests = []
			const purchase = purchaseToken({ userId, tokenId: token.id, tokenType })
			const account = updateUserAccount(userId, -token.price)
			requests.push(purchase, account)
			Promise.all(requests)
				.then(([ isPurchased, user ]) => {
					setUserGold(user.gold)
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
					buyBtn.disabled = userId === '' ? true : false

					setFavoriteBtn(tokenItem)
				})
		}

		const displayMessage = (msg) => {
			msgLabel.textContent = msg
			msgLabel.classList.remove('hidden')
			setTimeout(() => {
				msgLabel.classList.add('hidden')
			}, 2000);
		}

		const setFavoriteBtn = (t) => {
			const { id, likes_count } = t
			const favBtn = createFavoriteBtn(id, likes_count)
			token.querySelector('.favorites__btns').innerHTML = favBtn
			handleFavoriteListener(t)
		}

		const createFavoriteBtn = (id, count) => {
			let favBtn
			if (!getUserFavs().includes(id)) {
				favBtn = `<button title='add' class='favorites__btn favorites__btn-add'></button><span>${count}</span>`
			} else {
				favBtn = `<button title='remove' class='favorites__btn favorites__btn-remove'></button><span>${count}</span>`
			}
			return favBtn
		}

		const handleFavoriteListener = (t) => {
			const {id} = t
			const btn = document.querySelector('.favorites__btn')
			btn.disabled = true
			setTimeout(() => {
				btn.disabled = false
			}, 2000);
			const favs = getUserFavs()
			if (!favs.includes(id)) {
				btn.addEventListener('click', () => {
					t.likes_count = +t.likes_count + 1
					setUserFavs([...favs, id], t)
					setFavoriteBtn(t)
				})
			} else {
				btn.addEventListener('click', () => {
					t.likes_count = +t.likes_count - 1
					setUserFavs(favs.filter(f => f !== id), t)
					setFavoriteBtn(t)
				})
			}
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