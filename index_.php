<?php

session_start();


if (isset($_GET['page']) && $_GET['page'] === 'disconnect.php') {
    session_destroy();
    header('Location: index_.php');
    exit;
}

require 'admin/src/php/utils/all_includes.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <title>KICKZ — L'essentiel des marques</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous" defer></script>
    <script src="admin/assets/js/fonctionsJquery.js" defer></script>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/style.css">
</head>
<body>
<div id="wrapper">
    <header id="header">
        <?php
        if (file_exists('admin/src/php/utils/public_menu.php')) {
            include 'admin/src/php/utils/public_menu.php';
        }
        ?>
    </header>

    <main id="main">
        <section id="contenu">
            <?php
            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = 'accueil.php';
            }
            if (isset($_GET['page'])) {
                $_SESSION['page'] = $_GET['page'];
            }

            $root = str_replace('\\', '/', dirname(__FILE__)) . '/';
            $path = $root . 'content/' . $_SESSION['page'];

            if (file_exists($path)) {
                include $path;
            } else {
                include $root . 'content/page404.php';
            }
            ?>
        </section>
    </main>

    <footer id="footer">
        <p>KICKZ &copy; 2026</p>
    </footer>
</div>
</body>
</html>