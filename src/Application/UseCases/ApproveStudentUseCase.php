<?php

namespace Src\Application\UseCases;

use Src\Domain\Repositories\StudentProfileRepositoryInterface;
use Src\Application\Events\StudentApproved;

class ApproveStudentUseCase
{
    public function __construct(
        private StudentProfileRepositoryInterface $repository
    ) {}

    public function execute(int $userId): void
    {
        $profile = $this->repository->findByUserId($userId);
        if (!$profile) {
            throw new \Exception("Profil étudiant introuvable");
        }

        // Ici, on pourrait mettre à jour le statut dans Auth Service via API call ou Event
        $event = new StudentApproved($userId);
        // event($event);
    }
    
}
