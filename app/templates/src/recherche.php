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
    <!-- Colonne gauche -->
    <div class="sidebar">
        <div class="search">
            <h2>Recherche par nom...</h2>
            <input id="searchbar" type="search" placeholder="Search..">
        </div>
        <h2>...Ou par critères</h2>
        <div class="types">
            <h2>Par types :</h2>
            <label><input type="checkbox" name="Bar"> Bar</label><br>
            <label><input type="checkbox" name="Restaurant"> Restaurant</label><br>
            <label><input type="checkbox" name="Fast-food"> Fast-food</label><br>
        </div>
        <div class="cuisine">
            <h2>Par cuisines :</h2>
            <label><input type="checkbox" name="Poulet"> Poulet</label><br>
            <label><input type="checkbox" name="Salade"> Salade</label><br>
            <label><input type="checkbox" name="Fish"> Fish</label><br>
        </div>
        <div class="toggle-group">
            <h2>Options :</h2>
            <label class="switch">
                <input type="checkbox" class="toggle-checkbox" name="Végé">
                <span class="slider"></span> Végétarien disponible
            </label><br>
            <label class="switch">
                <input type="checkbox" class="toggle-checkbox" name="Végan">
                <span class="slider"></span> Végan disponible
            </label><br>
            <label class="switch">
                <input type="checkbox" class="toggle-checkbox" name="Drive">
                <span class="slider"></span> Drive disponible
            </label><br>
        </div>
    </div>

    <!-- Colonne droite -->
    <div class="results">
        <p id="result"></p>
        <p id="selected-types"></p>
        <p id="selected-cuisines"></p>
        <p id="toggle-result"></p>
    </div>
</div>
</body>
</html>