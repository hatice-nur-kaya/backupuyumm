<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users' => [
                'description' => 'Kullanıcı Yetkileri',
                'permissions' => [
                    'users.getAll' => 'Kullanıcıları Görüntüleme',
                    'users.delete' => 'Kullanıcı Silme',
                    'users.update' => 'Kullanıcı Güncelleme',
                    'users.addCompany' => 'Kullanıcıya Şirket Ekleme',
                    'users.removeCompany' => 'Kullanıcıdan Şirket Silme',
                    'users.getCompaniesByUserId' => 'Kullanıcıya Ait Şirketleri Görüntüleme',
                    'users.getCompaniesByUser' => 'Kullanıcıya Ait Şirketleri Görüntüleme',
                    'users.role.getRoles' => 'Kullanıcıya Ait Rolleri Görüntüleme',
                    'users.role.setRole' => 'Kullanıcıya Rol Atama',
                    'users.role.deleteRole' => 'Kullanıcıdan Rol Silme',
                    'users.role.getRoleAndPermissions' => 'Kullanıcıya Ait Rol ve Yetkileri Görüntüleme',
                ],
            ],
            'company' => [
                'description' => 'Şirket Yetkileri',
                'permissions' => [
                    'company.getAll' => 'Şirketleri Görüntüleme',
                    'company.delete' => 'Şirket Silme',
                    'company.update' => 'Şirket Güncelleme',
                    'company.create' => 'Şirket Oluşturma',
                    'company.addUser' => 'Şirkete Kullanıcı Ekleme',
                    'company.removeUser' => 'Şirketten Kullanıcı Silme',
                    'company.getByUserCompanies' => 'Kullanıcıya Ait Şirketleri Görüntüleme',
                    'company.module.addModule' => 'Şirkete Modül Ekleme',
                    'company.module.removeModule' => 'Şirketten Modül Silme',
                    'company.module.getByCompanyModules' => 'Şirkete Ait Modülleri Görüntüleme',
                    'company.module.setModuleSetting' => 'Şirkete Ait Modül Ayarlarını Güncelleme',
                    'company.module.getModuleSetting' => 'Şirkete Ait Modül Ayarlarını Görüntüleme',
                ]
            ],
            'module' => [
                'description' => 'Modül Yetkileri',
                'permissions' => [
                    'module.getAll' => 'Modülleri Görüntüleme',
                    'module.getPrograms' => 'Programları Görüntüleme',
                    'module.getWebServices' => 'Web Servisleri Görüntüleme',
                    'module.getById' => 'Modül Bilgisi Görme',
                ]
            ],

            'roles' => [
                'description' => 'Rol Yetkileri',
                'permissions' => [
                    'roles.getAll' => 'Rolleri Görüntüleme',
                    'roles.getById' => 'Rol Bilgisi Görme',
                    'roles.delete' => 'Rol Silme',
                    'roles.update' => 'Rol Güncelleme',
                    'roles.create' => 'Rol Oluşturma',
                    'roles.setPermissions' => 'Role Yetki Ekleme',
                    'roles.getPermissions' => 'Role Ait Yetkileri Görüntüleme',
                    'roles.getAllPermissions' => 'Tüm Yetkileri Görüntüleme',
                ]
            ],
            'developer' => [
                'description' => 'Geliştirici (DİKKAT!!!)',
                'permissions' => []
            ]

        ];

        $user = User::create(
            [
                'name' => 'Test User',
                'email' => 'onur.evren@ayssoft.com',
                'password' => 'admin123',
            ]
        );

        $role = new \App\Models\Role();
        $role->name = 'Yönetici';
        $role->save();

        $permissionIds = [];
        foreach ($permissions as $category => $data) {
            $parentPermission = Permission::updateOrCreate([
                'name' => $data['description'],
                'permission' => $category,
                'parent_id' => null,
            ]);
            $permissionIds[] = $parentPermission->id;
            foreach ($data['permissions'] as $name => $description) {
               $childPermisson =  Permission::updateOrCreate([
                    'name' => $description,
                    'permission' => $name,
                    'parent_id' => $parentPermission->id,
                ]);
                $permissionIds[] = $childPermisson->id;
            }
        }
        $role->permissions()->sync($permissionIds);
        $user->roles()->attach($role->id);
    }
}
