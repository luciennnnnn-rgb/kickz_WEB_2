<?php
$chaussureDAO = new ChaussureDAO($cnx);
$pointureDAO  = new InfoPointureDAO($cnx);

if (isset($_POST['submit_ajout'])) {
    $modele      = trim($_POST['modele'] ?? '');
    $marque      = trim($_POST['marque'] ?? '');
    $prix        = (float)($_POST['prix'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    if (!empty($modele) && !empty($marque) && $prix > 0) {
        $chaussureDAO->ajoutChaussure($modele, $marque, $prix, $description);
    }
}

if (isset($_POST['submit_pointure'])) {
    $id_chaussure = (int)$_POST['id_chaussure'];
    $pointure     = (int)$_POST['pointure'];
    $stock        = (int)$_POST['stock'];

    if ($id_chaussure > 0 && $pointure > 0) {
        $pointureDAO->ajoutInfoPointure($pointure, $stock, $id_chaussure);
    }
}

if (isset($_GET['delete'])) {
    $chaussureDAO->effacerChaussure((int)$_GET['delete']);
    header('Location: index_.php?page=gestion_chaussures.php');
    exit;
}

$chaussures = $chaussureDAO->getAllChaussures();
?>

<div class="container py-4">
    <h3 class="fw-bold mb-4">Gestion des chaussures</h3>

    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-semibold">Ajouter une chaussure</div>
        <div class="card-body">
            <form method="post" action="index_.php?page=gestion_chaussures.php">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Modèle</label>
                        <input type="text" class="form-control" name="modele" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Marque</label>
                        <input type="text" class="form-control" name="marque" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" class="form-control" name="prix" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                </div>
                <button type="submit" name="submit_ajout" class="btn btn-dark mt-3">Ajouter</button>
            </form>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-semibold">Ajouter une pointure</div>
        <div class="card-body">
            <form method="post" action="index_.php?page=gestion_chaussures.php">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Chaussure</label>
                        <select class="form-select" name="id_chaussure" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($chaussures as $c): ?>
                                <option value="<?= $c->id_chaussure ?>"><?= htmlspecialchars($c->marque . ' — ' . $c->modele) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pointure</label>
                        <input type="number" class="form-control" name="pointure" min="30" max="50" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" min="0" required>
                    </div>
                </div>
                <button type="submit" name="submit_pointure" class="btn btn-dark mt-3">Ajouter la pointure</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header fw-semibold">Liste des chaussures</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Prix</th>
                    <th>Pointures</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($chaussures as $c): ?>
                    <?php $pointures = $pointureDAO->getPointuresByChaussure($c->id_chaussure); ?>
                    <tr>
                        <td><?= $c->id_chaussure ?></td>
                        <td><?= htmlspecialchars($c->marque) ?></td>
                        <td><?= htmlspecialchars($c->modele) ?></td>
                        <td><?= number_format($c->prix, 2) ?> €</td>
                        <td>
                            <?php foreach ($pointures as $p): ?>
                                <span class="badge bg-secondary"><?= $p->pointure ?></span>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <a href="index_.php?page=gestion_chaussures.php&delete=<?= $c->id_chaussure ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cette chaussure ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
