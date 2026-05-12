<?php
session_start();
require '../db/db_pg_connect.php';
require '../classes/Autoloader.class.php';
Autoloader::register();
$cnx = Connexion::getInstance($dsn, $user, $pass);

$search = trim($_GET['q'] ?? '');

$chaussureDAO = new ChaussureDAO($cnx);
$data = $chaussureDAO->rechercherChaussures($search);

header('Content-Type: application/json');
echo json_encode($data);
