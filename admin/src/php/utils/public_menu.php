<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index_.php?page=accueil.php">KICKZ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navPublic">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navPublic">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=accueil.php">Accueil</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['client'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=commandes.php">Mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=panier.php">Panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="index_.php?page=disconnect.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=compte.php">Connexion / Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
