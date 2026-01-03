<?php

use Illuminate\Support\Facades\Route;
use Src\Presentation\Controllers\StudentAdminController;
use Src\Presentation\Controllers\StudentProfileController;

Route::post('/admin/students/{userId}/approve', [StudentAdminController::class, 'approve']);

Route::post('/students/profile', [StudentProfileController::class, 'store']);

