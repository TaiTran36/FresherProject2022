<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission as Per;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tạo permission
        Per::create([
            'name'=>'dashboard',
            'display_name'=>'Login'
        ]);
        Per::create([
            'name'=>'all user',
            'display_name'=>'View all users'
        ]);
        Per::create([
            'name'=>'edit user',
            'display_name'=>'Edit user'
        ]);
        Per::create([
            'name'=>'delete user',
            'display_name'=>'Delete user'
        ]);
        Per::create([
            'name'=>'add post',
            'display_name'=>'Add post'
        ]);
        Per::create([
            'name'=>'all post',
            'display_name'=>'View all posts'
        ]);
        Per::create([
            'name'=>'edit post',
            'display_name'=>'Edit post'
        ]);
        Per::create([
            'name'=>'delete post',
            'display_name'=>'Delele post'
        ]);

        // tạo role
        Role::create([
            'name'=>'admin',
            'display_name'=>'Admin'
        ]);
        Role::create([
            'name'=>'modder',
            'display_name'=>'Modderator'
        ]);
        Role::create([
            'name'=>'user',
            'display_name'=>'Normal user'
        ]);

        //role-has-permission:
        $admin = Role::find(1); 
        $permissions_admin = [Per::find(1),Per::find(2),Per::find(3),Per::find(4),Per::find(5),Per::find(6),Per::find(7),Per::find(8)];
        $admin->syncPermissions($permissions_admin);

        $modder = Role::find(2); 
        $permissions_mod = [Per::find(1),Per::find(2),Per::find(5),Per::find(6),Per::find(7),Per::find(8)];
        $modder->syncPermissions($permissions_mod);

        // seeder role cho user:
        $user = User::find(1);
        $user->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('modder');

        $user = User::find(3);
        $user->assignRole('user');
        
        // seeder permisstion cho user:
        $user = User::find(1);
        $user->givePermissionTo('dashboard', 'all user','edit user','delete user','all post','edit post','delete post','add post');
    
        $user = User::find(2);
        $user->givePermissionTo('dashboard', 'all user','all post','edit post','delete post','add post');
    }
}