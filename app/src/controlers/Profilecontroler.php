<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Profilecontroler extends Controler
{
    public function get(string $param): void
    {
        $jp = new JsonProvider();
        $restaurants = $jp->loadRestaurants();
        $this->render('profil');
    }
}