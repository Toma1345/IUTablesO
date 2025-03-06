<?php

namespace IUT\dataprovider;

use IUT\dataprovider\Avis;


class Restaurant
{
    private string $osmId;
    private float $longitude;
    private float $latitude;
    private string $type;
    private string $name;
    private ?string $operator;
    private ?string $brand;
    private ?array $openingHours;
    private ?bool $wheelchair;
    private array $cuisine;
    private ?bool $vegetarian;
    private ?bool $vegan;
    private ?bool $delivery;
    private ?bool $takeaway;
    private ?string $capacity;
    private ?bool $driveThrough;
    private ?string $phone;
    private ?string $website;
    private ?string $facebook;
    private string $region;
    private string $departement;
    private string $commune;
    private ?array $avis;

    public function __construct(
        float $longitude,
        float $latitude,
        string $osmId,
        string $type,
        string $name,
        ?string $operator,
        ?string $brand,
        ?string $openingHours,
        ?bool $wheelchair,
        array $cuisine,
        ?bool $vegetarian,
        ?bool $vegan,
        ?bool $delivery,
        ?bool $takeaway,
        ?string $capacity,
        ?bool $driveThrough,
        ?string $phone,
        ?string $website,
        ?string $facebook,
        string $region,
        string $departement,
        string $commune
    ) {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->osmId = $osmId;
        $this->type = $type;
        $this->name = $name;
        $this->operator = $operator;
        $this->brand = $brand;
        $this->openingHours = $this->parseOpeningHours($openingHours);
        $this->wheelchair = $wheelchair;
        $this->cuisine = $cuisine;
        $this->vegetarian = $vegetarian;
        $this->vegan = $vegan;
        $this->delivery = $delivery;
        $this->takeaway = $takeaway;
        $this->capacity = $capacity;
        $this->driveThrough = $driveThrough;
        $this->phone = $this->normalizePhoneNumber($phone);
        $this->website = $website;
        $this->facebook = $facebook;
        $this->region = $region;
        $this->departement = $departement;
        $this->commune = $commune;
    }

    public function setAvis(array $avis): void
    {
        $this->avis = $avis;
    }

    public function getAvis(): ?array
    {
        return $this->avis;
    }

    public function addAvis(Avis $avis): void
    {
        $this->avis[] = $avis;
    }


    private function normalizePhoneNumber(?string $phone): ?string
    {
        if ($phone === null) {
            return null;
        }
        return preg_replace('/\s+/', '', $phone);
    }

    function parseOpeningHours(?string $openingHours): ?array
    {
        if ($openingHours === null) {
            return null;
        }

        // Initialiser un tableau pour chaque jour de la semaine
        $hours = array_fill(0, 7, "");

        // Associer les abréviations des jours de la semaine à leurs indices
        $dayMap = [
            "Mo" => 0, "Tu" => 1, "We" => 2, "Th" => 3,
            "Fr" => 4, "Sa" => 5, "Su" => 6
        ];

        // Diviser l'entrée par les points-virgules pour séparer chaque plage
        $segments = preg_split('/[;,]/', $openingHours);

        foreach ($segments as $segment) {
            $segment = trim($segment);
            if (!$segment) continue;

            // Séparer jours et horaires
            $parts = explode(' ', $segment, 2);
            if (count($parts) < 2) continue; // Évite les erreurs d'index

            list($daysPart, $hoursPart) = $parts;

            // Vérifier si c'est une plage de jours (ex: "Mo-Th")
            if (strpos($daysPart, '-') !== false) {
                list($startDay, $endDay) = explode('-', $daysPart);
                if (isset($dayMap[$startDay]) && isset($dayMap[$endDay])) {
                    for ($i = $dayMap[$startDay]; $i <= $dayMap[$endDay]; $i++) {
                        $hours[$i] = $hoursPart;
                    }
                }
            }
            // Vérifier si c'est un seul jour (ex: "Fr")
            elseif (isset($dayMap[$daysPart])) {
                $hours[$dayMap[$daysPart]] = $hoursPart;
            }
            // Gérer les jours spéciaux comme "PH" (jours fériés)
            elseif ($daysPart === "PH") {
                // Vous pouvez ajouter une logique spécifique pour les jours fériés ici
                // Par exemple, appliquer les horaires aux dimanches
                $hours[6] = $hoursPart;
            }
        }

        // Remplacer les chaînes vides par "Fermé"
        foreach ($hours as &$hour) {
            if (empty($hour)) {
                $hour = "Fermé";
            }
        }

        return $hours;
    }


    public function renderCard(): string
    {
        $html = "<div class='restaurant-card'>";
        $html .= "<a class='restaurant-card-detail' href='/detail/" . $this->osmId . "'><h3>";
        $html .= ucfirst($this->getName());
        $html .= "</h3><p>Type : ";
        $html .= ucfirst(str_replace("_", " ", $this->getType()));
        $html .= "</p>";
        $html .= "<p>Horaires d'ouverture : ";
        $html .= "<ul>";
        if (isset($this->openingHours)) {
            $dayMap = [
                0 => "Lundi",
                1 => "Mardi",
                2 => "Mercredi",
                3 => "Jeudi",
                4 => "Vendredi",
                5 => "Samedi",
                6 => "Dimanche",
            ];
            foreach ($this->openingHours as $day => $hours) {
                $html .= "<li>" . $dayMap[$day] . " : " . ($hours ? $hours : "Fermé") . "</li>";
            }
        } else {
            $html .= "<li>Non renseigné</li>";
        }
        $html .= "</ul>";
        $html .= "</p>";
        if (isset($this->cuisine) && sizeof($this->cuisine) > 0) {
            $html .= "<p>Cuisine : ";
            $html .= "<ul>";
            foreach ($this->cuisine as $cuisine) {
                $html .= "<li>" . ucfirst($cuisine) . "</li>";
            }
            $html .= "</ul>";
            $html .= "</p>";
        } 
        if (isset($this->avis) && sizeof($this->avis) > 0) {
            $moyenne = array_sum(array_map(function ($a) {
                return $a->getNote();
            }, $this->avis)) / count($this->avis);
            $pourcentage = ($moyenne / 5) * 100;
            $html .= "<p>Note : " . round($moyenne, 2) . "/5</p>";
            $html .= "<div class='stars-container' style='width: 4.5em;'>";
            $html .= "<div class='stars-background'>";
            $html .= "★★★★★";
            $html .= "</div>";
            $html .= "<div class='stars-filled' style='width: " . $pourcentage . "%;'>";
            $html .= "★★★★★";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= "</a></div>";
        return $html;
    }

    public function renderDetail(): string
    {
        $html = "<section class='restaurant-detail'><h3>Information restaurant</h3>";
        $html .= "<div class='restaurant-info'>";
        $html .= "<p id='type'>Type : " . ucfirst(str_replace("_", " ", $this->getType())) . "</p>";
        $html .= "<h2>Horaires d'ouverture :</h2>";
        $html .= "<ul class='opening-hours'>";
        if (isset($this->openingHours)) {
            $dayMap = [
                0 => "Lundi",
                1 => "Mardi",
                2 => "Mercredi",
                3 => "Jeudi",
                4 => "Vendredi",
                5 => "Samedi",
                6 => "Dimanche",
            ];
            foreach ($this->openingHours as $day => $hours) {
                $html .= "<li>" . $dayMap[$day] . " : " . ($hours ? $hours : "Fermé") . "</li>";
            }
        } else {
            $html .= "<li>Non renseigné</li>";
        }
        $html .= "</ul>";
        if ($this->phone | $this->website) {
            $html .= "<h2>Contact :</h2>";
            // Contact (téléphone et site web)
            if ($this->phone) {
                $html .= "<p id='contact'><strong>Téléphone :</strong> <a href='tel:" . htmlspecialchars($this->phone) . "'>" . htmlspecialchars($this->phone) . "</a></p>";
            }
            if ($this->website) {
                $html .= "<p id='contact'><strong>Site web :</strong> <a href='" . htmlspecialchars($this->website) . "' target='_blank'>" . htmlspecialchars($this->website) . "</a></p>";
            }
        }
        $html .= "</div></section>";
        

        if (isset($this->cuisine) && !empty($this->cuisine)) {
            $html .= "<section class='restaurant-detail'><h3>Cuisine</h3>";
            $html .= "<ul>";
            foreach ($this->cuisine as $cuisine) {
                $html .= "<li>" . ucfirst($cuisine) . "</li>";
            }
            $html .= "</ul></section>";
        }

        $options = [];
        if ($this->vegetarian)
            $options[] = "Végétarien";
        if ($this->vegan)
            $options[] = "Végan";
        if ($this->delivery)
            $options[] = "Livraison disponible";
        if ($this->takeaway)
            $options[] = "À emporter disponible";
        if ($this->wheelchair)
            $options[] = "Accessible en fauteuil roulant";
        if (!empty($options)) {
            $html .= "<section class='restaurant-detail'><h3>Options</h3><ul>";
            foreach ($options as $option) {
                $html .= "<li>$option</li>";
            }
            $html .= "</ul></section>";
        }

        if (isset($this->avis) && !empty($this->avis)) {
            $moyenne = array_sum(array_map(function ($a) {
                return $a->getNote();
            }, $this->avis)) / count($this->avis);
            $pourcentage = ($moyenne / 5) * 100;
            $html .= "<section class='restaurant-detail'><h3>Note moyenne :</h3>";
            $html .= "<div class='notation-avis'>";
            $html .= "<p>" . round($moyenne, 2) . "/5</p>";
            $html .= "<div class='stars-container' style='width: 4.5em;'>";
            $html .= "<div class='stars-background'>";
            $html .= "★★★★★";
            $html .= "</div>";
            $html .= "<div class='stars-filled' style='width: " . $pourcentage . "%;'>";
            $html .= "★★★★★";
            $html .= "</div>";
            $html .= "</div></div>";
        }

        // Avis
        if (isset($this->avis) && sizeof($this->avis) > 0) {
            $html .= "<section class='avis-section'>";
            $html .= "<h3>Avis des utilisateurs</h3>";
            foreach ($this->avis as $avis) {
                $html .= $avis->render();
            }

            if($_SESSION["loggedin"]) $html .= Avis::renderForm($this->osmId);
            $html .= "</section>";
        } else {
            $html .= "<section class='restaurant-detail'><section class='avis-section'><p>Aucun avis pour le moment.</p>";
            if($_SESSION["loggedin"]) $html .= Avis::renderForm($this->osmId);
            $html .= "</section></section>";
        }

        // Carte Google Maps
        $html .= "</section><div class='map-container'>";
        $html .= "<iframe
            src='https://www.google.com/maps?q={$this->latitude},{$this->longitude}&z=15&output=embed'
            width='100%'
            height='300'
            frameborder='0'
            style='border:0'
            allowfullscreen
            aria-hidden='false'
            tabindex='0'></iframe>";
        $html .= "</div></section>";
        return $html;
    }


    public function getCoordinates(): array
    {
        return [
            'lat' => $this->latitude,
            'lon' => $this->longitude,
        ];
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    public function getOsmId(): string
    {
        return $this->osmId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getWheelchair(): ?bool
    {
        return $this->wheelchair;
    }

    public function getCuisine(): array
    {
        return $this->cuisine;
    }

    public function getVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function getVegan(): ?bool
    {
        return $this->vegan;
    }

    public function getDelivery(): ?bool
    {
        return $this->delivery;
    }

    public function getTakeaway(): ?bool
    {
        return $this->takeaway;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function getDriveThrough(): ?bool
    {
        return $this->driveThrough;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getDepartement(): string
    {
        return $this->departement;
    }

    public function getCommune(): string
    {
        return $this->commune;
    }

}
