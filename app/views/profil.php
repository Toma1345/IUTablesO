<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/profil.css">
    <link rel="stylesheet" href="/static/header.css">
    <title>Mon Profil</title>
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
    <div class="profile-container">
        <div class="profile-photo">
            <img src="<?php echo $_SESSION['img'] ?>" alt="Photo de profil">
        </div>
        <div class="profile-info">
            <h2><?php echo $_SESSION['user_name'] ?></h2>
            <p><strong>Adresse :</strong> <?php echo $_SESSION['adresse'] ?></p>
            <p><strong>Téléphone :</strong> <?php echo $_SESSION['tel'] ?></p>
            <p><strong>Email :</strong> <?php echo $_SESSION['email'] ?></p>
        </div>
    </div>
</body>
</html>
<?php
require 'footer.php';
?>