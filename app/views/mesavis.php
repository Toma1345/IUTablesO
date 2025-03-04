<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes avis - IUTables'O</title>
    <link rel="stylesheet" href="/assets/styles.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon" />
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><img src="./../images/IUTables’O.png" alt="logo"></li>

                <div class="center-section">
                    <li><a href="/">Accueil</a></li>
                    <li><a id="rechercher" href="recherche.php">Rechercher un restaurant</a></li>
                </div>

                <div class="right-section">
                    <?php if (!isset($_SESSION['loggedin'])): ?>
                        <li><a id="connexion" href="/login">Connexion</a></li>
                        <li><a id="inscription" href="/suscribe">Inscription</a></li>
                    <?php else: ?>
                        <li><a id="compte" href="/me">Mon compte</a></li>
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
                    echo $currAvis->render();
                }
                ?>
            </section>
        </section>
    </main>
    <footer>
        <p>Chef de projet : Thomas Brossier - Membres de l'équipe : Nicolas Nauche, Kylian Dumas, Claire Deneau</p>
    </footer>
</body>

</html>