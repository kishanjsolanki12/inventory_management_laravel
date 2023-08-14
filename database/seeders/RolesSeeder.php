<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = file_get_contents(__DIR__ . '/json-dump/user_types.json');
 
        $usertypes = array(
            'User',
            'Approver',
            'Admin',
        );
 
        foreach ($usertypes as $role){
            Role::create(['name' => $role]);
        }

        // Create permissions

        $permission = Permission::create(['name' => 'view users']);
        $permission = Permission::create(['name' => 'create users']);
        $permission = Permission::create(['name' => 'edit users']);
        $permission = Permission::create(['name' => 'delete users']);

        $permission = Permission::create(['name' => 'view categories']);
        $permission = Permission::create(['name' => 'create categories']);
        $permission = Permission::create(['name' => 'edit categories']);
        $permission = Permission::create(['name' => 'delete categories']);

        $permission = Permission::create(['name' => 'view products']);
        $permission = Permission::create(['name' => 'create products']);
        $permission = Permission::create(['name' => 'edit products']);
        $permission = Permission::create(['name' => 'delete products']);

        $permission = Permission::create(['name' => 'view orders']);
        $permission = Permission::create(['name' => 'create orders']);
        $permission = Permission::create(['name' => 'edit orders']);
        $permission = Permission::create(['name' => 'delete orders']);
        $permission = Permission::create(['name' => 'approve orders']);

        $permission = Permission::create(['name' => 'view reports']);

        $roles = Role::get();

        foreach($roles as $role) {

            $this->command->info('Check roles for: '.$role->name);

            if($role->name == 'Admin') {

                $this->command->info('Assigning roles to: '.$role->name);

                $role->givePermissionTo('view users');
                $role->givePermissionTo('create users');
                $role->givePermissionTo('edit users');
                $role->givePermissionTo('delete users');
                
                $role->givePermissionTo('view categories');
                $role->givePermissionTo('create categories');
                $role->givePermissionTo('edit categories');
                $role->givePermissionTo('delete categories');

                $role->givePermissionTo('view products');
                $role->givePermissionTo('create products');
                $role->givePermissionTo('edit products');
                $role->givePermissionTo('delete products');

                $role->givePermissionTo('view orders');
                $role->givePermissionTo('create orders');
                $role->givePermissionTo('edit orders');
                $role->givePermissionTo('delete orders');

                $role->givePermissionTo('view reports');
            
            } elseif($role->name == 'User') {

                $this->command->info('Assigning roles to: '.$role->name);

                $role->givePermissionTo('view categories');

                $role->givePermissionTo('view products');

                $role->givePermissionTo('view orders');
                $role->givePermissionTo('create orders');
                $role->givePermissionTo('edit orders');
                $role->givePermissionTo('delete orders');

                $role->givePermissionTo('view reports');
            
            } elseif($role->name == 'Approver') {

                $this->command->info('Assigning roles to: '.$role->name);

                $role->givePermissionTo('view categories');

                $role->givePermissionTo('view products');
                
                $role->givePermissionTo('view orders');
                $role->givePermissionTo('create orders');
                $role->givePermissionTo('edit orders');
                $role->givePermissionTo('delete orders');
                $role->givePermissionTo('approve orders');

                $role->givePermissionTo('view reports');
            
            }
        }
    }

}
