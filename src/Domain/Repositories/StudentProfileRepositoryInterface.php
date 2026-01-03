<?php

namespace Src\Domain\Repositories;

use Src\Domain\Entities\StudentProfile;

interface StudentProfileRepositoryInterface
{
    public function save(StudentProfile $profile): StudentProfile;

    public function findByUserId(int $userId): ?StudentProfile;
}
