const getUser = (id) => {
	// const userId = localStorage.getItem(id)
	if (id === '') return Promise.reject("no user")
	return usersAjax.getUser(id)
		.then(res => res.json())
		.then(({ user }) => user)
}

const updateUserAccount = (userId, value) => {
	if (userId === '') return
	return usersAjax.addToAccount(userId, value)
		.then(res => res.json())
		.then(({ user }) => user)
}

const displayUserProfile = (user) => {
	return usersAjax.getUserProfileHTML(user)
		.then(res => res.json())
		.then(({ html }) => html)
}

const purchaseToken = (payload) => {
	return usersAjax.purchaseToken(payload)
		.then(res => res.json())
		.then(data => data)
}

const getItems = (userId, type) => {
	return usersAjax.getUserItems(userId, type)
		.then(res => res.json())
		.then(({ items }) => items)
}

const getCreatures = (userId) => {
	return usersAjax.getUserItems(userId)
		.then(res => res.json())
		.then(({ items }) => items)
}

const createWarrior = (userId, name, items) => {
	return usersAjax.createWarrior(userId, name, items)
		.then(res => res.json())
		.then(data => {
			const newWarriorId = data['warrior_id']
			// return getItems(userId, 'creatures')
			return newWarriorId
		})
}

const setUserFavorites = (userId, favorites, token) => {
	return usersAjax.setUserFavorites(userId, favorites, token)
		.then(res => res.json())
		.then(data => data)
}