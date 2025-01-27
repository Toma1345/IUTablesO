<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUTables’O</title>
    <link rel="stylesheet" href="./../css/style.css">
    <nav>
        <ul>
            <li><img src="./../images/IUTables’O.png" alt="logo"></li>
            <li><a href="index.php">Accueil</a></li>
            <?php if (!isset($_SESSION['loggedin'])): ?>
                <li><a href="">Rechercher un restaurant</a></li>
                <li><a href="login.php">Connexion</a></li>
                <li><a href="register.php">Inscription</a></li>
            <?php else: ?>
                <li><a href="account.php">Compte</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</head>
