<?php

namespace Src\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Application\UseCases\ApproveStudentUseCase;

class StudentAdminController extends Controller
{
    public function __construct(private ApproveStudentUseCase $useCase) {}

    public function approve(Request $request, int $userId)
    {
        try {
            $this->useCase->execute($userId);

            return response()->json([
                'status' => 'success',
                'message' => 'Étudiant validé avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
