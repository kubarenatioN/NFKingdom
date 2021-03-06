let intervals = []

const clearIntervals = (intervals) => {
	intervals.forEach(i => clearInterval(i))
	return []
}

const startFight = (id) => {
	const req = {
		id,
	}
	return ajax.startFight(req)
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
			return updateUserAccount(userId, loot)
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
			node.outerHTML = html
			const btn = document.querySelector(`#w-${id} .start-fight__btn`)
			btn.addEventListener('click', () => {
				startFight(id)
			})
		})
}

const setupCountdown = (fighter) => {
	const {end_time, warrior_id} = fighter
	if (!end_time) return
	
	const now = Math.floor(Date.now() / 1000)
	const node = document.querySelector(`#w-${warrior_id}`).querySelector('.fighter__countdown')
	
	if (now > end_time) {
		node.innerHTML = 'time passed, can collect'
		finishFight(warrior_id)
		return
	}

	let duration = end_time - now
	node.innerHTML = `remain: ${duration} sec.`
	const intervalId = setInterval(() => {
		if (duration <= 1) {
			clearInterval(intervalId)
			finishFight(warrior_id)
			return
		}
		node.innerHTML = node.innerHTML = `remain: ${--duration} sec.`
	}, 1000)

	intervals.push(intervalId)

	return intervalId
}