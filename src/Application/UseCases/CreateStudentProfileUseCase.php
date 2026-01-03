<?php

namespace Src\Application\UseCases;

use Src\Domain\Repositories\StudentProfileRepositoryInterface;
use Src\Application\DTOs\CreateStudentProfileDTO;
use Src\Domain\Entities\StudentProfile;

class CreateStudentProfileUseCase
{
    public function __construct(
        private StudentProfileRepositoryInterface $repository
    ) {}

    public function execute(CreateStudentProfileDTO $dto): StudentProfile
    {
        $profile = new StudentProfile(
            id: null,
            userId: $dto->userId,
            nom: $dto->nom,
            prenom: $dto->prenom,
            filiere: $dto->filiere,
            dateNaissance: $dto->dateNaissance
        );

        return $this->repository->save($profile);
    }
}
