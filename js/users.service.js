const getUser = (id) => {
	const userId = localStorage.getItem(id)
	if (userId === null) return "no user"
	return usersAjax.getUser(userId)
		.then(res => res.json())
		.then(({ user }) => user)
}

const updateUserAccount = (loot) => {
	const userId = localStorage.getItem(userIdKey)
	if (userId === null) return
	return usersAjax.addToAccount(userId, loot)
		.then(res => res.json())
		.then(({ user }) => user)
}

const displayUserProfile = (user) => {
	return usersAjax.getUserProfileHTML(user)
		.then(res => res.json())
		.then(({ html }) => html)
}