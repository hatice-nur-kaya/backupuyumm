<?php

namespace App\Interfaces;

use App\Core\ServiceResponse;
use App\Interfaces\Eloquent\IEloquentService;

interface ICompanyService extends IEloquentService
{

    public function create(
        string $name,
        string $taxNumber,
        string $taxOffice,
        string $phone,
        string $email,
        string $address
    ): ServiceResponse;

    public function update(
        int $id,
        string $name,
        string $taxNumber,
        string $taxOffice,
        string $phone,
        string $email,
        string $address
    ): ServiceResponse;

    public function getByUserCompanies(int $userId): ServiceResponse;

    public function getByTaxNumber(string $taxNumber): ServiceResponse;

    public function addUser(
        mixed $companyId,
        int $userId
    ): ServiceResponse;

    public function removeUser(
        int $companyId,
        int $userId
    ): ServiceResponse;


    public function addModule(
        int $companyId,
        int $moduleId
    ): ServiceResponse;

    public function removeModule(
        int $companyId,
        int $moduleId
    ): ServiceResponse;
    public function getByCompanyModules(int $companyId): ServiceResponse;

    public function setSettings(int $companyId, int $moduleId, mixed $settings): ServiceResponse;
    public function getModuleSettings(int $companyId, int $moduleId): ServiceResponse;

    public function setSettingsByUser(int $userId,int $companyId, int $moduleId, mixed $settings): ServiceResponse;

}
