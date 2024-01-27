<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'Add Role','guard_name' => 'web', 'created_at' => now()],
            ['name' => 'View Role','guard_name' => 'web', 'created_at' => now()],
            ['name' => 'Edit Role','guard_name' => 'web', 'created_at' => now()],
            ['name' => 'Delete Role','guard_name' => 'web','created_at' => now()],

            ['name' => 'Add User','guard_name' => 'web','created_at' => now()],
            ['name' => 'View User','guard_name' => 'web','created_at' => now()],
            ['name' => 'Edit User','guard_name' => 'web','created_at' => now()],
            ['name' => 'Delete User','guard_name' => 'web','created_at' => now()],

            ['name' => 'Add Teacher','guard_name' => 'web','created_at' => now()],
            ['name' => 'View Teacher','guard_name' => 'web','created_at' => now()],
            ['name' => 'Edit Teacher','guard_name' => 'web','created_at' => now()],                
            ['name' => 'Delete Teacher','guard_name' => 'web','created_at' => now()],

            ['name' => 'Add Student','guard_name' => 'web','created_at' => now()],
            ['name' => 'View Student','guard_name' => 'web','created_at' => now()],
            ['name' => 'Edit Student','guard_name' => 'web','created_at' => now()],
            ['name' => 'Delete Student','guard_name' => 'web','created_at' => now()],


            ['name' => 'Add Course','guard_name' => 'web','created_at' => now()],
            ['name' => 'View Course','guard_name' => 'web','created_at' => now()],
            ['name' => 'Edit Course','guard_name' => 'web','created_at' => now()],
            ['name' => 'Delete Course','guard_name' => 'web','created_at' => now()],

        ]);

        //super admin role
        $super_admin = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'description' => 'Super Admin Role',
        ]);
        $permissions = Permission::all();
        $super_admin->syncPermissions($permissions);

        //teacher role
        $teacher = Role::create([
            'name' => 'Teacher',
            'guard_name' => 'web',
            'description' => 'Teacher Role',
        ]);
        $teacher->syncPermissions([
            'Add Course',
            'View Course',
            'Edit Course',
            'Delete Course',

            'Add Student',
            'View Student',
            'Edit Student',
            'Delete Student',
        ]);

        //student role
        $student = Role::create([
            'name' => 'Student',
            'guard_name' => 'web',
            'description' => 'Student Role',
        ]);
        $student->syncPermissions([
            'View Course',
        ]);
        
        
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@learnify.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=>'2022-01-02 17:04:58',
            'created_at' => now(),
        ]);
        $admin->assignRole($super_admin);
    }
}
