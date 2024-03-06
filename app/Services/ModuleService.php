<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\IModuleService;
use App\Models\Module;

class ModuleService implements IModuleService
{

    public function getAll(): ServiceResponse
    {
        $modules = Module::with('webServices')->with('programs')->get();
        return new ServiceResponse(true, 'Modules retrieved successfully', $modules, 200);
    }

    public function getById(int $id): ServiceResponse
    {
        $module = Module::with('webServices')->with('programs')->find($id);
        if ($module) {
            return new ServiceResponse(true, 'Module retrieved successfully', $module, 200);
        } else {
            return new ServiceResponse(false, 'Module not found', null, 404);
        }
    }

    public function delete(int $id): ServiceResponse
    {
        // TODO: Implement delete() method.
    }

    public function getPrograms(int $moduleId): ServiceResponse
    {
        $module = $this->getById($moduleId);
        if ($module->isSuccess()) {
            return new ServiceResponse(true, 'Programs retrieved successfully', $module->getData()->programs, 200);
        } else {
            return new ServiceResponse(false, 'Module not found', null, 404);
        }
    }

    public function getWebServices(int $moduleId): ServiceResponse
    {
        $module = $this->getById($moduleId);
        if ($module->isSuccess()) {
            return new ServiceResponse(true, 'Web Services retrieved successfully', $module->getData()->webServices, 200);
        } else {
            return new ServiceResponse(false, 'Module not found', null, 404);
        }
    }
}
