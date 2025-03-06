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

        $jp = new JsonProvider();
        $users = $jp->loadUsers();
        

        foreach ($users as $user) {
            if ($user->getEmail() == $email) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['user_name'] = $user->getUsername();
                    $_SESSION['adresse'] = $user->getAdresse();
                    $_SESSION['tel'] = $user->getTelephone();
                    $_SESSION['img'] = $user->getImageProfil();
                    $_SESSION['loggedin'] = true;
                } else {
                    $error = "Mot de passe incorrect.";
                }
            } else {
                $error = "Aucun utilisateur trouvé avec cet e-mail.";
            }
        }
        $this->render('profil', ['erreur' => $error]);
    }
}
   