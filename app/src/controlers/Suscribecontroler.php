<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Suscribecontroler extends Controler
{
    public function get(string $param): void
    {
        $this->render('register');
    }

    public function post(string $param): void
    {
        $userExists = false;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $adresse = $_POST['adresse'] . " " . $_POST['CP'] . " " . $_POST['Ville'];
        $tel = $_POST['tel'];

        $img = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/app/templates/images/"; 
            $target_file = $target_dir . basename($_FILES["image"]["name"]);  
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img = "/app/templates/images/" . basename($_FILES["image"]["name"]);  
            }
        }

        $jp = new JsonProvider();
        $users = $jp->loadUsers();
        foreach ($users as $user) {
            if ($user->getEmail() == $email || $user->getUsername() == $username) {
                $userExists = true;
                break;
            }
        }

        if ($userExists) {
            echo "<script>document.addEventListener('DOMContentLoaded', function() { showErrorModal(); });</script>";
        } else {
            $lastUser = end($users);
            $newId = $lastUser ? $lastUser->getId() + 1 : 1;
        
            $newUser = [
                "id" => $newId,
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "adresse" => $adresse,
                "telephone" => $tel,
                "imageprofil" => $img,
                "created_at" => date("Y-m-d H:i:s")
            ];
        
            $jp->uploadUsers($newUser);
        
            echo "<script>document.addEventListener('DOMContentLoaded', function() { showModal(); });</script>";
        }
        
        $this->render('login');
    }
}



