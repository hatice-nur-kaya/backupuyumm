<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleController\GetByIdRequest;
use App\Http\Requests\ModuleController\GetProgramsRequest;
use App\Http\Requests\ModuleController\GetWebServicesRequest;
use App\Interfaces\IModuleService;

class ModuleController extends Controller
{

    use HttpResponse;

    protected IModuleService $moduleService;

    public function __construct(IModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }
    public function getAll()
    {
        $response = $this->moduleService->getAll();
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );

    }

    public function getPrograms(GetProgramsRequest $request)
    {
        $response = $this->moduleService->getPrograms(
            $request->moduleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );

    }

    public function getWebServices(GetWebServicesRequest $request)
    {
        $response = $this->moduleService->getWebServices(
            $request->moduleId
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
        $response = $this->moduleService->getById(
            $request->moduleId
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );

    }
}
