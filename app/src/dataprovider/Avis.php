<?php

namespace IUT\dataprovider;


class Avis
{
    private User $utilisateur;
    private Restaurant $restau;
    private string $commentaire;
    private int $note;
    public function __construct(User $utilisateur, Restaurant $restau, string $commentaire, int $note)
    {
        if ($note <= 0) {
            throw new \Exception("La note doit être un entier positif.");
        } else if ($note > 5) {
            throw new \Exception("La note doit être inférieure ou égale à 5.");
        }
        $this->utilisateur = $utilisateur;
        $this->restau = $restau;
        $this->commentaire = $commentaire;
        $this->note = $note;
    }
    public function renderStars(): string
    {
        $html = "<div class='stars-container' style='width: 4.5em;'>";
        $html .= "<div class='stars-background'>";
        $html .= "★★★★★";
        $html .= "</div>";
        $html .= "<div class='stars-filled' style='width: " . (($this->note / 5) * 100) . "%;'>";
        $html .= "★★★★★";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }
    public function render(string $route): string
    {
        $html = "<div class='avis'>";
         $html .= "<p><strong>Utilisateur : </strong><p class='comment'>" . ucfirst($this->utilisateur->getUsername()) . "</p></p>";
         $html .= "<p><strong>Restaurant : </strong><p class='comment'><a href='http://localhost:5000/detail/" . $this->restau->getOsmId() . "'>" . ucfirst($this->restau->getName()) . "</a></p></p>";
        $html .= "<p><strong>Commentaire : </strong><p class='comment'>" . ucfirst($this->commentaire) . "</p></p>";
        $html .= "<p><strong>Note : </strong><div class='notation-avis'>" . $this->note . "/5" . $this->renderStars() . "</p>";
        if($this->utilisateur->getId() == $_SESSION["user"]->getId()){
            $html .= "<form method='POST' action='".$route."/'>";
            $html .= "<input type='submit' name='submit' id='submit' value='🗑'></input>";
            $html .= "<input type='hidden' id='userId' name='userId' value='".$this->utilisateur->getId()."'/>";
            $html .= "<input type='hidden' id='restauId' name='restauId' value='".$this->restau->getOsmId()."'/>";
            $html .= "<input type='hidden' id='commentaire' name='commentaire' value='".$this->commentaire."'/>";
            $html .= "<input type='hidden' id='note' name='note' value='".$this->note."'/>";
            $html .= "</form>";
        }
        $html .= "</div></div>";
        return $html;
    }

    public static function renderForm(string $idRestau): string
    {
        $html = "<div class='avis-form'>";
        $html .= "<h3>Ajouter un avis</h3>";
        $html .= "<form action='/detail/".$idRestau."'method='POST'>";
        $html .= "<div>";
        $html .= "<label for='commentaire'>Votre commentaire :</label>";
        $html .= "<textarea class='avis-textarea' id='commentaire' name='commentaire' required></textarea>";
        $html .= "</div>";
        $html .= "<div>";
        $html .= "<label for='note'>Note :</label>";
        $html .= "<select id='note' name='note' required>";
        $html .= "<option value='1' class='stars-filled'>★</option>";
        $html .= "<option value='2' class='stars-filled'>★★</option>";
        $html .= "<option value='3' class='stars-filled'>★★★</option>";
        $html .= "<option value='4' class='stars-filled'>★★★★</option>";
        $html .= "<option value='5' class='stars-filled'>★★★★★</option>";
        $html .= "</select>";
        $html .= "</div>";
        $html .= "<div>";
        $html .= "<input type='submit' class='add-avis-btn' name='submit' id='submit' value='Ajouter un avis'></input>";
        $html .= "</div>";
        $html .= "</form>";
        $html .= "</div>";

        return $html;
    }

    public function getNote(): int
    {
        return $this->note;
    }
    public function setNote(int $note): void
    {
        $this->note = $note;
    }
    public function getUtilisateur(): User
    {
        return $this->utilisateur;
    }
    public function setUtilisateur(User $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }
    public function getCommentaire(): string
    {
        return $this->commentaire;
    }
    public function setCommentaire(string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restau;
    }

}