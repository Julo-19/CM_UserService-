<?php

namespace Src\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Application\UseCases\CreateStudentProfileUseCase;
use Src\Application\DTOs\CreateStudentProfileDTO;

class StudentProfileController extends Controller
{
    public function __construct(private CreateStudentProfileUseCase $useCase) {}

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'email' => 'required|email',
        ]);

        $dto = new CreateStudentProfileDTO(
            userId: $request->user_id
        );

        $this->useCase->execute($dto);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil étudiant créé'
        ], 201);
    }
}
