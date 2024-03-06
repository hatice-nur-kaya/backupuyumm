<?php

namespace App\Interfaces;

use App\Core\ServiceResponse;
use App\Interfaces\Eloquent\IEloquentService;

interface IUserService extends IEloquentService
{
    public function login(
        string $email,
        string $password
    ): ServiceResponse;
    public function getByEmail(
        string $email
    ): ServiceResponse;

    public function create(
        string $name,
        string $email,
        string $password
    ): ServiceResponse;

    public function update(
        int $id,
        string $name,
        string $email,
        string $password = null
    ): ServiceResponse;

    public function addCompany(
        int $userId,
        int $companyId
    ): ServiceResponse;

    public function removeCompany(
        int $userId,
        int $companyId
    ): ServiceResponse;

    public function getCompanies(int $userId): ServiceResponse;

    public function setRole(
        int $userId,
        int $roleId
    ): ServiceResponse;

    public function getRoles(int $userId): ServiceResponse;

    public function getRoleAndPermissions(int $userId,int $roleId): ServiceResponse;

    public function deleteRole(int $userId,int $roleId): ServiceResponse;

    public function updateProfile(
        int $id,
        string $password,
    ): ServiceResponse;



}
