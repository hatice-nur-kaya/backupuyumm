<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleController\CreateRequest;
use App\Http\Requests\RoleController\DeleteRequest;
use App\Http\Requests\RoleController\GetAllRequest;
use App\Http\Requests\RoleController\GetByIdRequest;
use App\Http\Requests\RoleController\SetPermissionsRequest;
use App\Http\Requests\RoleController\UpdateRequest;
use App\Interfaces\IRoleService;

class RoleController extends Controller
{
    use HttpResponse;

    protected IRoleService $roleService;

    public function __construct(IRoleService $roleService)
    {
        $this->roleService = $roleService;
    }


    public function getAll(GetAllRequest $request)
    {
        $response = $this->roleService->getAll();
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function create(CreateRequest $request)
    {
        $response = $this->roleService->create(
            $request->name,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function update(UpdateRequest $request)
    {
        $response = $this->roleService->update(
            $request->id,
            $request->name,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function delete(DeleteRequest $request)
    {
        $response = $this->roleService->delete(
            $request->id,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getById(GetByIdRequest $request)
    {
        $response = $this->roleService->getById(
            $request->id,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getPermissions(GetByIdRequest $request)
    {
        $response = $this->roleService->getPermissions(
            $request->id,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function setPermissions(SetPermissionsRequest $request)
    {
        $response = $this->roleService->setPermissions(
            $request->id,
            $request->permissions,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getAllPermissions(GetAllRequest $request)
    {
        $response = $this->roleService->getAllPermissions();
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
}
