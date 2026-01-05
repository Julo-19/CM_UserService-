<?php

namespace Src\Application\Events;

class StudentApproved
{
    public function __construct(
        public int $userId,
        public string $email
    ) {}
}

Http::post('http://notification-service.test/api/notify/student', [
    'user_id' => $userId,
    'message' => 'Votre compte CampusMaster est maintenant actif.'
]);

