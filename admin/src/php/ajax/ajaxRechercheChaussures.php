<?php
session_start();
require '../db/db_pg_connect.php';
require '../classes/Autoloader.class.php';
Autoloader::register();
$cnx = Connexion::getInstance($dsn, $user, $pass);

$search = trim($_GET['q'] ?? '');

$query = "SELECT * FROM chaussure WHERE LOWER(modele) LIKE LOWER(:q) OR LOWER(marque) LIKE LOWER(:q) ORDER BY id_chaussure";
$stmt  = $cnx->prepare($query);
$stmt->bindValue(':q', '%' . $search . '%');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);

