<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
        ]);
       
        // $role = Role::create(['name' => 'admin']);
        // $permission[1] = Permission::create(['name' => 'Category Management']);
        // $permission[2] = Permission::create(['name' => 'Subcategory Management']);
        // $permission[3] = Permission::create(['name' => 'Product Management']);
        // $permission[4] = Permission::create(['name' => 'Voucher Management']);
        // $permission[5] = Permission::create(['name' => 'User Management']);
        // $permission[6] = Permission::create(['name' => 'Role Management']);
        
        // foreach ($permission as $key => $value) {
        //     $role->givePermissionTo($value);
        // }
        
        // $role = Role::create(['name' => 'user']);
        // $user = User::findOrFail(1);

        // $user->assignRole('admin');
            
        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('customer')
        ]);
    }
}
