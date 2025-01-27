<?php
namespace PHPSupabase;

require_once 'Auth.php';
require_once 'Service.php';

use PHPSupabase\Auth;
use PHPSupabase\Service;

// Paramètres de l'API Supabase
$apiKey = 'VOTRE_CLE_API'; // Remplacez par votre clé API
$apiUrl = 'https://votre-projet.supabase.co'; // Remplacez par l'URL de votre projet

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        header('Location: index.html?error=Veuillez remplir tous les champs');
        exit;
    }

    try {
        // Initialisation du service et de l'authentification
        $service = new Service($apiKey, $apiUrl);
        $auth = new Auth($service);

        // Connexion avec email et mot de passe
        $auth->signInWithEmailAndPassword($email, $password);
        $data = $auth->data();

        if(isset($data->access_token)){
            $userData = $data->user; //get the user data
            echo 'Login successfully for user ' . $userData->email;

    } catch(Exception $e){
        echo $auth->getError();
        // Gestion des erreurs
        header('Location: index.html?error=' . urlencode($e->getMessage()));
    }
}