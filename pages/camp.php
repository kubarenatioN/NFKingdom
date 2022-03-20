<?  
    $title = "Camp";
    $links = "<link rel='stylesheet' href='/styles/camp.css'>";
?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>


    <script src="/js/ajax.js"></script>
    <script src="/js/fights.service.js"></script>

    <h3>Fighters for user #<span id="user-id-holder"></span></h3>

    <div id="fighters" class="container">

    </div>
	
    <script>
        const userIdKey = CONST.userKey
		if (!localStorage.getItem(userIdKey)) {
			localStorage.setItem(userIdKey, 1)
		}
		const userId = localStorage.getItem(userIdKey);
    </script>

	<script>
		const userIdHeader = document.querySelector('#user-id-holder')
        userIdHeader.innerHTML = userId

		const camp = document.querySelector('#fighters')
        let warriors
        ajax.getUserFighters(userId)
            .then(response => response.json())
            .then(({fighters}) => {
                warriors = fighters
                return ajax.getFightersHTML(fighters)
            })
            .then(fighters => fighters.json())
            .then(fighters => {
                camp.innerHTML = fighters.html
            })
            .then(() => {
                return ajax.getAllWarriorsFights()
            })
            .then(res => res.json())
            .then(warriors => warriors.forEach(w => setupCountdown(w)))
    </script>

    <h3>Camp</h3>
    
    <div id="camp" class="camp">
        <div class="creation__wrapper">
            <h4>Create a Hero</h4>
            <div id="creation" class="creation">
                <div class="slot1__wrapper">
                    <div id="creation-slot-1" class="slot1 slot"></div>
                </div>
                <div id="creation-slot-2" class="slot2 slot"></div>
                <div id="creation-slot-3" class="slot3 slot"></div>
            </div>
            <button class="creation__btn" disabled>Create</button>
        </div>

        <div class="creatures__wrapper">
            <h4>Creatures</h4>
            <div id="creatures" class="creatures">
                
            </div>
        </div>

        <div class="inventory__wrapper">
            <h4>Inventory</h4>
            <div id="inventory" class="inventory">
                
            </div>
        </div>
    </div>
    
    <script src="/js/items.ajax.js"></script>
    <script src="/js/items.service.js"></script>

    <script>
        let inventoryItems
        let creatureItems
        
        // get user inventory
        const inventory = document.querySelector('#inventory')
        getItems(userId, "'weapons', 'defense'")
            .then(items => {
                inventoryItems = items
                return displayItems(items)
            })
            .then(html => inventory.innerHTML = html)


        // get user creatures
        const creatures = document.querySelector('#creatures')
        getItems(userId, "'creatures'")
            .then(creatures => {
                creatureItems = creatures
                return displayItems(creatures)
            })
            .then(html => creatures.innerHTML = html)
    </script>

    <!-- work with drag'n'drop & creation -->
    <script src="/node_modules/sortablejs/Sortable.js"></script>
    <script src="/js/sortable.config.js"></script>
    <script>
        const slot1 = document.querySelector('#creation-slot-1')
        const slot2 = document.querySelector('#creation-slot-2')
        const slot3 = document.querySelector('#creation-slot-3')
        
        const slotSortable1 = new Sortable(slot1, sortableOptions1)
        const slotSortable2 = new Sortable(slot2, sortableOptions2)
        const slotSortable3 = new Sortable(slot3, sortableOptions3)

        const creatureItemsSortable = new Sortable(creatures, sortableOptionsCreatures)
        const inventoryItemsSortable = new Sortable(inventory, sortableOptionsInventory)

        const createBtn = document.querySelector('.creation__btn')
        addEventListener('onSlot', (e) => {
            createBtn.disabled = e.detail.arr.filter(el => el).length !== 3
        })
        createBtn.addEventListener('click', (e) => {
            console.log(slotItems);
        })
    </script>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>