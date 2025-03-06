<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\Avis;

use IUT\dataprovider\JsonProvider;

class Detailcontroler extends Controler
{
    public function get(string $param): void
    {
        $jp = new JsonProvider();
        $restau = $jp->getById($param);
        $restau->setAvis($jp->getAvis($restau));
        $this->render('detail', ['restau' => $restau]);

    }

    public function post(string $param): void
    {
        $jp = new JsonProvider();
        $restau = $jp->getById($param);
        if($_POST["submit"] === "Ajouter un avis"){
            $user = $_SESSION["user"];
            $avis = new Avis($user, $restau, $_POST["commentaire"], intval($_POST["note"]));
            $jp->addAvis($avis);
            $this->redirectTo("/detail/".$param);
        }else{
            $user = $jp->getUser(intval($_POST["userId"]));
            $avis = new Avis($user, $restau, $_POST["commentaire"], intval($_POST["note"]));
            $jp->removeAvis($avis);
            $this->redirectTo("/detail/".$param);
        }
    }
}