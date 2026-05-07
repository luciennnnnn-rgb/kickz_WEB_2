<?php
if (!isset($_SESSION['client'])) {
    header('Location: index_.php?page=compte.php');
    exit;
}

if (isset($_GET['remove'])) {
    $cle = (int)$_GET['remove'];
    unset($_SESSION['panier'][$cle]);
    header('Location: index_.php?page=panier.php');
    exit;
}

$panier = $_SESSION['panier'] ?? [];
$total  = 0;
foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
}
?>

<div class="container py-4" style="max-width: 800px;">
    <h3 class="fw-bold mb-4">Mon panier</h3>

    <?php if (empty($panier)): ?>
        <p class="text-muted">Votre panier est vide.</p>
        <a href="index_.php?page=accueil.php" class="btn btn-dark">Continuer mes achats</a>
    <?php else: ?>
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>Article</th>
                        <th>Pointure</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($panier as $cle => $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['marque'] . ' — ' . $item['modele']) ?></td>
                            <td><?= $item['pointure'] ?></td>
                            <td><?= number_format($item['prix'], 2) ?> €</td>
                            <td><?= $item['quantite'] ?></td>
                            <td><?= number_format($item['prix'] * $item['quantite'], 2) ?> €</td>
                            <td>
                                <a href="index_.php?page=panier.php&remove=<?= $cle ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Retirer cet article ?')">✕</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold">Total : <?= number_format($total, 2) ?> €</h5>
            <a href="index_.php?page=commandes.php" class="btn btn-dark">Valider la commande</a>
        </div>
    <?php endif; ?>
</div>
