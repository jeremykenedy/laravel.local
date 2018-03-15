<?php

use App\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Available Permissions
         *
         */
        $allPermissions = Permission::all();
        $viewSocialObjects = Permission::where('slug', '=', 'view.socialobject')->first();
        $createSocialObjects = Permission::where('slug', '=', 'create.socialobject')->first();
        $editSocialObjects = Permission::where('slug', '=', 'edit.socialobject')->first();
        $deleteSocialObjects = Permission::where('slug', '=', 'delete.socialobject')->first();

        /**
         * Attach All Permissions to Admin Roles
         *
         */
        $roleAdmin = Role::where('name', '=', 'Admin')->first();
        foreach ($allPermissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }


        /**
         * Attach Enterprise Permissions to Enterprise Roles
         *
         */
        $enterpriseRole = Role::where('name', '=', 'Enterprise')->first();
        $enterpriseRole->attachPermission($viewSocialObjects);
        $enterpriseRole->attachPermission($createSocialObjects);
        $enterpriseRole->attachPermission($editSocialObjects);
        $enterpriseRole->attachPermission($deleteSocialObjects);
    }

}
