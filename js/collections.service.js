const loadAllCollections = () => {
	return collectionsAjax.getAllCollections()
		.then(res => res.json())
		.then(({ collections }) => collections)
}

const displayCollections = (collections) => {
	return collectionsAjax.getCollectionsHTML(collections)
		.then(res => res.json())
		.then(({ html }) => html)
}

const loadItem = (colId, itemId) => {
	return collectionsAjax.getItem(colId, itemId)
		.then(res => res.json())
		.then(({ item, collection }) => {
			console.log(item, collection);
			return { item, collection }
		})
}

const getItemHTML = (col, item) => {
	return collectionsAjax.getItemHTML(col, item)
		.then(res => res.json())
		.then(({ html }) => html)
}

const loadCollectionItems = (id) => {
	return collectionsAjax.getCollectionItems(id)
		.then(res => res.json())
		.then(({ items, collection }) => { 
			return {
				items,
				collection, 
			}
		})
}

const displayCollectionItems = (items, collection) => {
	return collectionsAjax.getCollectionItemsHTML(items, collection)
		.then(res => res.json())
		.then(({ html }) => html)
}