<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            'Product',
            'Productcategory',
            'Productsubcategory',
            'Productbrand',
            'Productmodel',
            'Producttype',
            'Productunit',
            'Stock',
            'StockUpdate',
            'Section',
            'Employee',
            'Designation',
            'User',
            'Role',
            'Permission'
        ]);

        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            Permission::create(['group' => $item, 'name' => 'viewAny' . $item]);
            Permission::create(['group' => $item, 'name' => 'view' . $item]);
            Permission::create(['group' => $item, 'name' => 'update' . $item]);
            Permission::create(['group' => $item, 'name' => 'create' . $item]);
            Permission::create(['group' => $item, 'name' => 'delete' . $item]);
            Permission::create(['group' => $item, 'name' => 'destroy' . $item]);
        });

        // Create a Super-Admin Role and assign all Permissions
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

         //Give User Super-Admin Role
        $user = User::where('email', 'shuvoworld@gmail.com')->first();
        if ($user) {
            $user->assignRole('super-admin');
        } else {
            $this->command->info('User with email shuvoworld@gmail.com not found.');
        }
    }
}
