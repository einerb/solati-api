<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            return ApiResponse::error('Error de operación!', 500, $e->getMessage());
        }
    }

    private function validateStudent(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('students')->ignore($request->student_id),
            ],
            'name' => 'required',
            'lastname' => 'required',
        ], [
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'name.required' => 'El nombre es obligatorio.',
            'lastname.required' => 'El apellido es obligatorio.',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validateStudent($request);

            $studentCreated = $this->studentRepo->create($request->all());

            return ApiResponse::success('Estudiante creado exitosamente!', 200, $studentCreated);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de validación!', 400, $e->validator->errors()->first());
        } catch (Exception $e) {
            return ApiResponse::error('Error de operación!', 500, $e->getMessage());
        }
    }


    public function show(string $id)
    {
        try {
            $student = $this->studentRepo->getById($id);

            return ApiResponse::success('Estudiante encontrado!', 200, $student);
        } catch (NotFoundException $e) {
            return ApiResponse::error('Estudiante no encontrado!', 404, null);
        } catch (Exception $e) {
            return ApiResponse::error('Error de operación!', 500, $e->getMessage());
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            $student = $this->studentRepo->update($id, $request->all());

            return ApiResponse::success('Estudiante actualizado exitosamente!', 200, $student);
        } catch (NotFoundException $e) {
            return ApiResponse::error('Estudiante no encontrado!', 404, null);
        } catch (Exception $e) {
            return ApiResponse::error('Error de operación!', 500, $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        try {
            $this->studentRepo->delete($id);

            return ApiResponse::success('Estudiante eliminado!', 200, null);
        } catch (NotFoundException $e) {
            return ApiResponse::error('Estudiante no encontrado!', 404, null);
        } catch (Exception $e) {
            return ApiResponse::error('Error de operación!', 500, $e->getMessage());
        }
    }
}
