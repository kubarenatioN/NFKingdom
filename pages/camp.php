<? $title = "Camp" ?>
<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/header.php' ?>

    <h3>Fighters for user #<span id="user-id-holder"></span></h3>

    <div id="camp" class="container">

    </div>

	<script src="/js/ajax.js"></script>
    <script src="/js/fights.service.js"></script>

    <!-- declared in header connection -->
    <!-- <script src="/js/users.ajax.js"></script>
    <script src="/js/users.service.js"></script> -->

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
        const userIdKey = CONST.userKey
		if (!localStorage.getItem(userIdKey)) {
			localStorage.setItem(userIdKey, 1)
		}
		const userId = localStorage.getItem(userIdKey);

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

<? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/footer/footer.php' ?>