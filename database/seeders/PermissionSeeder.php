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
            ['name' => 'Role', 'guard_name' => 'web', 'created_at' => now()],

            ['name' => 'User', 'guard_name' => 'web', 'created_at' => now()],

            ['name' => 'Student', 'guard_name' => 'web', 'created_at' => now()],
            ['name' => 'Teacher', 'guard_name' => 'web', 'created_at' => now()],


            ['name' => 'Course', 'guard_name' => 'web', 'created_at' => now()],

            ['name' => 'Material', 'guard_name' => 'web', 'created_at' => now()],

            ['name' => 'Assignment', 'guard_name' => 'web', 'created_at' => now()],

            //create attendance
            ['name' => 'Attendance', 'guard_name' => 'web', 'created_at' => now()],

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
            'Course',
            'Student',
            'Material',
            'Assignment',
            'Attendance'
        ]);

        //student role
        $student = Role::create([
            'name' => 'Student',
            'guard_name' => 'web',
            'description' => 'Student Role',
        ]);
        $student->syncPermissions([
            'Course',
        ]);


        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@learnify.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => '2022-01-02 17:04:58',
            'created_at' => now(),
        ]);
        $admin->assignRole($super_admin);
    }
}
