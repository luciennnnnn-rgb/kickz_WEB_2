<?php
$commandeDAO = new CommandeDAO($cnx);

if (isset($_POST['submit_statut'])) {
    $id_commande = (int)$_POST['id_commande'];
    $statut      = isset($_POST['statut_livraison']);
    $commandeDAO->updateStatut($id_commande, $statut);
    header('Location: index_.php?page=gestion_commandes.php');
    exit;
}

$commandes = $commandeDAO->getAllCommandes();
?>

<div class="container py-4">
    <h3 class="fw-bold mb-4">Gestion des commandes</h3>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($commandes)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">Aucune commande.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($commandes as $c): ?>
                        <tr>
                            <td><?= $c['id_commande'] ?></td>
                            <td><?= htmlspecialchars($c['nom'] . ' ' . $c['prenom']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= $c['date_achat'] ?></td>
                            <td><?= $c['statut_livraison'] ? 'Expédié' : 'En attente' ?></td>
                            <td>
                                <form method="post" action="index_.php?page=gestion_commandes.php" class="d-flex gap-2 align-items-center">
                                    <input type="hidden" name="id_commande" value="<?= $c['id_commande'] ?>">
                                    <div class="form-check mb-0">
                                        <input type="checkbox" class="form-check-input" name="statut_livraison"
                                            <?= $c['statut_livraison'] ? 'checked' : '' ?>>
                                        <label class="form-check-label">Expédié</label>
                                    </div>
                                    <button type="submit" name="submit_statut" class="btn btn-dark btn-sm">OK</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
