const itemsAjax = {
	getItemsHTML: (items) => {
		const url = '/modules/views/inventory_item_card.php'
		const payload = {
			items,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	}
}