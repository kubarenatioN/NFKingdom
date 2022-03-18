<?  
    $title = "Camp";
    $links = "<link rel='stylesheet' href='/styles/camp.css'>";
?>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>


    <script src="/js/ajax.js"></script>
    <script src="/js/fights.service.js"></script>

    <h3>Fighters for user #<span id="user-id-holder"></span></h3>

    <div id="camp" class="container">

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

		const camp = document.querySelector('#camp')
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

    <h3>Inventory</h3>
    
    <div id="inventory" class="inventory">

    </div>
    
    <script src="/js/items.ajax.js"></script>
    <script src="/js/items.service.js"></script>

    <script>
        // get user inventory
        const inventory = document.querySelector('#inventory')
        getItems(userId)
            .then(items => displayItems(items))
            .then(html => inventory.innerHTML = html)
    </script>

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>