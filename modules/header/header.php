<?
    require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/user_getter.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $title?></title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <? echo $links ?>
</head>
<body>
    <header class="header">
        <a href="/" class="logo">
            <span class="logo__text">NFKingdom</span>
        </a>    

        <? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/main_menu.php' ?>

        <?
            $user_id = get_user_id();
        ?>
        
        <div class="profile__wrapper">
            <a id="profile" class="profile" href="/pages/login.php">
                <?
                    if ($user_id == "") {
                        echo "Log In"; 
                    }
                ?>
            </a>
            <?
                if ($user_id != "") {
                    echo "<a class='profile__logout' href='/modules/login/auth-manager.php?action=logout'>Logout</a>"; 
                }
            ?>
        </div>
    </header>
<script src="/js/constants.js"></script>
<script src="/js/users.ajax.js"></script>
<script src="/js/users.service.js"></script>
<script>
    const profile = document.querySelector('#profile')
    const userId = '<? echo $user_id ?>'
    let userGold
    let userFavs
    console.log('u id:',userId);
    getUser(userId)
        .then(user => {
            userGold = user.gold
            userFavs = user.favorites.split('-')
            return displayUserProfile(user)
        })
        .then(html => profile.innerHTML = html)
        .catch(err => console.error(err))

    const getUserGold = () => userGold
    const setUserGold = (gold) => userGold = gold

    const getUserFavs = () => userFavs
    const setUserFavs = (favs, token) => {
        userFavs = favs
        setUserFavorites(userId, userFavs, token)
            .then(favs => { })
    }
</script>