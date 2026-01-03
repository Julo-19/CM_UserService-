<?php

namespace Src\Application\Events;

class StudentApproved
{
    public function __construct(
        public int $userId
    ) {}
}
