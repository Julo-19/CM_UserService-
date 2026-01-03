<?php

namespace Src\Application\Listeners;

use Src\Application\Events\StudentRegistered;
use Src\Application\DTOs\CreateStudentProfileDTO;
use Src\Application\UseCases\CreateStudentProfileUseCase;

class CreateStudentProfileFromEvent
{
    public function __construct(private CreateStudentProfileUseCase $useCase) {}

    public function handle(StudentRegistered $event)
    {
        $dto = new CreateStudentProfileDTO(
            userId: $event->userId,
            nom: null,
            prenom: null,
            filiere: null,
            dateNaissance: null
        );

        $this->useCase->execute($dto);
    }
}
