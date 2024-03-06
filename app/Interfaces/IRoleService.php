<?php

namespace App\Interfaces;

use App\Core\ServiceResponse;
use App\Interfaces\Eloquent\IEloquentService;

interface IRoleService extends IEloquentService
{
    public function create($name): ServiceResponse;

    public function update($id, $name):ServiceResponse;

    public function getPermissions($id):ServiceResponse;

    public function setPermissions($id, mixed $permissions):ServiceResponse;

    public function getAllPermissions():ServiceResponse;



}
