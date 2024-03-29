<?php
session_start();

/* The directory containing php files */
const APP_DIR = '../app/';

include_once APP_DIR . 'Validator.php';
include_once APP_DIR . 'StatusSetter.php';
include_once APP_DIR . 'ContentManager.php';
include_once APP_DIR . 'DataCollector.php';

/* Validates all input passed in $_POST variable and sets invalid validation messages */
$validator = new Validator();
/* Writes user data into a json file */
$dataCollector = new DataCollector();
/* Sets status according to the validation results */
$statusSetter = new StatusSetter();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login on Game of Thrones</title>
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|EB+Garamond&display=swap"
          rel="stylesheet">
    <link type="text/css" href="css/slick.css" rel="stylesheet"/>
    <link type="text/css" href="css/slick-theme.css" rel="stylesheet"/>
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/select2-bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
<div class="left">
    <div class="slider" id="wraper">
        <div><img src="img/arryn.jpg" alt="House Arryn" class="slider__img"></div>
        <div><img src="img/baratheon.jpg" alt="House Baratheon" class="slider__img"></div>
        <div><img src="img/greyjoy.jpg" alt="House Greyjoy" class="slider__img"></div>
        <div><img src="img/martell.jpg" alt="House Martell" class="slider__img"></div>
        <div><img src="img/lannister.jpg" alt="House Lannister" class="slider__img"></div>
        <div><img src="img/stark.jpg" alt="House Stark" class="slider__img"></div>
        <div><img src="img/targaryen.jpg" alt="House Targaryen" class="slider__img"></div>
        <div><img src="img/tully.jpg" alt="House Tully" class="slider__img"></div>
        <div><img src="img/tyrell.jpg" alt="House Tyrell" class="slider__img"></div>
    </div>
</div>
<div class="right">
    <h1>GAME OF THRONES</h1>
    <?php ContentManager::getContent(); ?>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script src="<?php print ContentManager::getScriptPath() ?>"></script>
</body>
</html>