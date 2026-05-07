$(document).ready(function () {

    const searchBar      = document.getElementById('searchBar');
    const searchResults  = document.getElementById('searchResults');
    const accueilContent = document.getElementById('accueilContent');

    if (searchBar) {
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
                               <img src="${c.image ? c.image : 'https://placehold.co/400x300?text=' + encodeURIComponent(c.modele)}"
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
    }

});

$(document).on('click', '.btn-delete-chaussure', function (e) {
    if (!confirm('Supprimer cette chaussure ?')) {
        e.preventDefault();
    }
});
