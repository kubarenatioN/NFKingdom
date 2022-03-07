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

	getCollectionItems: (id) => {
		const url = '/server/requests/get_collection_items.php'
		const payload = {
			id,
		} 
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getItem: (colId, itemId) => {
		const url = '/server/requests/get_item.php'
		const payload = {
			colId,
			itemId,
		} 
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getItemHTML: (col, item) => {
		const url = '/modules/views/item_view.php'
		const payload = {
			col,
			item,
		} 
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
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

	getCollectionItemsHTML: (items, collection) => {
		const url = '/modules/views/item_card.php'
		const payload = {
			items,
			collection,
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