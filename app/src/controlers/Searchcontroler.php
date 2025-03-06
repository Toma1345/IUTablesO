<?php
declare(strict_types=1);

namespace IUT\controlers;

use IUT\dataprovider\JsonProvider;
use IUT\dataprovider\Restaurant;

class Searchcontroler extends Controler
{
    public function get(string $param): void
    {
        $jp = new JsonProvider(__DIR__ . "/../../data/restaurants_orleans.json");
        $restaurants = $jp->loadRestaurants();

        // Récupérer les filtres appliqués
        $searchQuery = isset($_GET['recherche']) ? $_GET['recherche'] : '';
        $selectedTypes = isset($_GET['type']) && is_array($_GET['type']) ? $_GET['type'] : [];
        $selectedCuisines = isset($_GET['cuisine']) && is_array($_GET['cuisine']) ? $_GET['cuisine'] : [];
        $isVegetarian = isset($_GET['vegetarian']) ? true : false;
        $isVegan = isset($_GET['vegan']) ? true : false;
        $hasDrive = isset($_GET['drive_through']) ? true : false;
        $hasDelivery = isset($_GET['delivery']) ? true : false;
        $hasTakeaway = isset($_GET['takeaway']) ? true : false;

        $filteredRestaurants = array_filter($restaurants, function($restaurant) use ($searchQuery, $selectedTypes, $selectedCuisines, $isVegetarian, $isVegan, $hasDrive, $hasDelivery, $hasTakeaway) {
            if ($searchQuery && stripos($restaurant->getName(), $searchQuery) === false) {
                return false;
            }
            if (!empty($selectedTypes) && !in_array($restaurant->getType(), $selectedTypes)) {
                return false;
            }
            if (!empty($selectedCuisines) && !array_intersect($selectedCuisines, $restaurant->getCuisine())) {
                return false;
            }
            if ($isVegetarian && !$restaurant->getVegetarian()) {
                return false;
            }
            if ($isVegan && !$restaurant->getVegan()) {
                return false;
            }
            if ($hasDrive && !$restaurant->getDriveThrough()) {
                return false;
            }
            if ($hasDelivery && !$restaurant->getDelivery()) {
                return false;
            }
            if ($hasTakeaway && !$restaurant->getTakeaway()) {
                return false;
            }
            return true;
        });
        
        
        $this->render('recherche', ['restaurants' => $filteredRestaurants]);
    }
}