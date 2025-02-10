<?php
session_start();

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
            <img src="<?php echo $_SESSION['img'] ?>" alt="Photo de profil">
        </div>
        <div class="profile-info">
            <h2><?php echo $_SESSION['user_name'] ?></h2>
            <p><strong>Adresse :</strong> <?php echo $_SESSION['adresse'] ?></p>
            <p><strong>Téléphone :</strong> <?php echo $_SESSION['tel'] ?></p>
            <p><strong>Email :</strong> <?php echo $_SESSION['user_id'] ?></p>
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