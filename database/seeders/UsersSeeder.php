<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info('Creating default admin [it@displayplan.com / password]');
        
        $newUser = User::create([
            'name' => 'Displayplan Admin',
            'email' => 'it@displayplan.com',
            'password' => \Hash::make('password'),
            // 'active' => $user->active,
            // 'last_login' => preg_match("/0{4}/" , $user->last_login) ? null : $user->last_login,
            // 'created_at' => $user->created_at,
            // 'updated_at' => preg_match("/0{4}/" , $user->modified_at) ? null : $user->modified_at,
        ]);
        
        $rolePerms = Role::findByName('Admin')->permissions->toArray();

        $newUser->assignRole('Admin');

        foreach ($rolePerms as $rolePerm) {
            $newUser->givePermissionTo($rolePerm['name']);
            $this->command->info('Assigned role permission ' . $rolePerm['name']);
        }

    }
}
