<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyController\AddModuleRequest;
use App\Http\Requests\CompanyController\AddUserRequest;
use App\Http\Requests\CompanyController\CreateRequest;
use App\Http\Requests\CompanyController\DeleteRequest;
use App\Http\Requests\CompanyController\GetAllRequest;
use App\Http\Requests\CompanyController\GetByCompanyModules;
use App\Http\Requests\CompanyController\GetByIdRequest;
use App\Http\Requests\CompanyController\GetByUserCompaniesRequest;
use App\Http\Requests\CompanyController\GetModuleSettingRequest;
use App\Http\Requests\CompanyController\ModuleSettingsRequest;
use App\Http\Requests\CompanyController\RemoveModuleRequest;
use App\Http\Requests\CompanyController\RemoveUserRequest;
use App\Http\Requests\CompanyController\SetSettingsByUserRequest;
use App\Http\Requests\CompanyController\UpdateRequest;
use App\Interfaces\ICompanyService;

class CompanyController extends Controller
{

    use HttpResponse;

    protected ICompanyService $companyService;

    public function __construct(ICompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    public function create(CreateRequest $request)
    {
        $response = $this->companyService->create(
            $request->name,
            $request->taxNumber,
            $request->taxOffice,
            $request->phone,
            $request->email,
            $request->address
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
        $response = $this->companyService->update(
            $request->id,
            $request->name,
            $request->taxNumber,
            $request->taxOffice,
            $request->phone,
            $request->email,
            $request->address
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
        $response = $this->companyService->delete($request->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getAll(GetAllRequest $request)
    {
        $response = $this->companyService->getAll();
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function getById(GetByIdRequest $request)
    {
        $response = $this->companyService->getById($request->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function getByUserCompanies(GetByUserCompaniesRequest $request)
    {
        $response = $this->companyService->getByUserCompanies($request->userId);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function addUser(AddUserRequest $request){
        $response = $this->companyService->addUser(
            $request->companyId,
            $request->userId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function removeUser(RemoveUserRequest $request){
        $response = $this->companyService->removeUser(
            $request->companyId,
            $request->userId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function addModule(AddModuleRequest $request){
        $response = $this->companyService->addModule(
            $request->companyId,
            $request->moduleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function removeModule(RemoveModuleRequest $request){
        $response = $this->companyService->removeModule(
            $request->companyId,
            $request->moduleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function getByCompanyModules(GetByCompanyModules $request)
    {
        $response = $this->companyService->getByCompanyModules($request->companyId);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
    public function setModuleSetting(ModuleSettingsRequest $request)
    {
        $response = $this->companyService->setSettings(
            $request->companyId,
            $request->moduleId,
            $request->settings
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getModuleSetting(GetModuleSettingRequest $request)
    {
        $response = $this->companyService->getModuleSettings(
            $request->companyId,
            $request->moduleId,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function setSettingsByUser(SetSettingsByUserRequest $request){
        $response = $this->companyService->setSettingsByUser(
            $request->user()->id,
            $request->companyId,
            $request->moduleId,
            $request->settings,
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()

        );
    }


}
