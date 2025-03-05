<?php

namespace IUT\dataprovider;
use IUT\dataprovider\Avis;
use IUT\dataprovider\Restaurant;


class JsonProvider
{
    private string $jsonFilePath = "../data/restaurants_orleans.json";
    private string $avisFilePath = "../data/avis.json";
    private string $userFilePath = "../data/user.json";

    public function __construct()
    {
        ;
    }

    public function loadRestaurants(int $nb = -1): array
    {
        if (!file_exists($this->jsonFilePath)) {
            throw new \Exception("Le fichier JSON n'existe pas.");
        }

        $jsonData = file_get_contents($this->jsonFilePath);

        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }

        $restaurants = [];

        if ($nb === -1) {
            foreach ($data as $restaurantData) {
                $restaurants[] = $this->mapToRestaurant($restaurantData);
            }
        } else {
            for ($i = 0; $i < min($nb, count($data)); $i++) {
                $restaurants[] = $this->mapToRestaurant($data[$i]);
            }
        }
        return $restaurants;
    }

    public function getById(string $id): ?Restaurant

    {
        if (!file_exists($this->jsonFilePath)) {
            throw new \Exception("Le fichier JSON n'existe pas.");
        }

        $jsonData = file_get_contents($this->jsonFilePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }

        if(str_starts_with($id, "node/")) {
            $id = substr($id, 5);
        }

        foreach ($data as $restaurantData) {
            if (substr($restaurantData['osm_id'], 5) === $id) {
                $restau = $this->mapToRestaurant($restaurantData);
                return $restau;
            }
        }
        return null;
    }

    private function mapToRestaurant(array $restaurantData): Restaurant
    {
        return new Restaurant(
            $restaurantData['geo_point_2d']['lon'],
            $restaurantData['geo_point_2d']['lat'],
            str_starts_with($restaurantData['osm_id'], 'node/') ? substr($restaurantData['osm_id'], 5) : $restaurantData['osm_id'],

            $restaurantData['type'],
            $restaurantData['name'],
            $restaurantData['operator'] ?? null,
            $restaurantData['brand'] ?? null,
            $restaurantData['opening_hours'],
            $this->mapToBoolean($restaurantData['wheelchair']),
            $restaurantData['cuisine'] ?? [],
            $this->mapToBoolean($restaurantData['vegetarian']),
            $this->mapToBoolean($restaurantData['vegan']),
            $this->mapToBoolean($restaurantData['delivery']),
            $this->mapToBoolean($restaurantData['takeaway']),
            $restaurantData['capacity'] ?? null,
            $this->mapToBoolean($restaurantData['drive_through']),
            $this->normalizePhoneNumber($restaurantData['phone']),
            $restaurantData['website'],
            $restaurantData['facebook'] ?? null,
            $restaurantData['region'],
            $restaurantData['departement'],
            $restaurantData['commune']
        );
    }

    private function mapToBoolean(?string $value): ?bool
    {
        if ($value === null) {
            return null;
        }
        return $value === 'yes';
    }

    private function normalizePhoneNumber(string|null $phone): ?string
    {
        if ($phone === null) {
            return null;
        }
        return preg_replace('/\s+/', '', $phone);
    }

    public function getUser(int $id) : ?User
    {
        $jsonData = file_get_contents($this->userFilePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }

        foreach ($data as $userData){
            if($userData["id"]==$id){
                return new User($userData["id"], $userData["username"], $userData["email"], $userData["adresse"], $userData["telephone"], $userData["imageprofil"], $userData["created_at"]);
            }
        }
        return null;
    }
    public function getAvis(Restaurant $restau): array
    {
        $res = [];
        $jsonData = file_get_contents($this->avisFilePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }
        foreach ($data as $avisData){
            if ($restau->getOsmId()==$avisData['restauId']){
                $user = null;
                foreach ($res as $avis){
                    if($avis->getUtilisateur()->getId() == $avisData["userId"]){
                        $user = $avis->getUtilisateur();
                        break;
                    }
                }
                if(is_null($user)){
                    $user = $this->getUser($avisData["userId"]);
                }
                $avis = new Avis($user, $restau, $avisData["commentaire"], intval($avisData["note"]));
                $res[] = $avis;
            }
        }
        return $res;
    }

    public function addAvis(Avis $avis): void
    {
        $jsonData = file_get_contents($this->avisFilePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }

        $avisData = [
            "userId" => $avis->getUtilisateur()->getId(),
            "restauId" => $avis->getRestaurant()->getOsmId(),
            "commentaire" => $avis->getCommentaire(),
            "note" => $avis->getNote()
        ];

        $data[] = $avisData;

        file_put_contents($this->avisFilePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAvisByUser(User $user): array
    {
        $res = [];
        $jsonData = file_get_contents($this->avisFilePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erreur de décodage JSON: " . json_last_error_msg());
        }
        foreach ($data as $avisData){
            if ($user->getId()==$avisData['userId']){
                $restau = null;
                foreach ($res as $avis){
                    if($avis->getRestaurant()->getOsmId() == $avisData["restauId"]){
                        $restau = $avis->getRestaurant();
                        break;
                    }
                }
                if(is_null($restau)){
                    $restau = $this->getById($avisData["restauId"]);
                }
                $avis = new Avis($user, $restau, $avisData["commentaire"], intval($avisData["note"]));
                $res[] = $avis;
            }
        }
        return $res;
    }
}