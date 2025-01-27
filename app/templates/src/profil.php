<?php
require 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Mon Profil</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-photo">
            <img src="../images/profil_user.png" alt="Photo de profil">
        </div>
        <div class="profile-info">
            <h2>Jean Dupont</h2>
            <p><strong>Adresse :</strong> 123 Rue de Paris, 75000 Paris</p>
            <p><strong>Téléphone :</strong> +33 6 12 34 56 78</p>
            <p><strong>Email :</strong> jean.dupont@example.com</p>
        </div>
    </div>
    <div class="profile-container">
        <div class="profile-info">
            <h2>Mes commentaires et avis</h2>
            <p><strong>Chat + :</strong> "Très bon restaurant où on peut personnaliser à notre guise les gauffres".</p>
        </div>
    </div>
</body>
</html>
<?php
require 'footer.html';
?>