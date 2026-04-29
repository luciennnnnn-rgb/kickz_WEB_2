<?php
// Redirige vers le login si l'admin n'est pas connecté
if (!isset($_SESSION['admin'])) {
    header('Location: index_.php');
    exit;
}
