<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index_.php">KICKZ Admin</a>
        <?php if (isset($_SESSION['admin'])): ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navAdmin">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=accueil.php">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=gestion_chaussures.php">Chaussures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=gestion_stocks.php">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=gestion_commandes.php">Commandes</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-light">👤 <?= htmlspecialchars($_SESSION['admin']['login']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="index_.php?page=disconnect.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
