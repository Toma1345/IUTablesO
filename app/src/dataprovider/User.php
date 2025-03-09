<?php

namespace IUT\dataprovider;


class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $adresse;
    private string $telephone;
    private string $imageprofil;
    private string $created_at;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $password,
        string $adresse,
        string $telephone,
        string $imageprofil,
        string $created_at
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->imageprofil = $imageprofil;
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getImageprofil(): string
    {
        return $this->imageprofil;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}