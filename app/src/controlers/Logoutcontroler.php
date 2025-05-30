<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Logoutcontroler extends Controler
{
    public function get(string $param): void
    {
        $_SESSION['loggedin'] = false;
        $jp = new JsonProvider();
        $_SESSION['user']=$jp->getUser(0);
        $this->render('login');
    }
}