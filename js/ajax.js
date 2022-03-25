'use strict'
const ajax = {
	getAllFighters: () => {
		const url = '/server/requests/get_all_fighters.php'
		return fetch(url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getUserFighters: (userId) => {
		const url = '/server/requests/get_user_fighters.php'
		const payload = {
			userId,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	startFight: (params) => {
		const url = '/server/requests/start_fight.php'
		const data = {
			...params,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	collectLoot: (params) => {
		const url = '/server/requests/collect_loot.php'
		const data = {
			...params,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	updateFighterView: (newFighter) => {
		const url = '/modules/views/update_fighter_view.php'
		const data = {
			newFighter,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	finishFight: (params) => {
		const url = '/server/requests/finish_fight.php'
		const data = {
			...params,
		}
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getFightersHTML: (fighters) => {
		const url = '/modules/views/fighter_card.php'
		const payload = {
			fighters,
		} 
		return fetch(url, {
			method: 'POST',
			body: JSON.stringify(payload),
			headers: {
				'Content-Type': 'application/json',
			}
		})
	},

	getAllWarriorsFights: (userId) => {
		const url = '/server/requests/warriors_fights.php'
		const payload = {
			userId,
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