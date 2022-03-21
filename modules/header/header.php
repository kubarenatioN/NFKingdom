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
        <? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/main_menu.php' ?>

        <div id="profile" class="profile">
            
        </div>
    </header>
<script src="/js/constants.js"></script>
<script src="/js/users.ajax.js"></script>
<script src="/js/users.service.js"></script>
<script>
    const profile = document.querySelector('#profile')
    const userId = '<? echo get_user_id() ?>'
    console.log('u id:',userId);
    getUser(userId)
        .catch(err => console.log(err))
        .then(user => displayUserProfile(user))
        .then(html => profile.innerHTML = html)
</script>