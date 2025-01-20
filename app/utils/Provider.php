<?php
class Provider {
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function getInfos(): array {
        if (!file_exists($this->filePath)) {
            throw new Exception("Fichier JSON introuvable : {$this->filePath}");
        }

        $data = file_get_contents($this->filePath);
        $questions = json_decode($data, true);

        if ($questions === null) {
            throw new Exception("JSON mal formé dans le fichier : {$this->filePath}");
        }

        return $questions;
    }
}

