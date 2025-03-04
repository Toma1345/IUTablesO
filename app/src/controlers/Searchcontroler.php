<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;
use IUT\dataprovider\Restaurant;

class Searchcontroler extends Controler
{
    public function get(string $param): void
    {
        $this->render('search');
    }

    public function post(string $param): void
    {

        $jp = new JsonProvider(__DIR__ . "/../../data/restaurants_orleans.json");
        $restaurants = $jp->loadRestaurants();

        // Récupérer les filtres appliqués
        $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
        $selectedTypes = isset($_POST['type']) ? $_POST['type'] : [];
        $selectedCuisines = isset($_POST['cuisine']) ? $_POST['cuisine'] : [];
        $isVegetarian = isset($_POST['vegetarian']) ? true : false;
        $isVegan = isset($_POST['vegan']) ? true : false;
        $hasDrive = isset($_POST['drive']) ? true : false;

        // Filtrer les restaurants en fonction des critères
        $filteredRestaurants = array_filter($restaurants, function($restaurant) use ($searchQuery, $selectedTypes, $selectedCuisines, $isVegetarian, $isVegan, $hasDrive) {
            // Recherche par nom
            if ($searchQuery && stripos($restaurant->getName(), $searchQuery) === false) {return false;}
            // Filtrer par type
            if ($selectedTypes && !in_array($restaurant->getType(), $selectedTypes)) {return false;}
            // Filtrer par cuisine
            if ($selectedCuisines && !array_intersect($selectedCuisines, $restaurant->getCuisine())) {return false;}
            // Vérifier options végétariennes, véganes, et drive
            if ($isVegetarian && !$restaurant->getVegetarian()) {return false;}
            if ($isVegan && !$restaurant->getVegan()) {return false;}
            if ($hasDrive && !$restaurant->getDriveThrough()) {return false;}
        });
        
        $this->render('search', ['restaurants' => $restau]);
    }
}