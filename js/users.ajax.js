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
	}
}