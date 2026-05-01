<?php
$root = str_replace('\\', '/', dirname(__DIR__, 4)) . '/';

include $root . 'admin/src/php/db/db_pg_connect.php';
include $root . 'admin/src/php/classes/Autoloader.class.php';
Autoloader::register();
$cnx = Connexion::getInstance($dsn, $user, $pass);