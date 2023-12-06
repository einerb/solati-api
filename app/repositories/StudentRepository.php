<?php

namespace App\Repositories;

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
        return Student::findOrFail($id);
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
        $student = Student::findOrFail($id);
        $student->update($data);

        return $student;
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }
}
