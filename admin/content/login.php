<?php
if (isset($_POST['submit_login'])) {
    $login        = trim($_POST['login'] ?? '');
    $mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

    if (!empty($login) && !empty($mot_de_passe)) {
        $query = "SELECT * FROM get_admin(:login::text, :mdp::text)";
        $stmt  = $cnx->prepare($query);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':mdp',   $mot_de_passe);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $_SESSION['admin'] = [
                'id_admin' => $admin['id_admin'],
                'login'    => $admin['login'],
            ];
            header('Location: index_.php');
            exit;
        } else {
            $erreur = "Identifiants incorrects.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<div class="container py-5" style="max-width: 400px;">
    <h3 class="mb-4 fw-bold">Administration KICKZ</h3>

    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>

    <form method="post" action="index_.php">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" name="login" id="login" required>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
        </div>
        <button type="submit" name="submit_login" class="btn btn-dark w-100">Se connecter</button>
    </form>
</div>
