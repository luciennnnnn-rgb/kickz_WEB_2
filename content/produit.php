<?php
$id_chaussure = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_chaussure === 0) {
    include 'content/page404.php';
    exit;
}

$chaussureDAO = new ChaussureDAO($cnx);
$pointureDAO  = new InfoPointureDAO($cnx);
$chaussure    = $chaussureDAO->getChaussureById($id_chaussure);

if (!$chaussure) {
    include 'content/page404.php';
    exit;
}

$pointures = $pointureDAO->getPointuresByChaussure($id_chaussure);
$pointuresDispos = array_filter($pointures, fn($p) => $p->stock > 0);

if (isset($_POST['submit_panier'])) {
    if (!isset($_SESSION['client'])) {
        header('Location: index_.php?page=compte.php');
        exit;
    }
    $id_info_pointure = (int)$_POST['id_info_pointure'];
    $quantite         = (int)$_POST['quantite'];

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    $cle = $id_info_pointure;
    if (isset($_SESSION['panier'][$cle])) {
        $_SESSION['panier'][$cle]['quantite'] += $quantite;
    } else {
        $_SESSION['panier'][$cle] = [
                'id_info_pointure' => $id_info_pointure,
                'id_chaussure'     => $chaussure->id_chaussure,
                'modele'           => $chaussure->modele,
                'marque'           => $chaussure->marque,
                'prix'             => $chaussure->prix,
                'quantite'         => $quantite,
        ];
        foreach ($pointures as $p) {
            if ($p->id_info_pointure === $id_info_pointure) {
                $_SESSION['panier'][$cle]['pointure'] = $p->pointure;
                break;
            }
        }
    }
    header('Location: index_.php?page=panier.php');
    exit;
}
?>

<div class="container py-5">
    <a href="index_.php?page=accueil.php" class="btn btn-outline-dark btn-sm mb-4">&larr; Retour à l'accueil</a>

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

            <?php if (!empty($pointuresDispos)): ?>
                <form method="post" action="index_.php?page=produit.php&id=<?= $chaussure->id_chaussure ?>">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pointure</label>
                        <select class="form-select" name="id_info_pointure" required>
                            <?php foreach ($pointuresDispos as $p): ?>
                                <option value="<?= $p->id_info_pointure ?>"><?= $p->pointure ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Quantité</label>
                        <input type="number" class="form-control" name="quantite" value="1" min="1" max="5">
                    </div>
                    <button type="submit" name="submit_panier" class="btn btn-dark w-100">Ajouter au panier</button>
                </form>
            <?php else: ?>
                <p class="text-danger fw-semibold">Aucune pointure disponible en stock.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
