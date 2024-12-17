<?php

?>

<DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='/matchbreak/css/root.css' type='text/css'>
        <link rel='stylesheet' href='/matchbreak/css/base.css' type='text/css'>
        <title>기본틀</title>
    </head>
    <body>
        <header>
            <input type='checkbox' id='menuicon'>
            <label for='menuicon'>
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class='sidebar'>
                
            </div>
            <label for="menuicon">
                <div class='blind'></div>
            </label>

            <div id='logo-top'>
                <img src='/matchbreak/img/match_logo.svg'>
            </div>
            
            <a href='/matchbreak/member/mypage.php'>
                <img id='profil' src='/matchbreak/img/profil.svg'>
            </a>
        </header>
        <main>
            <div class='container'>
                <?php require ($_SERVER['DOCUMENT_ROOT'].'/matchbreak/inc/calendar/select_match.php'); ?>
            </div>
        </main>
    </body>
</html>