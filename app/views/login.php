<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/login.css">
    <link rel="stylesheet" href="/static/header.css">
    <title>IUTables'O - Connexion</title>
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
    <div class="login-container">
        <h2>Connexion</h2>
        
        <form class="connexion" method="POST">
            <?php
                if (isset($erreur)) {echo "<p class='error-message'>$erreur</p>";}
            ?>
            <label for="email">E-mail :</label><br>
            <input type="email" name="email" placeholder="E-mail" required><br>
            <label for="password">Mot de passe :</label><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input type="submit" value="Se connecter">
            <p class="register-link">Pas encore inscrit ? <a href="/suscribe">Créez un compte</a></p>
        </form>
    </div>
</body>

<?php
require 'footer.php';
?>