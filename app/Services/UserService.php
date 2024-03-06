<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\ICompanyService;
use App\Interfaces\IRoleService;
use App\Interfaces\IUserService;
use App\Models\CompanyModuleSetting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    public function login(string $email, string $password): ServiceResponse
    {
        $user = $this->getByEmail($email);
        if ($user->isSuccess()) {
            if (Hash::check($password, $user->getData()->password)) {
                $token = $user->getData()->createToken('userApiToken')->plainTextToken;

                $permissions = [];
                $roles = $user->getData()->roles()->get();
                foreach ($roles as $role) {
                    $rolePermissions = $role->permissions()->get();
                    foreach ($rolePermissions as $permission) {
                        $permissions[] = $permission->permission;
                    }
                }
                $user->getData()->yetkiler = $permissions;

                return new ServiceResponse(
                    true,
                    'User logged in successfully',
                    [
                        'token' => $token,
                        'user' => $user->getData()
                    ],
                    200,
                );
            } else {
                return new ServiceResponse(
                    false,
                    'Incorrect password',
                    null,
                    401
                );
            }
        } else {
            return $user;
        }
    }

    public function getByEmail(string $email): ServiceResponse
    {
        $user = User::where('email', $email)->first();
        if ($user == null) {
            return new ServiceResponse(false, "User not found", null, 404);
        }
        return new ServiceResponse(true, "User fetched successfully", $user, 200);
    }

    public function create(string $name, string $email, string $password): ServiceResponse
    {
        $checkUser = $this->getByEmail($email);
        if ($checkUser->isSuccess()) {
            return new ServiceResponse(false, "User already exists", null, 400);
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();
        return new ServiceResponse(true, "User created successfully", $user, 200);
    }

    public function update(int $id, string $name, string $email, string $password = null): ServiceResponse
    {
        $user = $this->getById($id);
        if ($user->isSuccess()) {
            $user = $user->getData();
            $user->name = $name;
            $user->email = $email;
            if ($password != null) {
                $user->password = $password;
            }
            $user->save();
            return new ServiceResponse(true, "User updated successfully", $user, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function addCompany(int $userId, int $companyId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {

            $companyService = app(ICompanyService::class);
            $company = $companyService->getById($companyId);
            if (!$company->isSuccess()) {
                return new ServiceResponse(false, "Company not found", null, 404);
            }
            if ($user->getData()->companies->contains($companyId)) {
                return new ServiceResponse(false, "Company already added to user", null, 400);
            }
            $user->getData()->companies()->attach($companyId);
            return new ServiceResponse(true, "Company added to user successfully", [], 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function removeCompany(int $userId, int $companyId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $companyService = app(ICompanyService::class);
            $company = $companyService->getById($companyId);
            if (!$company->isSuccess()) {
                return new ServiceResponse(false, "Company not found", null, 404);
            }
            if (!$user->getData()->companies->contains($companyId)) {
                return new ServiceResponse(false, "Company not added to user", null, 400);
            }
            $user->getData()->companies()->detach($companyId);
            return new ServiceResponse(true, "Company removed from user successfully", [], 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function getCompanies(int $userId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $companies = $user->getData()->companies;
            $companies = $companies->map(function ($company) {
                $modules = $company->modules()->get();
                $modules = $modules->map(function ($module) {
                    $module->setting = CompanyModuleSetting::where('company_id', $module->pivot->company_id)->where('module_id', $module->pivot->module_id)->first();
                    return $module;
                });
                $company->modules = $modules;
                return $company;
            });

            return new ServiceResponse(true, "Companies fetched successfully", $companies, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function setRole(int $userId, int $roleId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $roleService = app(IRoleService::class);
            $role = $roleService->getById($roleId);
            if (!$role->isSuccess()) {
                return new ServiceResponse(false, "Role not found", null, 404);
            }
            if ($user->getData()->roles->contains($roleId)) {
                return new ServiceResponse(false, "Role already set to user", null, 400);
            }
            $user->getData()->roles()->attach($roleId);
            return new ServiceResponse(true, "Role set to user successfully", [], 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function getRoles(int $userId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $roles = $user->getData()->roles;
            return new ServiceResponse(true, "Roles fetched successfully", $roles, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function getRoleAndPermissions(int $userId, int $roleId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $roleService = app(IRoleService::class);
            $role = $roleService->getById($roleId);
            if (!$role->isSuccess()) {
                return new ServiceResponse(false, "Role not found", null, 404);
            }

            if (!$user->getData()->roles->contains($roleId)) {
                return new ServiceResponse(false, "Role not set to user", null, 400);
            }

            $roleData = $user->getData()->roles()->where('role_id', $roleId)->first();
            $permissions = $roleData->permissions()->get();
            $permissionData = [];
            foreach ($permissions as $permission) {
                if ($permission->parent_id == null) {
                    $permissionData[] = [
                        'id' => $permission->id,
                        'parent_id' => $permission->parent_id,
                        'name' => $permission->name,
                        'permission' => $permission->permission,
                        'created_at' => $permission->updated_at,
                        'updated_at' => $permission->updated_at,
                        'children' => $permission->children
                    ];
                }

            }

            return new ServiceResponse(true, "Permissions fetched successfully", $permissionData, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function deleteRole(int $userId, int $roleId): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $roleService = app(IRoleService::class);
            $role = $roleService->getById($roleId);
            if (!$role->isSuccess()) {
                return new ServiceResponse(false, "Role not found", null, 404);
            }
            if (!$user->getData()->roles->contains($roleId)) {
                return new ServiceResponse(false, "Role not set to user", null, 400);
            }
            $user->getData()->roles()->detach($roleId);
            return new ServiceResponse(true, "Role removed from user successfully", [], 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    public function updateProfile(int $id, string $password,): ServiceResponse
    {
        $user = $this->getById($id);
        if ($user->isSuccess()) {
            $user = $user->getData();
            $user->password = $password;
            $user->save();
            return new ServiceResponse(true, "User updated successfully", $user, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): ServiceResponse
    {
        $user = User::with('companies', 'roles')->get();
        return new ServiceResponse(true, "User list fetched successfully", $user, 200);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): ServiceResponse
    {
        $user = User::find($id);
        if ($user == null) {
            return new ServiceResponse(false, "User not found", null, 404);
        }
        return new ServiceResponse(true, "User fetched successfully", $user, 200);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ServiceResponse
    {
        $user = $this->getById($id);
        if ($user->isSuccess()) {
            $user->getData()->delete();
            return new ServiceResponse(true, "User deleted successfully", null, 200);
        }
        return new ServiceResponse(false, "User not found", null, 404);
    }
}
