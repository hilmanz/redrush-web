<?php

include_once "common.php";
include_once $ENGINE_PATH."Utility/SessionManager.php";
include_once $APP_PATH . APPLICATION . '/App.php';
include_once $APP_PATH."Interaction/Interaction.php";
$view = new BasicView();
$app = new App($req);
$app->main();
print $app;
die();