<?php

namespace IUTablesO;
use Commentaires;

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
    private ?array $avis = [];

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

    // Getter methods
    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
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

    public function getCuisine(): array
    {
        return $this->cuisine;
    }

    public function getOpeningHours(): ?array
    {
        return $this->openingHours;
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

    public function getDriveThrough(): ?bool
    {
        return $this->driveThrough;
    }

    // Method to get formatted opening hours
    public function getFormattedOpeningHours(): string
    {
        if ($this->openingHours === null) {
            return "Non spécifié";
        }

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $formattedHours = [];
        foreach ($this->openingHours as $index => $hours) {
            if ($hours !== "Fermé") {
                $formattedHours[] = $days[$index] . ": " . $hours;
            } else {
                $formattedHours[] = $days[$index] . ": Fermé";
            }
        }

        return implode('<br>', $formattedHours);
    }

    // Method to add reviews
    public function addAvis(Commentaires\Avis $avis): void
    {
        $this->avis[] = $avis;
    }

    // Normalize phone number format
    private function normalizePhoneNumber(?string $phone): ?string
    {
        return $phone ? preg_replace('/\s+/', '', $phone) : null;
    }

    // Parse opening hours string into an array
    private function parseOpeningHours(?string $openingHours): ?array
    {
        if (!$openingHours) return null;

        $days = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
        $dayMap = array_flip($days);
        $hours = array_fill(0, 7, "Fermé");

        foreach (explode(';', $openingHours) as $segment) {
            $segment = trim($segment);
            if (!$segment) continue;

            // Check for space between days and hours
            $parts = explode(' ', $segment, 2);
            if (count($parts) < 2) continue;
            
            [$daysPart, $hoursPart] = $parts;

            // Special case for 24/7 (open all the time)
            if ($daysPart === "24/7") {
                $hours = array_fill(0, 7, "Ouvert 24h/24");
                continue;
            }

            // Skip if holidays (PH) are mentioned
            if (str_contains($daysPart, "PH")) {
                continue;
            }

            if (strpos($daysPart, '-') !== false) {
                [$start, $end] = explode('-', $daysPart);
                if (isset($dayMap[$start]) && isset($dayMap[$end])) {
                    for ($i = $dayMap[$start]; $i <= $dayMap[$end]; $i++) {
                        $hours[$i] = $hoursPart;
                    }
                }
            } elseif (strpos($daysPart, ',') !== false) {
                foreach (explode(',', $daysPart) as $day) {
                    if (isset($dayMap[$day])) {
                        $hours[$dayMap[$day]] = $hoursPart;
                    }
                }
            } elseif (isset($dayMap[$daysPart])) {
                $hours[$dayMap[$daysPart]] = $hoursPart;
            }
        }

        return $hours;
    }
}
?>
