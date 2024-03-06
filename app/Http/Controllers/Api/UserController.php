<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserController\AddCompanyRequest;
use App\Http\Requests\UserController\CreateRequest;
use App\Http\Requests\UserController\DeleteRequest;
use App\Http\Requests\UserController\DeleteRoleRequest;
use App\Http\Requests\UserController\GetAllRequest;
use App\Http\Requests\UserController\GetByIdRequest;
use App\Http\Requests\UserController\GetCompaniesByUserIdRequest;
use App\Http\Requests\UserController\GetCompaniesByUserRequest;
use App\Http\Requests\UserController\GetRoleAndPermissionRequest;
use App\Http\Requests\UserController\GetRolesRequest;
use App\Http\Requests\UserController\RemoveCompanyRequest;
use App\Http\Requests\UserController\SetRoleRequest;
use App\Http\Requests\UserController\UpdateProfile;
use App\Http\Requests\UserController\UpdateRequest;
use App\Interfaces\IUserService;

class UserController extends Controller
{
    use HttpResponse;

    protected IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    public function getAll(GetAllRequest $request)
    {
        $response = $this->userService->getAll();
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getById(GetByIdRequest $request)
    {
        $response = $this->userService->getById($request->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function delete(DeleteRequest $request)
    {
        $response = $this->userService->delete($request->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function create(CreateRequest $request)
    {
        $response = $this->userService->create(
            $request->name,
            $request->email,
            $request->password
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
        $response = $this->userService->update(
            $request->id,
            $request->name,
            $request->email,
            $request->password
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function addCompany(AddCompanyRequest $request)
    {
        $response = $this->userService->addCompany(
            $request->userId,
            $request->companyId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function removeCompany(RemoveCompanyRequest $request)
    {
        $response = $this->userService->removeCompany(
            $request->userId,
            $request->companyId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getCompaniesByUserId(GetCompaniesByUserIdRequest $request)
    {
        $response = $this->userService->getCompanies($request->userId);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getCompaniesByUser(GetCompaniesByUserRequest $request)
    {
        $response = $this->userService->getCompanies($request->user()->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function setRole(SetRoleRequest $request)
    {
        $response = $this->userService->setRole(
            $request->userId,
            $request->roleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getRoles(GetRolesRequest $request)
    {
        $response = $this->userService->getRoles(
            $request->userId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getRoleAndPermissions(GetRoleAndPermissionRequest $request)
    {
        $response = $this->userService->getRoleAndPermissions(
            $request->userId,
            $request->roleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function deleteRole(DeleteRoleRequest $request)
    {
        $response = $this->userService->deleteRole(
            $request->userId,
            $request->roleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function updateProfile(UpdateProfile $request)
    {
        $response = $this->userService->updateProfile(
            $request->user()->id,
            $request->password
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }


}
