<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $title?></title>
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/header.css">
    <? echo $links ?>
</head>
<body>
    <header class="header">
        <? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/header/main_menu.php' ?>

        <? require_once $_SERVER['DOCUMENT_ROOT'].'/modules/user/active_user.php' ?>
    </header>