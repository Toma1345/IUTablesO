<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/header.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><img src="./../images/IUTables’O.png" alt="logo"></li>
                
                <div class="center-section">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a id="rechercher" href="recherche.php">Rechercher un restaurant</a></li>
                </div>

                <div class="right-section">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li><a id="connexion" href="login.php">Connexion</a></li>
                        <li><a id="inscription" href="register.php">Inscription</a></li>
                    <?php else: ?>
                        <li><a id="compte" href="profil.php">Mon compte</a></li>
                        <li><a id="deconnexion" href="logout.php">Déconnexion</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

