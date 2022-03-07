<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name here</title>
</head>
<style>
    .fighter__countdown {
        display: none;
    }
    .fighter__countdown.show {
        display: block;
    }
</style>
<body>
    <h1>Hello</h1>

    <p>
        <b>now: <? echo time()?></b>
    </p>

    <div id="camp" class="container">

    </div>

    <script src="js/ajax.js"></script>
    <script>
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
                .then(({newFighter}) => {
                    updateFighter(newFighter)
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

    </script>
    <?
        require_once 'modules/views/fighters_view.php';
        require_once 'server/requests/fighters.php';

        function loadWarriors() {
            $warriors = get_all_warriors();
            foreach ($warriors as $k => $w) {
                print_r($w);
                echo "<br>";
                $fighter_card_html = create_fighter_card($w);
                echo $fighter_card_html;
                echo "<br>";
            }
        }

        // loadWarriors();

        // $warriors_fights = get_all_warriors();
        // foreach ($warriors_fights as $k => $w) {
        //     print_r($w);
        //     echo "<br>";
        // }
        echo "<br>";
        $fights = get_all_warriors_fights();
        while($row = $fights->fetch_assoc()) {
            print_r($row);
            echo "<br>";
        }
    ?>

    <script>
        let warriors
        ajax.getAllFighters()
            .then(response => response.json())
            .then(({fighters}) => {
                warriors = fighters
                return ajax.getFightersHTML(fighters)
            })
            .then(fighters => fighters.json())
            .then(fighters => {
                const camp = document.querySelector('#camp')
                camp.innerHTML = fighters.html
            })
            .then(() => {
                return ajax.getAllWarriorsFights()
            })
            .then(res => res.json())
            .then(warriors => warriors.forEach(w => setupCountdown(w))) 
    </script>
</body>
</html>

