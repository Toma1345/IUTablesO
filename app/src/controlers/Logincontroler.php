<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Logincontroler extends Controler
{
    public function get(string $param): void
    {
        $this->render('login');
    }

    public function post(string $param): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $users = json_decode(file_get_contents("users.json"), true);

        $_SESSION['loggedin'] = true;

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
}
   