<?php

if (isset($_POST['submit_inscription'])) {
    $nom          = trim($_POST['nom'] ?? '');
    $prenom       = trim($_POST['prenom'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $mot_de_passe = trim($_POST['mot_de_passe'] ?? '');

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($mot_de_passe)) {
        $clientDAO = new ClientDAO($cnx);

        $existant = $clientDAO->getClientByEmail($email);
        if ($existant) {
            $erreur_inscription = "Un compte existe déjà avec cet email.";
        } else {
            $retour = $clientDAO->ajoutClient($nom, $prenom, $email, $mot_de_passe);
            if ($retour) {
                $succes_inscription = "Compte créé avec succès ! Vous pouvez vous connecter.";
            } else {
                $erreur_inscription = "Erreur lors de la création du compte.";
            }
        }
    } else {
        $erreur_inscription = "Veuillez remplir tous les champs.";
    }
}


if (isset($_POST['submit_connexion'])) {
    $email        = trim($_POST['email_cnx'] ?? '');
    $mot_de_passe = trim($_POST['mot_de_passe_cnx'] ?? '');

    if (!empty($email) && !empty($mot_de_passe)) {
        $clientDAO = new ClientDAO($cnx);
        $client    = $clientDAO->checkLogin($email, $mot_de_passe);
        if ($client) {
            $_SESSION['client'] = [
                'id_client' => $client->id_client,
                'nom'       => $client->nom,
                'prenom'    => $client->prenom,
                'email'     => $client->email,
            ];
            header('Location: index_.php?page=accueil.php');
            exit;
        } else {
            $erreur_connexion = "Email ou mot de passe incorrect.";
        }
    } else {
        $erreur_connexion = "Veuillez remplir tous les champs.";
    }
}


if (isset($_SESSION['client'])) {
    header('Location: index_.php?page=accueil.php');
    exit;
}
?>

<div class="container py-5" style="max-width: 500px;">


    <ul class="nav nav-tabs mb-4" id="compteTab">
        <li class="nav-item">
            <a class="nav-link <?= !isset($succes_inscription) ? 'active' : '' ?>"
               data-bs-toggle="tab" href="#connexion">Connexion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= isset($succes_inscription) ? 'active' : '' ?>"
               data-bs-toggle="tab" href="#inscription">Inscription</a>
        </li>
    </ul>

    <div class="tab-content">


        <div class="tab-pane fade <?= !isset($succes_inscription) ? 'show active' : '' ?>" id="connexion">
            <h4 class="mb-4">Connexion</h4>

            <?php if (isset($erreur_connexion)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erreur_connexion) ?></div>
            <?php endif; ?>

            <form method="post" action="index_.php?page=compte.php">
                <div class="mb-3">
                    <label for="email_cnx" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email_cnx" id="email_cnx" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe_cnx" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mot_de_passe_cnx" id="mot_de_passe_cnx" required>
                </div>
                <button type="submit" name="submit_connexion" class="btn btn-dark w-100">Se connecter</button>
            </form>
        </div>


        <div class="tab-pane fade <?= isset($succes_inscription) ? 'show active' : '' ?>" id="inscription">
            <h4 class="mb-4">Créer un compte</h4>

            <?php if (isset($erreur_inscription)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erreur_inscription) ?></div>
            <?php endif; ?>
            <?php if (isset($succes_inscription)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($succes_inscription) ?></div>
            <?php endif; ?>

            <form method="post" action="index_.php?page=compte.php">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
                </div>
                <button type="submit" name="submit_inscription" class="btn btn-dark w-100">Créer mon compte</button>
            </form>
        </div>

    </div>
</div>
