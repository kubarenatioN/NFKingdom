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