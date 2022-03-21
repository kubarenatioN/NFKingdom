let slotItems = []
const ev = new CustomEvent('onSlot', {
	detail: { }
})
const dispatchOnSlot = (arr) => {
	ev.detail.arr = arr
	dispatchEvent(ev)
}
        
Sortable.returnItem = (returnTo, item) => {
	if (item) {
		returnTo.append(item)
	}
}

Sortable.isCursorInTarget = (e) => {
	const { x, y } = e.originalEvent
	const target = e.to.getBoundingClientRect()
	return !(x > target.right || x < target.left ||
		y < target.top || y > target.bottom)
}

const onItemAdd = function(e) {
	if (!Sortable.isCursorInTarget(e)) {
		Sortable.returnItem(e.from, e.item)
		return
	}
	const prevItem = slotItems[this.options.slotItem]
	slotItems[this.options.slotItem] = e.item
	dispatchOnSlot(slotItems)
	Sortable.returnItem(e.from, prevItem)
}

const onItemRemove = function() {
	slotItems[this.options.slotItem] = null
	dispatchOnSlot(slotItems)
}

const sortableOptions1 = {
	slotItem: 0,
	group: {
		name: 'slot1',
		put: 'creatures',
	},
	sort: false,
	onAdd: onItemAdd,
	onRemove: onItemRemove,
}
const sortableOptions2 = {
	slotItem: 1,
	group: {
		name: 'slot2',
		put: 'inventory'
	},
	sort: false,
	onAdd: onItemAdd,
	onRemove: onItemRemove,
}
const sortableOptions3 = {
	slotItem: 2,
	group: {
		name: 'slot3',
		put: 'inventory'
	},
	sort: false,
	onAdd: onItemAdd,
	onRemove: onItemRemove,
}

const sortableOptionsCreatures = {
	sort: false,
	animation: 200,
	group: {
		name: 'creatures',
		pull: true,
		put: 'slot1',
	},
	onSort: function(e) {
		const order = this.toArray();
		this.sort(order.sort(), true);
	},
}

const sortableOptionsInventory = {
	sort: false,
	animation: 200,
	group: {
		name: 'inventory',
		pull: true,
		put: ['slot2', 'slot3'],
	},
	onSort: function(e) {
		const order = this.toArray()
		const collator = new Intl.Collator([], {numeric: true})
		const sorted = order.sort((a, b) => collator.compare(a, b))
		this.sort(sorted, true);
	},
}