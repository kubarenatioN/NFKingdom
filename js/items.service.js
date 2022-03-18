const displayItems = (items) => {
	return itemsAjax.getItemsHTML(items)
		.then(res => res.json())
		.then(({ html }) => html)
}