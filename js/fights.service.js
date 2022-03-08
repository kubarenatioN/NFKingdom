const startFight = (id, e) => {
	const req = {
		id,
	}
	ajax.startFight(req)
		.then(response => response.json())
		.then(({warrior, countdown}) => {
			return Promise.all([countdown, updateFighter(warrior)])
		})
		.then(([countdown]) => setupCountdown(countdown))
}

const collectLoot = (id, e) => {
	const req = {
		warriorId: id,
	}
	ajax.collectLoot(req)
		.then(response => response.json())
		.then(({newFighter, loot}) => {
			updateFighter(newFighter)
			return updateUserAccount(loot)
			// TODO: update user view!!!
		})
		.then((user) => {
			return displayUserProfile(user)
		})
		.then(html => {
			profile.innerHTML = html
		})
}

const finishFight = (warrior_id) => {
	const req = {
		warrior_id,
	}
	ajax.finishFight(req)
		.then(res => res.json())
		.then(({newFighter}) => {
			updateFighter(newFighter)
		})
}

const updateFighter = (newFighter) => {
	const { id } = newFighter
	return ajax.getFightersHTML([newFighter])
		.then(response => response.json())
		.then(({html}) => {
			const node = document.querySelector(`#w-${id}`)
			node.innerHTML = html
		})
}

const setupCountdown = (fighter) => {
	const {end_time, start_time, warrior_id} = fighter
	if (!end_time) return
	
	const now = Math.floor(Date.now() / 1000)
	const node = document.querySelector(`#w-${warrior_id}`)
		.querySelector('.fighter__countdown')
	if (now > end_time) {
		node.innerHTML = 'time passed, can collect'
		finishFight(warrior_id)
		return
	}

	let duration = end_time - now
	node.innerHTML = duration
	const intervalId = setInterval(() => {
		if (duration <= 1) {
			clearInterval(intervalId)
			finishFight(warrior_id)
			return
		}
		node.innerHTML = --duration
	}, 1000)
}