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
                        <form action="/logout" method="get">
                            <li><a id="deconnexion">Déconnexion</a></li>
                        </form>
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
                    <input id="searchbar" type="search" name="recherche" placeholder="Rechercher un restaurant ...">
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
