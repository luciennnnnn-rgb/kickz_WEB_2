<?php
$chaussureDAO = new ChaussureDAO($cnx);
$pointureDAO  = new InfoPointureDAO($cnx);

if (isset($_POST['submit_stock'])) {
    $id_info_pointure = (int)$_POST['id_info_pointure'];
    $stock            = (int)$_POST['stock'];
    $pointureDAO->updateStock($id_info_pointure, $stock);
    header('Location: index_.php?page=gestion_stocks.php');
    exit;
}

$chaussures = $chaussureDAO->getAllChaussures();
?>

<div class="container py-4">
    <h3 class="fw-bold mb-4">Gestion des stocks</h3>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Pointure</th>
                    <th>Stock actuel</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($chaussures as $c): ?>
                    <?php $pointures = $pointureDAO->getPointuresByChaussure($c->id_chaussure); ?>
                    <?php if (!empty($pointures)): ?>
                        <?php foreach ($pointures as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($c->marque) ?></td>
                                <td><?= htmlspecialchars($c->modele) ?></td>
                                <td><?= $p->pointure ?></td>
                                <td><?= $p->stock ?></td>
                                <td>
                                    <form method="post" action="index_.php?page=gestion_stocks.php" class="d-flex gap-2">
                                        <input type="hidden" name="id_info_pointure" value="<?= $p->id_info_pointure ?>">
                                        <input type="number" name="stock" value="<?= $p->stock ?>" min="0" class="form-control form-control-sm" style="width: 80px;">
                                        <button type="submit" name="submit_stock" class="btn btn-dark btn-sm">OK</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td><?= htmlspecialchars($c->marque) ?></td>
                            <td><?= htmlspecialchars($c->modele) ?></td>
                            <td colspan="3" class="text-muted fst-italic">Aucune pointure</td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
