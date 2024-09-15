<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel(): string;

    public function getAll()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }

        return false;
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        if ($record) {
            return $record->delete();
        }

        return false;
    }

    public function changeStatus(int $id, string $status)
    {
        $record = $this->find($id);
        if ($record) {
            $record->status = $status;
            $record->save();
            return $record;
        }

        return false;
    }
}