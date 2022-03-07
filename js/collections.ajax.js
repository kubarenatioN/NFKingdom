'use strict'
const collectionsAjax = {
	getAllCollections: () => {
		const url = '/server/requests/get_collections.php'
		return fetch(url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getCollectionsHTML: (collections) => {
		const url = '/modules/views/collection_card.php'
		const payload = {
			collections,
		} 
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},
}