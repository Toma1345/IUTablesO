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
}