const usersAjax = {
	getUser: (id) => {
		const url = '/server/requests/get_user.php'
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

	getUserProfileHTML: (user) => {
		const url = '/modules/views/user_header_profile.php'
		const payload = {
			user,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	addToAccount: (id, value) => {
		const url = '/server/requests/update_user_account.php'
		const payload = {
			id,
			value,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	purchaseToken: (payload) => {
		const url = '/server/requests/purchase_token.php'
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getUserItems: (userId, itemsType) => {
		const url = '/server/requests/get_user_items.php'
		const payload = {
			userId,
			itemsType,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	createWarrior: (userId, name, items) => {
		const url = '/server/requests/create_user_warrior.php'
		const payload = {
			userId,
			name,
			items,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	setUserFavorites: (userId, favorites, token) => {
		const url = '/server/requests/set_favorites.php'
		const payload = {
			userId,
			favorites,
			token,
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