const getUser = (id) => {
	const userId = localStorage.getItem(id)
	if (userId === null) return "no user"
	return usersAjax.getUser(userId)
		.then(res => res.json())
		.then(({ user }) => user)
}

const updateUserAccount = (userId, value) => {
	if (userId === null) return
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