<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\IRoleService;
use App\Models\Permission;
use App\Models\Role;

class RoleService implements IRoleService
{

    /**
     * @inheritDoc
     */
    public function getAll(): ServiceResponse
    {
        $roles = Role::all();
        return new ServiceResponse(true, 'Roles retrieved successfully', $roles, 200);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ServiceResponse
    {
        $role = Role::find($id);
        if (!$role) {
            return new ServiceResponse(false, 'Role not found', null, 404);
        }
        return new ServiceResponse(true, 'Role retrieved successfully', $role, 200);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ServiceResponse
    {
        $role = $this->getById($id);
        if (!$role->isSuccess()) {
            return $role;
        }
        $role->getData()->delete();
        return new ServiceResponse(true, 'Role deleted successfully', null, 200);
    }

    public function create($name):ServiceResponse
    {
        $role = Role::where('name', $name)->first();
        if ($role) {
            return new ServiceResponse(false, 'Role already exists', null, 400);
        }
        $role = Role::create([
            'name' => $name
        ]);
        return new ServiceResponse(true, 'Role created successfully', $role, 201);
    }

    public function update($id, $name):ServiceResponse
    {
        $role = $this->getById($id);
        if (!$role->isSuccess()) {
            return $role;
        }
        $role = $role->getData();
        $role->name = $name;
        $role->save();
        return new ServiceResponse(true, 'Role updated successfully', $role, 200);
    }

    public function getPermissions($id):ServiceResponse
    {
        $role = $this->getById($id);
        if (!$role->isSuccess()) {
            return $role;
        }
        $role = $role->getData();
        $permissions = $role->permissions;
        return new ServiceResponse(true, 'Permissions retrieved successfully', $permissions, 200);
    }

    public function setPermissions($id, mixed $permissions): ServiceResponse
    {
        $role = $this->getById($id);
        if (!$role->isSuccess()) {
            return $role;
        }
        $role = $role->getData();
        $role->permissions()->sync($permissions);
        return new ServiceResponse(true, 'Permissions set successfully', null, 200);
    }

    public function getAllPermissions(): ServiceResponse
    {
        $categories = Permission::whereNull('parent_id')->with('children')->get();
        return new ServiceResponse(true, 'Permissions retrieved successfully', $categories, 200);
    }
}
