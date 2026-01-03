<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Repositories\StudentProfileRepositoryInterface;
use Src\Infrastructure\Persistence\EloquentStudentProfileRepository;
use Src\Application\UseCases\ApproveStudentUseCase;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->bind(
        \Src\Domain\Repositories\StudentProfileRepositoryInterface::class,
        \Src\Infrastructure\Persistence\EloquentStudentProfileRepository::class
    );


        $this->app->bind(ApproveStudentUseCase::class, function ($app) {
            return new ApproveStudentUseCase(
                $app->make(StudentProfileRepositoryInterface::class)
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
