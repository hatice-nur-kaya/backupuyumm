<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\ICompanyService;
use App\Interfaces\IModuleService;
use App\Interfaces\IUserService;
use App\Models\Company;
use App\Models\CompanyModuleSetting;
use App\Models\Ticket;

class CompanyService implements ICompanyService
{

    public function create(string $name, string $taxNumber, string $taxOffice, string $phone, string $email, string $address): ServiceResponse
    {
        $companyCheck = $this->getByTaxNumber($taxNumber);
        if ($companyCheck->isSuccess()) {
            return new ServiceResponse(
                false,
                'Company already exists',
                null,
                400
            );
        } else {
            $company = new Company();
            $company->name = $name;
            $company->tax_number = $taxNumber;
            $company->tax_office = $taxOffice;
            $company->phone = $phone;
            $company->email = $email;
            $company->address = $address;
            $company->save();
            return new ServiceResponse(
                true,
                'Company created',
                $company,
                201
            );
        }
    }

    public function update(int $id, string $name, string $taxNumber, string $taxOffice, string $phone, string $email, string $address): ServiceResponse
    {
        $company = $this->getById($id);
        if ($company->isSuccess()) {
            $company->getData()->name = $name;
            $company->getData()->tax_number = $taxNumber;
            $company->getData()->tax_office = $taxOffice;
            $company->getData()->phone = $phone;
            $company->getData()->email = $email;
            $company->getData()->address = $address;
            $company->getData()->save();
            return new ServiceResponse(
                true,
                'Company updated',
                $company->getData(),
                200
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    /**
     * @inheritDoc
     */
    public function getAll(): ServiceResponse
    {
        $companies = Company::with('users')->get();
        return new ServiceResponse(
            true,
            'Companies found',
            $companies,
            200
        );
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ServiceResponse
    {
        $company = Company::find($id);
        if ($company) {
            return new ServiceResponse(
                true,
                'Company found',
                $company,
                200
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ServiceResponse
    {
        $company = $this->getById($id);
        if ($company->isSuccess()) {
            Ticket::where('company_id', $id)->delete();
            $company->getData()->delete();
            return new ServiceResponse(
                true,
                'Company deleted',
                null,
                200
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function getByTaxNumber(string $taxNumber): ServiceResponse
    {
        $company = Company::where('tax_number', $taxNumber)->first();
        if ($company) {
            return new ServiceResponse(
                true,
                'Company found',
                $company,
                200
            );
        } else {
            return new ServiceResponse(
                false,
                'Company not found',
                null,
                404
            );
        }
    }

    public function getByUserCompanies(int $userId): ServiceResponse
    {
        $userService = app(IUserService::class);
        $user = $userService->getById($userId);
        if ($user->isSuccess()) {
            $companies = $user->getData()->companies;
            return new ServiceResponse(
                true,
                'Companies found',
                $companies,
                200
            );

        } else {
            return new ServiceResponse(
                false,
                'User not found',
                null,
                404
            );
        }
    }

    public function addUser(mixed $companyId, int $userId): ServiceResponse
    {
        foreach ($companyId as $id) {
            $company = $this->getById($id);
            if ($company->isSuccess()) {
                $userService = app(IUserService::class);
                $user = $userService->getById($userId);
                if ($user->isSuccess()) {
                    if ($company->getData()->users()->find($userId)) {
                        return new ServiceResponse(
                            false,
                            'User already added to company',
                            null,
                            400
                        );
                    }
                    $company->getData()->users()->attach($userId);
                } else {
                    return new ServiceResponse(
                        false,
                        'User not found',
                        null,
                        404
                    );
                }
            } else {
                return new ServiceResponse(
                    false,
                    'Company not found',
                    null,
                    404
                );
            }
        }

        return new ServiceResponse(
            true,
            'User added to companies',
            null,
            200
        );

    }

    public function removeUser(int $companyId, int $userId): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            $userService = app(IUserService::class);
            $user = $userService->getById($userId);
            if ($user->isSuccess()) {
                if (!$company->getData()->users()->find($userId)) {
                    return new ServiceResponse(
                        false,
                        'User not added to company',
                        null,
                        400
                    );
                }
                $company->getData()->users()->detach($userId);
                return new ServiceResponse(
                    true,
                    'User removed from company',
                    null,
                    200
                );
            } else {
                return new ServiceResponse(
                    false,
                    'User not found',
                    null,
                    404
                );
            }
        } else {
            return new ServiceResponse(
                false,
                'Company not found',
                null,
                404
            );
        }
    }

    public function addModule(int $companyId, int $moduleId): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            $moduleService = app(IModuleService::class);
            $module = $moduleService->getById($moduleId);
            if ($module->isSuccess()) {
                if ($company->getData()->modules()->find($moduleId)) {
                    return new ServiceResponse(
                        false,
                        'Module already added to company',
                        null,
                        400
                    );
                }
                $company->getData()->modules()->attach($moduleId);
                return new ServiceResponse(
                    true,
                    'Module added to company',
                    null,
                    200
                );
            } else {
                return new ServiceResponse(
                    false,
                    'Module not found',
                    null,
                    404
                );
            }
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function removeModule(int $companyId, int $moduleId): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            $moduleService = app(IModuleService::class);
            $module = $moduleService->getById($moduleId);
            if ($module->isSuccess()) {
                if (!$company->getData()->modules()->find($moduleId)) {
                    return new ServiceResponse(
                        false,
                        'Module not added to company',
                        null,
                        400
                    );
                }
                $company->getData()->modules()->detach($moduleId);
                CompanyModuleSetting::where('company_id', $companyId)->where('module_id', $moduleId)->delete();
                return new ServiceResponse(
                    true,
                    'Module removed from company',
                    null,
                    200
                );
            } else {
                return new ServiceResponse(
                    false,
                    'Module not found',
                    null,
                    404
                );
            }
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function getByCompanyModules(int $companyId): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            $modules = $company->getData()->modules;
            $modules->map(function ($module) use ($companyId) {
                $moduleSettings = CompanyModuleSetting::where('company_id', $companyId)->where('module_id', $module->id)->first();
                if ($moduleSettings) {
                    $module->settings = $moduleSettings->settings;
                } else {
                    $module->settings = null;
                }
            });

            return new ServiceResponse(
                true,
                'Modules found',
                $modules,
                200
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function setSettings(int $companyId, int $moduleId, mixed $settings): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            if ($company->getData()->modules()->find($moduleId)) {
                $moduleSettings = CompanyModuleSetting::where('company_id', $companyId)->where('module_id', $moduleId)->first();
                if ($moduleSettings) {
                    $moduleSettings->settings = $settings;
                    $moduleSettings->save();
                    return new ServiceResponse(
                        true,
                        'Module settings updated',
                        $moduleSettings,
                        200
                    );
                } else {
                    $moduleSettings = new CompanyModuleSetting();
                    $moduleSettings->company_id = $companyId;
                    $moduleSettings->module_id = $moduleId;
                    $moduleSettings->settings = $settings;
                    $moduleSettings->save();
                    return new ServiceResponse(
                        true,
                        'Module settings created',
                        $moduleSettings,
                        201
                    );
                }
            }
            return new ServiceResponse(
                false,
                'Module not added to company',
                null,
                400
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function getModuleSettings(int $companyId, int $moduleId): ServiceResponse
    {
        $company = $this->getById($companyId);
        if ($company->isSuccess()) {
            if ($company->getData()->modules()->find($moduleId)) {
                $moduleSettings = CompanyModuleSetting::where('company_id', $companyId)->where('module_id', $moduleId)->first();
                if ($moduleSettings) {
                    return new ServiceResponse(
                        true,
                        'Module settings found',
                        $moduleSettings,
                        200
                    );
                } else {
                    return new ServiceResponse(
                        false,
                        'Module settings not found',
                        null,
                        404
                    );
                }
            }
            return new ServiceResponse(
                false,
                'Module not added to company',
                null,
                400
            );
        }
        return new ServiceResponse(
            false,
            'Company not found',
            null,
            404
        );
    }

    public function setSettingsByUser(int $userId, int $companyId, int $moduleId, mixed $settings): ServiceResponse
    {
        $userService = app(IUserService::class);
        $user = $userService->getById($userId);
        if ($user->isSuccess()) {
            //check user companies
            $company = $user->getData()->companies()->find($companyId);
            if ($company) {
                $module = $company->modules()->find($moduleId);
                if ($module) {
                    $moduleSettings = CompanyModuleSetting::where('company_id', $companyId)->where('module_id', $moduleId)->first();
                    if ($moduleSettings) {
                        $moduleSettings->settings = $settings;
                        $moduleSettings->save();
                        return new ServiceResponse(
                            true,
                            'Module settings updated',
                            $moduleSettings,
                            200
                        );
                    }
                    return new ServiceResponse(
                        false,
                        'Module settings not found',
                        null,
                        404
                    );
                }
                return new ServiceResponse(
                    false,
                    'Module not added to company',
                    null,
                    400
                );
            }
            return new ServiceResponse(
                false,
                'Company not added to user',
                null,
                400
            );
        }
        return new ServiceResponse(
            false,
            'User not found',
            null,
            404
        );
    }
}
