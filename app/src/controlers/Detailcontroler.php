<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;

class Detailcontroler extends Controler
{
    public function get(string $param): void
    {
        $jp = new JsonProvider(__DIR__ . "/../../data/restaurants_orleans.json");
        $restau = $jp->getById($param);
        $this->render('detail', ['restau' => $restau]);
    }
}