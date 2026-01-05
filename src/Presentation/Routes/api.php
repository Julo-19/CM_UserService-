<?php

use Illuminate\Support\Facades\Route;
use Src\Presentation\Controllers\StudentAdminController;
use Src\Presentation\Controllers\StudentProfileController;

Route::post('/admin/students/{userId}/approve', [StudentAdminController::class, 'approve']);

Route::post('/students/profile', [StudentProfileController::class, 'store']);

Route::post('/admin/users/{userId}/approve', function($userId) {
    $user = \Src\Infrastructure\Models\UserModel::find($userId);
    if (!$user) {
        return response()->json(['message'=>'Utilisateur introuvable'], 404);
    }

    $user->status = 'APPROVED';
    $user->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Utilisateur approuvé'
    ]);
});
