<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Restaurant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .restaurant-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <div id="restaurant-details" class="restaurant-details">
        <!-- Les détails du restaurant seront insérés ici -->
    </div>

    <script>
        // Récupérer l'ID du restaurant à partir de l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const restaurantId = urlParams.get('id');

        fetch('data/restaurants_orleans.json')
            .then(response => response.json())
            .then(data => {
                const restaurant = data[restaurantId];
                const restaurantDetails = document.getElementById('restaurant-details');
                
                restaurantDetails.innerHTML = `
                    <h2>${restaurant.name}</h2>
                    <p><strong>Type:</strong> ${restaurant.type}</p>
                    <p><strong>Ouvert:</strong> ${restaurant.opening_hours || 'Non renseigné'}</p>
                    <p><strong>Téléphone:</strong> ${restaurant.phone || 'Non renseigné'}</p>
                    <p><strong>Site Web:</strong> <a href="${restaurant.website}" target="_blank">${restaurant.website || 'Non renseigné'}</a></p>
                    <p><strong>Adresse:</strong> ${restaurant.com_nom}, ${restaurant.region}</p>
                    <p><a href="${restaurant.osm_edit}" target="_blank">Voir sur OpenStreetMap</a></p>
                    <p><a href="index.html">Retour à la liste des restaurants</a></p>
                `;
            })
            .catch(error => console.error('Erreur:', error));
    </script>

</body>
</html>
