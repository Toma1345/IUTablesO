<?php
declare(strict_types=1);
namespace IUT\controlers;

use IUT\dataprovider\Avis;
use IUT\dataprovider\JsonProvider;

class Aviscontroler extends Controler
{
    public function get(string $param): void
    {
        $jp = new JsonProvider(__DIR__ . "/../../data/restaurants_orleans.json");
        $avis = $jp->getAvisByUser($_SESSION["user"]);
        $this->render('mesavis', ['avis' => $avis]);
    }

    public function post(string $param): void
    {
        $jp = new JsonProvider(__DIR__ . "/../../data/restaurants_orleans.json");
        $restau = $jp->getById($param);
        $user = $_SESSION["user"];
        $avis = new Avis($user, $restau, $_POST["commentaire"], intval($_POST["note"]));
        $jp->addAvis($avis);
        $this->redirectTo("/detail/".$param);
    }
}