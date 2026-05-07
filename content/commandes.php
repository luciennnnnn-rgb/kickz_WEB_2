<?php
if (!isset($_SESSION['client'])) {
    header('Location: index_.php?page=compte.php');
    exit;
}

$commandeDAO        = new CommandeDAO($cnx);
$contenuCommandeDAO = new ContenuCommandeDAO($cnx);
$id_client          = $_SESSION['client']['id_client'];

if (isset($_POST['submit_commande'])) {
    $panier = $_SESSION['panier'] ?? [];

    if (!empty($panier)) {
        $id_commande = $commandeDAO->ajoutCommande($id_client);

        if ($id_commande) {
            foreach ($panier as $item) {
                $contenuCommandeDAO->ajoutContenuCommande(
                    $item['quantite'],
                    $item['prix'],
                    $id_commande,
                    $item['id_info_pointure']
                );
            }
            unset($_SESSION['panier']);
            $succes = "Votre commande #" . $id_commande . " a bien été enregistrée !";
        }
    }
}

$commandes = $commandeDAO->getCommandesByClient($id_client);
?>

<div class="container py-4" style="max-width: 800px;">
    <h3 class="fw-bold mb-4">Mes commandes</h3>

    <?php if (isset($succes)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['panier'])): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-semibold">Valider mon panier</div>
            <div class="card-body">
                <p>Cliquez sur le bouton ci-dessous pour confirmer votre commande.</p>
                <form method="post" action="index_.php?page=commandes.php">
                    <button type="submit" name="submit_commande" class="btn btn-dark">Confirmer la commande</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php if (empty($commandes)): ?>
        <p class="text-muted">Vous n'avez pas encore de commande.</p>
    <?php else: ?>
        <?php foreach ($commandes as $c): ?>
            <?php $contenu = $contenuCommandeDAO->getContenuByCommande($c['id_commande']); ?>
            <div class="card shadow-sm mb-3">
                <div class="card-header d-flex justify-content-between">
                    <span>Commande #<?= $c['id_commande'] ?> — <?= $c['date_achat'] ?></span>
                    <span><?= $c['statut_livraison'] ? 'Expédié' : 'En attente' ?></span>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Article</th>
                            <th>Pointure</th>
                            <th>Qté</th>
                            <th>Prix unitaire</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contenu as $ligne): ?>
                            <tr>
                                <td><?= htmlspecialchars($ligne['marque'] . ' — ' . $ligne['modele']) ?></td>
                                <td><?= $ligne['pointure'] ?></td>
                                <td><?= $ligne['quantite_achetee'] ?></td>
                                <td><?= number_format($ligne['prix_unitaire'], 2) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
