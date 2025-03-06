<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Logoutcontroler extends Controler
{
    public function get(string $param): void
    {
        $_SESSION['loggedin'] = false;
        $_SESSION['user']="";
        $this->render('login');
    }
}