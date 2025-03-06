<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes avis - IUTables'O</title>
    <link rel="stylesheet" href="/static/mesavis.css">
    <link rel="stylesheet" href="/static/header.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon" />
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><img src="/static/images/IUTables’O.png" alt="logo"></li>

                <div class="center-section">
                    <li><a href="/">Accueil</a></li>
                    <li><a id="rechercher" href="/search">Rechercher un restaurant</a></li>
                </div>

                <div class="right-section">
                    <?php if ($_SESSION['loggedin']==false): ?>
                        <li><a id="connexion" href="/login">Connexion</a></li>
                        <li><a id="inscription" href="/suscribe">Inscription</a></li>
                    <?php else: ?>
                        <li><a id="compte" href="/me">Mon compte</a></li>
                        <li><a id="compte" href="/mesavis">Mes avis</a></li>
                        <li><a id="deconnexion" href="/logout">Déconnexion</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <section class="intro">
            <h1>Mes avis</h1>
        </section>
        <section class="restaurant-detail">
            <section class='avis-section'>
                <h3>Vos avis</h3>
                <?php
                foreach ($avis as $currAvis) {
                    echo $currAvis->render("/mesavis");
                }
                ?>
            </section>
        </section>
    </main>
<?php
    require 'footer.php';
?>
</body>

</html>