<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/register.css">
    <link rel="stylesheet" href="/static/header.css">
    <title>IUTables'O - Inscription</title>
    <script src="/static/scripts/script_popup.js" defer></script>
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
                        <form action="/logout" method="get">
                            <li><a id="deconnexion">Déconnexion</a></li>
                        </form>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

    <div class="register-container">
        <h2>Inscription</h2>
        <form method="POST" action="suscribe" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur :</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">E-mail :</label><br>
            <input type="email" id="email" name="email" placeholder="nom.prenom@example.com" required><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="tel">Téléphone :</label><br>
            <input type="tel" id="tel" name="tel" required><br>

            <label for="adresse">Adresse :</label><br>
            <input type="text" id="adresse" name="adresse" placeholder="Rue" required><br>
            <input type="text" id="CP" name="CP" placeholder="Code Postal" required>
            <input type="text" id="Ville" name="Ville" placeholder="Ville" required><br>

            <input type="file" id="image" name="image" required><br>

            <input type="submit" value="S'inscrire">
        </form>
    </div>
    

<!-- Pop-up de succès -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="reussite">Inscription réussie !</p>
    </div>
</div>
<!-- Pop-up d'erreur si l'utilisateur existe déjà -->
<div id="errorModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeErrorModal()">&times;</span>
        <p id="echec">Erreur : Cet utilisateur existe déjà !</p>
    </div>
</div>


<?php
require 'footer.php';
?>
