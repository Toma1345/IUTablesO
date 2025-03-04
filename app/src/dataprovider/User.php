<?php

namespace IUT\dataprovider;


class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $adresse;
    private string $telephone;
    private string $imageprofil;
    private string $created_at;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $adresse,
        string $telephone,
        string $imageprofil,
        string $created_at
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->imageprofil = $imageprofil;
        $this->created_at = $created_at;
    }

    public function getUsername() : string
    {
        return $this->username;
    }
}