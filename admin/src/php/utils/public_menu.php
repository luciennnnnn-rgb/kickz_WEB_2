<?php // Menu public — sera complété lors du commit CSS/DA ?>
<nav id="public_nav">
    <a href="index_.php">Accueil</a>
    <a href="index_.php?page=catalogue.php">Catalogue</a>
    <?php if (isset($_SESSION['client'])): ?>
        <a href="index_.php?page=compte.php">Mon compte</a>
        <a href="index_.php?page=panier.php">Panier</a>
        <a href="index_.php?page=commandes.php">Mes commandes</a>
    <?php else: ?>
        <a href="index_.php?page=compte.php">Connexion</a>
    <?php endif; ?>
</nav>
