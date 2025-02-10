<?php
ob_start();
session_start();

require 'header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents("users.json"), true);

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['email'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['adresse'] = $user['adresse'];
                $_SESSION['tel'] = $user['telephone'];
                $_SESSION['img'] = $user['imageprofil'];
                
                header('Location: profil.php');
                exit;
            } else {
                $error = "Mot de passe incorrect.";
            }
        }
    }

    $error = "Aucun utilisateur trouvé avec cet e-mail.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>IUTables'O - Connexion</title>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        
        <form method="POST">
            <?php
                if (isset($error)) {echo "<p class='error-message'>$error</p>";}
            ?>
            <label for="email">E-mail :</label><br>
            <input type="email" name="email" placeholder="E-mail" required><br>
            <label for="password">Mot de passe :</label><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input type="submit" value="Se connecter">
            <p class="register-link">Pas encore inscrit ? <a href="register.php">Créez un compte</a></p>
        </form>
    </div>
</body>

<?php
require 'footer.html';
ob_end_flush();
?>