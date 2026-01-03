<?php

namespace Src\Application\DTOs;

class CreateStudentProfileDTO
{
    public function __construct(
        public int $userId,
        public ?string $nom = null,
        public ?string $prenom = null,
        public ?string $filiere = null,
        public ?string $dateNaissance = null
    ) {}
}
