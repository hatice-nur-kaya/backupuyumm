<?php

namespace App\Interfaces;


use App\Core\ServiceResponse;
use App\Interfaces\Eloquent\IEloquentService;

interface IModuleService extends IEloquentService
{
    public function getPrograms(int $moduleId): ServiceResponse;
    public function getWebServices(int $moduleId): ServiceResponse;
}
