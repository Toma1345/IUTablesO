<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de restaurants</title>
    <script src="/static/scripts/script_recherche.js" defer></script>
    <link rel="stylesheet" href="/static/recherche.css">
    <link rel="stylesheet" href="/static/header.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><img src="/static/images/IUTables’O.png" alt="logo"></li>
                
                <div class="center-section">
                    <li><a href="/">Accueil</a></li>
                    <li><a id="rechercher" href="/search">Rechercher un restaurant</a></li>
                </div>

                <div class="right-section">
                    <?php if ($_SESSION['loggedin']==false): ?>
                        <li><a id="connexion" href="/login">Connexion</a></li>
                        <li><a id="inscription" href="/suscribe">Inscription</a></li>
                    <?php else: ?>
                        <li><a id="compte" href="/me">Mon compte</a></li>
                        <li><a id="compte" href="/mesavis">Mes avis</a></li>
                        <li><a id="deconnexion" href="/logout">Déconnexion</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="sidebar">
            <form method="GET" action="/search">
                <div class="search">
                    <h2>Recherche par nom :</h2>
                    <input id="searchbar" type="search" name="recherche" placeholder="Rechercher un restaurant ..." value="<?php echo htmlspecialchars($_GET['recherche'] ?? '', ENT_QUOTES); ?>">
                </div>

                <h2>Ou par critères</h2>
                <div class="types">
                    <h2>Par types :</h2>
                    <?php
                    $types = [
                        'bar' => 'Bar',
                        'restaurant' => 'Restaurant',
                        'fast_food' => 'Fast-food',
                        'pub' => 'Pub',
                        'cafe' => 'Café',
                        'ice_cream' => 'Glacier'
                    ];
                    foreach ($types as $value => $label) {
                        $checked = in_array($value, $_GET['type'] ?? []) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='type[]' value='$value' $checked> $label</label>";
                    }
                    ?>
                </div>

                <div class="cuisine">
                    <h2>Par cuisines :</h2>
                    <?php
                    $cuisines = [
                        'salad' => 'Salade',
                        'chicken' => 'Poulet',
                        'fish' => 'Poisson',
                        'kebab' => 'Kebab',
                        'tacos' => 'Tacos',
                        'pizza' => 'Pizza',
                        'grill' => 'Grill',
                        'seafood' => 'Mer',
                        'gastronomique' => 'Gastronomique',
                        'traditional' => 'Traditionnel',
                        'regional' => 'Régional',
                        'bavarian' => 'Bavaroise',
                        'french' => 'Français',
                        'afro-latine' => 'Afro-Latine',
                        'italian' => 'Italien',
                        'maxican' => 'Mexicain',
                        'korean' => 'Coréen',
                        'african' => 'Africain',
                        'asian' => 'Asiatique',
                        'vietnamese' => 'Vietnamienne',
                        'indian' => 'Indienne',
                        'turkish' => 'Turque'
                    ];
                    foreach ($cuisines as $value => $label) {
                        $checked = in_array($value, $_GET['cuisine'] ?? []) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='cuisine[]' value='$value' $checked> $label</label>";
                    }
                    ?>
                </div>

                <button type="button" id="reset_filters">Réinitialiser les filtres</button>

                <div class="toggle-group">
                    <h2>Options :</h2>
                    <?php
                    $options = [
                        'vegetarian' => 'Végétarien disponible',
                        'vegan' => 'Végan disponible',
                        'drive_through' => 'Drive disponible',
                        'delivery' => 'Livraison disponible',
                        'takeaway' => 'À emporter disponible'
                    ];
                    foreach ($options as $name => $label) {
                        $checked = isset($_GET[$name]) ? 'checked' : '';
                        echo "<label class='switch'><input type='checkbox' class='toggle-checkbox' name='$name' $checked><span class='slider'></span> $label</label>";
                    }
                    ?>
                </div>

                <button id="valide_choice" type="submit">Appliquer les filtres</button>
            </form>
        </div>

        <div class="results">
            <div class="restaurant-list">
                <?php foreach ($restaurants as $restaurant) {
                    echo $restaurant->renderCard();
                }
                ?>
            </div>
        </div>
    </div>
    <?php
        require 'footer.php';
    ?>
</body>
</html>