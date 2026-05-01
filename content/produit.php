<?php
$id_chaussure = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_chaussure === 0) {
    include 'content/page404.php';
    exit;
}

$chaussureDAO = new ChaussureDAO($cnx);
$pointureDAO  = new InfoPointureDAO($cnx);

$chaussure = $chaussureDAO->getChaussureById($id_chaussure);

if (!$chaussure) {
    include 'content/page404.php';
    exit;
}

$pointures = $pointureDAO->getPointuresByChaussure($id_chaussure);
?>

<div class="container py-5">
    <a href="index_.php?page=catalogue.php" class="btn btn-outline-dark btn-sm mb-4">&larr; Retour au catalogue</a>

    <div class="row g-5">
        <div class="col-md-6">
            <img src="https://placehold.co/600x500?text=<?= urlencode($chaussure->modele) ?>"
                 class="img-fluid rounded shadow"
                 alt="<?= htmlspecialchars($chaussure->modele) ?>">
        </div>

        <div class="col-md-6">
            <span class="badge bg-dark mb-2"><?= htmlspecialchars($chaussure->marque) ?></span>
            <h2 class="mb-2"><?= htmlspecialchars($chaussure->modele) ?></h2>
            <p class="fs-3 fw-bold text-success mb-4"><?= number_format($chaussure->prix, 2) ?> €</p>

            <p class="text-muted mb-4"><?= htmlspecialchars($chaussure->description) ?></p>

            <div class="mb-4">
                <p class="fw-semibold mb-2">Pointures disponibles :</p>
                <div class="d-flex flex-wrap gap-2">
                    <?php if (!empty($pointures)): ?>
                        <?php foreach ($pointures as $p): ?>
                            <?php if ($p->stock > 0): ?>
                                <span class="badge border border-dark text-dark fs-6 px-3 py-2"><?= $p->pointure ?></span>
                            <?php else: ?>
                                <span class="badge border border-secondary text-secondary fs-6 px-3 py-2 text-decoration-line-through"><?= $p->pointure ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-danger">Aucune pointure disponible</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
