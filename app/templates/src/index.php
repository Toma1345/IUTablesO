<?php
// Récupérer l'index du restaurant à partir de l'URL
$restaurant_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Charger le fichier JSON
$restaurants = json_decode(file_get_contents('data/restaurants_orleans.json'), true);

// Vérifier si l'id est valide
if ($restaurant_id >= 0 && $restaurant_id < count($restaurants)) {
    $restaurant = $restaurants[$restaurant_id];
} else {
    // Si l'id n'est pas valide, rediriger vers la page principale
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($restaurant['name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($restaurant['name']); ?></h1>
    <p>Type: <?php echo htmlspecialchars($restaurant['type']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($restaurant['phone'] ?? 'N/A'); ?></p>
    <p>Website: <a href="<?php echo htmlspecialchars($restaurant['website']); ?>" target="_blank"><?php echo htmlspecialchars($restaurant['website']); ?></a></p>
    <p>Opening hours: <?php echo htmlspecialchars($restaurant['opening_hours'] ?? 'N/A'); ?></p>
    <p>Location: <?php echo htmlspecialchars($restaurant['com_nom']); ?>, <?php echo htmlspecialchars($restaurant['region']); ?></p>
    
    <a href="index.php">Retour à la liste</a>
</body>
</html>
