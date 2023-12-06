<?php

namespace App\Repositories;

interface StudentRepositoryInterface
{
    public function getAll($page, $pageElements);

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
