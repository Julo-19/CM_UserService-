<?php

namespace Src\Application\UseCases;

use Src\Domain\Repositories\StudentProfileRepositoryInterface;
use Illuminate\Support\Facades\Http;
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

        // Mettre à jour le statut local
        $profileModel = $profile->getId();
        // Ici, tu peux faire $profile->approve(); et save dans repository
        $profileRecord = \Src\Infrastructure\Models\StudentProfileModel::find($profile->getId());
        $profileRecord->status = 'APPROVED';
        $profileRecord->save();

        // Appeler Auth Service pour mettre users.status = APPROVED
        $response = Http::post(
            'http://localhost:8001/api/admin/users/'.$userId.'/approve'
        );

        \Log::info('Auth Service approve called', [
            'user_id' => $userId,
            'status_code' => $response->status(),
            'response_body' => $response->body()
        ]);

        if (! $response->successful()) {
            throw new \Exception('Échec synchronisation avec Auth Service');
        }


        // Après avoir changé status → APPROVED
        $profileRecord->status = 'APPROVED';
        $profileRecord->save();

        // Émettre l'event
        $event = new \Src\Application\Events\StudentApproved(
            $userId,
            $profileRecord->email ?? 'etu@example.com'
        );

        // Envoi HTTP vers Notification Service
        \Http::post('http://localhost:8002/api/notify/student', [
            'user_id' => $userId,
            'email' => $profileRecord->email,
            'message' => 'Votre compte CampusMaster est maintenant approuvé !'
        ]);

    }
}
