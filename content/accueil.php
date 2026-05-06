<?php
$chaussureDAO = new ChaussureDAO($cnx);
$pointureDAO  = new InfoPointureDAO($cnx);
$chaussures   = $chaussureDAO->getAllChaussures();
$topDeals     = array_slice($chaussures, 0, 6);
$selection    = array_slice(array_reverse($chaussures), 0, 6);
?>

<div class="container py-4">

    <div class="mb-5">
        <input type="text" id="searchBar" class="form-control form-control-lg"
               placeholder="Rechercher une marque ou un modèle...">
    </div>

    <div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5" style="display:none!important;"></div>

    <div id="accueilContent">
        <h4 class="fw-bold mb-4">TOP DEALS !!</h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
            <?php foreach ($topDeals as $chaussure): ?>
                <?php $pointures = $pointureDAO->getPointuresByChaussure($chaussure->id_chaussure); ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://placehold.co/400x300?text=<?= urlencode($chaussure->modele) ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($chaussure->modele) ?>">
                        <div class="card-body">
                            <p class="text-muted small mb-1"><?= htmlspecialchars($chaussure->marque) ?></p>
                            <h6 class="card-title"><?= htmlspecialchars($chaussure->modele) ?></h6>
                            <p class="fw-bold mb-2"><?= number_format($chaussure->prix, 2) ?> €</p>
                            <div class="d-flex flex-wrap gap-1">
                                <?php foreach ($pointures as $p): ?>
                                    <?php if ($p->stock > 0): ?>
                                        <span class="badge border border-dark text-dark"><?= $p->pointure ?></span>
                                    <?php else: ?>
                                        <span class="badge border border-secondary text-secondary text-decoration-line-through"><?= $p->pointure ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="index_.php?page=produit.php&id=<?= $chaussure->id_chaussure ?>"
                               class="btn btn-dark w-100 btn-sm">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-success text-white text-center py-4 px-3 rounded mb-5">
            <p class="mb-0 fs-5">L'essentiel des marques, la sérénité en plus. Voici ce qui définit l'expérience KICKZ</p>
        </div>

        <h4 class="fw-bold mb-4">La sélection du moment !!</h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($selection as $chaussure): ?>
                <?php $pointures = $pointureDAO->getPointuresByChaussure($chaussure->id_chaussure); ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://placehold.co/400x300?text=<?= urlencode($chaussure->modele) ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($chaussure->modele) ?>">
                        <div class="card-body">
                            <p class="text-muted small mb-1"><?= htmlspecialchars($chaussure->marque) ?></p>
                            <h6 class="card-title"><?= htmlspecialchars($chaussure->modele) ?></h6>
                            <p class="fw-bold mb-2"><?= number_format($chaussure->prix, 2) ?> €</p>
                            <div class="d-flex flex-wrap gap-1">
                                <?php foreach ($pointures as $p): ?>
                                    <?php if ($p->stock > 0): ?>
                                        <span class="badge border border-dark text-dark"><?= $p->pointure ?></span>
                                    <?php else: ?>
                                        <span class="badge border border-secondary text-secondary text-decoration-line-through"><?= $p->pointure ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="index_.php?page=produit.php&id=<?= $chaussure->id_chaussure ?>"
                               class="btn btn-dark w-100 btn-sm">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    const searchBar     = document.getElementById('searchBar');
    const searchResults = document.getElementById('searchResults');
    const accueilContent = document.getElementById('accueilContent');

    searchBar.addEventListener('input', function () {
        const q = this.value.trim();

        if (q.length === 0) {
            searchResults.style.display = 'none';
            accueilContent.style.display = 'block';
            return;
        }

        fetch('admin/src/php/ajax/ajaxRechercheChaussures.php?q=' + encodeURIComponent(q))
            .then(res => res.json())
            .then(data => {
                accueilContent.style.display = 'none';
                searchResults.style.removeProperty('display');

                if (data.length === 0) {
                    searchResults.innerHTML = '<p class="text-muted">Aucun résultat pour "' + q + '".</p>';
                    return;
                }

                searchResults.innerHTML = data.map(c => `
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://placehold.co/400x300?text=${encodeURIComponent(c.modele)}"
                             class="card-img-top" alt="${c.modele}">
                        <div class="card-body">
                            <p class="text-muted small mb-1">${c.marque}</p>
                            <h6 class="card-title">${c.modele}</h6>
                            <p class="fw-bold mb-2">${parseFloat(c.prix).toFixed(2)} €</p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="index_.php?page=produit.php&id=${c.id_chaussure}"
                               class="btn btn-dark w-100 btn-sm">Voir le produit</a>
                        </div>
                    </div>
                </div>
            `).join('');
            });
    });
</script>
