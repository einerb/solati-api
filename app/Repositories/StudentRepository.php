<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\ModelBa;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        try {
            return Student::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Estudiante no encontrado!');
        }
    }

    public function getAll($page, $pageElements)
    {
        return Student::paginate($pageElements, ['*'], 'page', $page);
    }

    public function create($data)
    {
        return Student::create($data);
    }

    public function update($id, $data)
    {
        try {
            $student = Student::findOrFail($id);
            $student->update($data);

            return $student;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Estudiante no encontrado!');
        }
    }

    public function delete($id)
    {
        try {
            $student = Student::findOrFail($id);

            $student->delete();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Estudiante no encontrado!');
        }
    }
}
