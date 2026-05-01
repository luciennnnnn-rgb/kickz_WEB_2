<?php

var_dump(file_exists('C:/xampp/htdocs/kickz/admin/src/php/db/db_pg_connect.php'));
var_dump(file_exists('C:/xampp/htdocs/kickz/admin/src/php/classes/Autoloader.class.php'));
die();
// Chemin absolu vers la racine du projet
$root = $_SERVER['DOCUMENT_ROOT'] . '/kickz/';

$pathDb         = $root . 'admin/src/php/db/db_pg_connect.php';
$pathAutoloader = $root . 'admin/src/php/classes/Autoloader.class.php';

if (file_exists($pathDb) && file_exists($pathAutoloader)) {
    include $pathDb;
    include $pathAutoloader;
    Autoloader::register();
    $cnx = Connexion::getInstance($dsn, $user, $pass);
} else {
    die("Impossible de charger les fichiers de configuration. <br>
         pathDb : $pathDb <br>
         pathAutoloader : $pathAutoloader");
}