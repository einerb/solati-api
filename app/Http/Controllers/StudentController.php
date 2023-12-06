<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Http\Responses\ApiResponse;
use App\Repositories\StudentRepository;

class StudentController extends Controller
{
    protected $studentRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function index()
    {
        try {
            $page = request('page');
            $pageElements = request('pageElements');

            $students = $this->studentRepo->getAll($page, $pageElements);

            return ApiResponse::success('Estudiantes encontrados!', 200, $students);
        } catch (Exception $e) {
            ApiResponse::error('Error de operacion!', 500, $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        try {
            $student = $this->studentRepo->getById($id);

            return ApiResponse::success('Estudiante encontrado!', 200, $student);
        } catch (Exception $e) {
            ApiResponse::error('Error de operacion!', 500, $e->getMessage());
        }
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        try {
            $this->studentRepo->delete($id);

            return ApiResponse::success('Estudiante eliminado!', 200);
        } catch (Exception $e) {
            ApiResponse::error('Error de operacion!', 500, $e->getMessage());
        }
    }
}
