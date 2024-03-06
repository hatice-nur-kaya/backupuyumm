<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendController\GetAllCompaniesRequest;
use App\Interfaces\ICompanyService;

class FrontendController extends Controller
{

    use HttpResponse;

    protected ICompanyService $companyService;

    public function __construct(ICompanyService $companyService)
    {
        $this->companyService = $companyService;
    }



    public function getAllCompanies(GetAllCompaniesRequest $request){

        $response = $this->companyService->getByUserCompanies(
            $request->user()->id
        );

        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );

    }

}
