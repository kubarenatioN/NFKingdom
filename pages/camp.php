<? $title = "Camp" ?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

    <div id="camp" class="container">

    </div>

	<script src="/js/ajax.js"></script>
    <script src="/js/fights.service.js"></script>

    <?
        require_once $_SERVER['DOCUMENT_ROOT'].'/server/db/fighters_db.php';
        echo "<br>";
        $fights = get_all_warriors_fights();
        while($row = $fights->fetch_assoc()) {
            print_r($row);
            echo "<br>";
        }
    ?>

	<script>
		const userIdKey = 'userId'

		if (!localStorage.getItem(userIdKey)) {
			localStorage.setItem(userIdKey, 1)
		}
		const userId = localStorage.getItem(userIdKey);

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

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>