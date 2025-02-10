<!-- Fichier rechercher.php -->

<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de restaurants</title>
    <script src="./../../scripts/script_recherche.js" defer></script>
    <link rel="stylesheet" href="./../css/style_recherche.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <form method="GET" action="recherche.php">
                <div class="search">
                    <h2>Recherche par nom :</h2>
                    <input id="searchbar" type="search" name="search" placeholder="Rechercher un restaurant ...">
                </div>

                <h2>Ou par critères</h2>
                <div class="types">
                    <h2>Par types :</h2>
                    <label><input type="checkbox" name="type[]" value="bar"> Bar</label>
                    <label><input type="checkbox" name="type[]" value="restaurant"> Restaurant</label>
                    <label><input type="checkbox" name="type[]" value="fast_food"> Fast-food</label>
                    <label><input type="checkbox" name="type[]" value="pub"> Pub</label>
                    <label><input type="checkbox" name="type[]" value="cafe"> Café</label>
                    <label><input type="checkbox" name="type[]" value="ice_cream"> Glacier</label>
                </div>

                <div class="cuisine">
                    <h2>Par cuisines :</h2>
                    <label><input type="checkbox" name="cuisine[]" value="salad"> Salade</label>
                    <label><input type="checkbox" name="cuisine[]" value="chicken"> Poulet</label>
                    <label><input type="checkbox" name="cuisine[]" value="fish"> Poisson</label>
                    <label><input type="checkbox" name="cuisine[]" value="kebab"> Kebab</label>
                    <label><input type="checkbox" name="cuisine[]" value="tacos"> Tacos</label>
                    <label><input type="checkbox" name="cuisine[]" value="pizza"> Pizza</label>
                    <label><input type="checkbox" name="cuisine[]" value="grill"> Grill</label>
                    <label><input type="checkbox" name="cuisine[]" value="seafood"> Mer</label>

                    <label><input type="checkbox" name="cuisine[]" value="gastronomique"> Gastronomique</label>
                    <label><input type="checkbox" name="cuisine[]" value="traditional"> Traditionnel</label>
                    <label><input type="checkbox" name="cuisine[]" value="regional"> Régional</label>
                    <label><input type="checkbox" name="cuisine[]" value="bavarian"> Bavaroise</label>

                    <label><input type="checkbox" name="cuisine[]" value="french"> Français</label>
                    <label><input type="checkbox" name="cuisine[]" value="afro-latine"> Afro-Latine</label>
                    <label><input type="checkbox" name="cuisine[]" value="italian"> Italien</label>
                    <label><input type="checkbox" name="cuisine[]" value="maxican"> Mexicain</label>
                    <label><input type="checkbox" name="cuisine[]" value="korean"> Coréen</label>
                    <label><input type="checkbox" name="cuisine[]" value="african"> Africain</label>
                    <label><input type="checkbox" name="cuisine[]" value="asian"> Asiatique</label>
                    <label><input type="checkbox" name="cuisine[]" value="vietnamese"> Vietnamienne</label>
                    <label><input type="checkbox" name="cuisine[]" value="indian"> Indienne</label>
                    <label><input type="checkbox" name="cuisine[]" value="turkish"> Turck</label>

                </div>

                <div class="toggle-group">
                    <h2>Options :</h2>
                    <label class="switch">
                        <input type="checkbox" class="toggle-checkbox" name="vegetarian">
                        <span class="slider"></span> Végétarien disponible
                    </label>
                    <label class="switch">
                        <input type="checkbox" class="toggle-checkbox" name="vegan">
                        <span class="slider"></span> Végan disponible
                    </label>
                    <label class="switch">
                        <input type="checkbox" class="toggle-checkbox" name="drive_through">
                        <span class="slider"></span> Drive disponible
                    </label>
                    <label class="switch">
                        <input type="checkbox" class="toggle-checkbox" name="delivery">
                        <span class="slider"></span> Livraison disponible
                    </label>
                    <label class="switch">
                        <input type="checkbox" class="toggle-checkbox" name="takeaway">
                        <span class="slider"></span> À emporter disponible
                    </label>
                </div>

                <button id="valide_choice" type="submit">Appliquer les filtres</button>
            </form>
        </div>

        <div class="results">
            
            <?php
                require_once '../../dataprovider/JsonProvider.php';
                require_once '../../dataprovider/Restaurant.php';

                use Provider\JsonProvider;
                use Provider\Restaurant;

                $jsonprovider = new JsonProvider('../../data/restaurants_orleans.json');
                $restaurants = $jsonprovider->loadRestaurants();

                // Récupérer les filtres appliqués
                $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
                $selectedTypes = isset($_GET['type']) ? $_GET['type'] : [];
                $selectedCuisines = isset($_GET['cuisine']) ? $_GET['cuisine'] : [];
                $isVegetarian = isset($_GET['vegetarian']) ? true : false;
                $isVegan = isset($_GET['vegan']) ? true : false;
                $hasDrive = isset($_GET['drive']) ? true : false;

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

                    return true; // Le restaurant passe tous les filtres
                });

            ?>
            <div class="restaurant-list">
                <?php foreach ($filteredRestaurants as $restaurant) : ?>
                    <div class="restaurant-card">
                        <h3><?= htmlspecialchars($restaurant->getName()) ?></h3>
                        <p><strong>Type :</strong> <?= htmlspecialchars($restaurant->getType()) ?></p>

                        <!-- Infos cuisine -->
                        <?php if ($restaurant->getCuisine()) : ?>
                            <p><strong>Cuisine :</strong> <?= implode(', ', $restaurant->getCuisine()) ?></p>
                        <?php endif; ?>

                        <!-- Info végé ? -->
                        <?php if ($restaurant->getVegetarian()) : ?>
                            <p><strong>Options végétariennes :</strong> Oui</p>
                        <?php else : ?>
                            <p><strong>Options végétariennes :</strong> Non spécifié</p>
                        <?php endif; ?>

                        <!-- Info végan ? -->
                        <?php if ($restaurant->getVegan()) : ?>
                            <p><strong>Options véganes :</strong> Oui</p>
                        <?php else : ?>
                            <p><strong>Options véganes :</strong> Non spécifié</p>
                        <?php endif; ?>

                        <!-- Info livraison / emporter / drive ? -->
                        <?php if ($restaurant->getDelivery()) : ?>
                            <p><strong>Options livraison :</strong> Oui</p>
                        <?php endif; ?>
                        <?php if ($restaurant->getTakeaway()) : ?>
                            <p><strong>Options à emporter :</strong> Oui</p>
                        <?php endif; ?>
                        <?php if ($restaurant->getDriveThrough()) : ?>
                            <p><strong>Drive disponible :</strong> Oui</p>
                        <?php endif; ?>

                        <!-- Moyenne -->
                         <!--
                        <p><strong>Note Moyenne :</strong> 
                            <?php 
                            /*
                            if (isset($restaurant->avis) && count($restaurant->avis) > 0) {
                                echo array_sum(array_map(fn($avis) => $avis->getNote(), $restaurant->avis)) / count($restaurant->avis) . "/5";
                            } else {
                                echo "Pas encore d'avis";
                            }
                            */
                            ?>
                        </p>
                        -->

                        <!-- Info horaires -->
                        <?php if ($restaurant->getFormattedOpeningHours()) : ?>
                            <p><strong>Heures d'ouverture :</strong></p>
                            <p><?= $restaurant->getFormattedOpeningHours() ?></p>
                        <?php endif; ?>
                        <!-- Info tél -->
                        <?php if ($restaurant->getPhone()) : ?>
                            <p><strong>Téléphone :</strong> <?= htmlspecialchars($restaurant->getPhone()) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
require 'footer.html';
?>