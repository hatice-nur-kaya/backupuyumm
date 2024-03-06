<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserTicketController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('getAll', [UserController::class, 'getAll'])->middleware('permission:users.getAll');
        Route::get('getById', [UserController::class, 'getById'])->middleware('permission:users.getAll');
        Route::delete('delete', [UserController::class, 'delete'])->middleware('permission:users.delete');
        Route::post('create', [UserController::class, 'create'])->middleware('permission:users.create');
        Route::put('update', [UserController::class, 'update'])->middleware('permission:users.update');
        Route::post('addCompany', [UserController::class, 'addCompany'])->middleware('permission:users.addCompany');
        Route::delete('removeCompany', [UserController::class, 'removeCompany'])->middleware('permission:users.removeCompany');
        Route::get('getCompaniesByUserId', [UserController::class, 'getCompaniesByUserId'])->middleware('permission:users.getCompaniesByUserId');
        Route::get('getCompaniesByUser', [UserController::class, 'getCompaniesByUser']);
        Route::group(['prefix' => 'role'], function () {
            Route::get('getRoles', [UserController::class, 'getRoles'])->middleware('permission:users.role.getRoles');
            Route::post('setRole', [UserController::class, 'setRole'])->middleware('permission:users.role.setRole');
            Route::delete('deleteRole', [UserController::class, 'deleteRole'])->middleware('permission:users.role.deleteRole');
            Route::get('getRoleAndPermissions', [UserController::class, 'getRoleAndPermissions'])->middleware('permission:users.role.getRoleAndPermissions');
        });
        Route::post('updateProfile', [UserController::class, 'updateProfile']);

    });
    Route::group(['prefix' => 'company','middleware' => 'permission:company'], function () {
        Route::get('getAll', [CompanyController::class, 'getAll'])->middleware('permission:company.getAll');
        Route::get('getById', [CompanyController::class, 'getById'])->middleware('permission:company.getAll');
        Route::delete('delete', [CompanyController::class, 'delete'])->middleware('permission:company.delete');
        Route::post('create', [CompanyController::class, 'create'])->middleware('permission:company.create');
        Route::put('update', [CompanyController::class, 'update'])->middleware('permission:company.update');
        Route::post('addUser', [CompanyController::class, 'addUser'])->middleware('permission:company.addUser');
        Route::delete('removeUser', [CompanyController::class, 'removeUser'])->middleware('permission:company.removeUser');
        Route::get('getByUserCompanies', [CompanyController::class, 'getByUserCompanies'])->middleware('permission:company.getByUserCompanies');
        Route::post('setSettingsByUser', [CompanyController::class, 'setSettingsByUser']);
       Route::group(['prefix' => 'module'], function () {
            Route::post('addModule', [CompanyController::class, 'addModule'])->middleware('permission:company.module.addModule');
            Route::delete('removeModule', [CompanyController::class, 'removeModule'])->middleware('permission:company.module.removeModule');
            Route::get('getByCompanyModules', [CompanyController::class, 'getByCompanyModules'])->middleware('permission:company.module.getByCompanyModules');
            Route::post('setModuleSetting', [CompanyController::class, 'setModuleSetting'])->middleware('permission:company.module.setModuleSetting');
            Route::get('getModuleSetting', [CompanyController::class, 'getModuleSetting'])->middleware('permission:company.module.getModuleSetting');
        });
    });

    Route::group(['prefix' => 'module'], function () {
        Route::get('getAll', [ModuleController::class, 'getAll'])->middleware('permission:module.getAll');
        Route::get('getPrograms', [ModuleController::class, 'getPrograms'])->middleware('permission:module.getPrograms');
        Route::get('getWebServices', [ModuleController::class, 'getWebServices'])->middleware('permission:module.getWebServices');
        Route::get('getById', [ModuleController::class, 'getById'])->middleware('permission:module.getById');

    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('getAll', [RoleController::class, 'getAll'])->middleware('permission:roles.getAll');
        Route::get('getById', [RoleController::class, 'getById'])->middleware('permission:roles.getAll');
        Route::delete('delete', [RoleController::class, 'delete'])->middleware('permission:roles.delete');
        Route::post('create', [RoleController::class, 'create'])->middleware('permission:roles.create');
        Route::put('update', [RoleController::class, 'update'])->middleware('permission:roles.update');
        Route::get('getPermissions', [RoleController::class, 'getPermissions'])->middleware('permission:roles.getPermissions');
        Route::post('setPermissions', [RoleController::class, 'setPermissions'])->middleware('permission:roles.setPermissions');
        Route::get('getAllPermissions', [RoleController::class, 'getAllPermissions'])->middleware('permission:roles.getAllPermissions');
    });

    Route::group(['prefix' => 'ticket'], function () {
        Route::get('getAll', [TicketController::class, 'getAll']);
        Route::get('getById', [TicketController::class, 'getById']);
        Route::post('sendMessage', [TicketController::class, 'sendMessage']);
        Route::post('updateStatus', [TicketController::class, 'updateStatus']);
    });

    Route::group(['prefix' => 'user/ticket'], function () {
        Route::get('getAll', [UserTicketController::class, 'getAll']);
        Route::post('create', [UserTicketController::class, 'create']);
        Route::post('sendMessage', [UserTicketController::class, 'sendMessage']);
        Route::get('getById', [UserTicketController::class, 'getById']);

    });


    Route::group(['prefix' => 'frontend'], function () {
        Route::get('getAllCompanies', [FrontendController::class, 'getAllCompanies']);
    });
});
