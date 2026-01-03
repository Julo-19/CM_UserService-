<?php

namespace Src\Infrastructure\Persistence;

use Src\Domain\Repositories\StudentProfileRepositoryInterface;
use Src\Domain\Entities\StudentProfile;
use Src\Infrastructure\Models\StudentProfileModel;

class EloquentStudentProfileRepository implements StudentProfileRepositoryInterface
{
    public function save(StudentProfile $profile): StudentProfile
    {
        $model = StudentProfileModel::create([
            'user_id' => $profile->getUserId(),
            'nom' => $profile->getNom(),
            'prenom' => $profile->getPrenom(),
            'filiere' => $profile->getFiliere(),
            'date_naissance' => $profile->getDateNaissance(),
            'status' => 'PENDING'
        ]);

        return new StudentProfile(
            id: $model->id,
            userId: $model->user_id,
            nom: $model->nom,
            prenom: $model->prenom,
            filiere: $model->filiere,
            dateNaissance: $model->date_naissance
        );
    }

    public function findByUserId(int $userId): ?StudentProfile
    {
        $model = StudentProfileModel::where('user_id', $userId)->first();
        if (!$model) {
            return null;
        }

        return new StudentProfile(
            id: $model->id,
            userId: $model->user_id,
            nom: $model->nom,
            prenom: $model->prenom,
            filiere: $model->filiere,
            dateNaissance: $model->date_naissance
        );
    }
}
