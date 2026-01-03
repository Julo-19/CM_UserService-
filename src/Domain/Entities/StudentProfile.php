<?php

namespace Src\Domain\Entities;

class StudentProfile
{
    public function __construct(
        private ?int $id,
        private int $userId,
        private ?string $nom = null,
        private ?string $prenom = null,
        private ?string $filiere = null,
        private ?string $dateNaissance = null
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->userId; }
    public function getNom(): ?string { return $this->nom; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function getFiliere(): ?string { return $this->filiere; }
    public function getDateNaissance(): ?string { return $this->dateNaissance; }
}
