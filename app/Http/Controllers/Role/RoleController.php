<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    

    public function showRoles(){

        $roles = Role::all();
        $permissions = Permission::all();


        $userPermissions = Permission::where('name', 'like', 'user.%')->get();
        $rolePermissions = Permission::where('name', 'like', 'role.%')->get();
        $permissionPermissions = Permission::where('name', 'like', 'permission.%')->get();
        $dashboardPermissions = Permission::where('name', 'like', 'dashboard.%')->get();
        $settingPermissions = Permission::where('name', 'like', 'settings.%')->get();
        $profilePermissions = Permission::where('name', 'like', 'profile.%')->get();

        return view('role.index',
            [
                'roles' => $roles,
                'usersP' => $userPermissions,
                'roleP' => $rolePermissions,
                'permissionP' => $permissionPermissions,
                'dashboardP' => $dashboardPermissions,
                'settingsP' => $settingPermissions,
                'profileP' => $profilePermissions,
                'name1' => 'Roles',
                'name2' => 'Roles',
                'name3' => 'View All Roles',
            ]
        );

    }

    public function store(StoreRoleRequest $request)
    {
        $roleData = $request->except('permissions');

        $role = Role::create($roleData);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.show')->with('success', 'Role created successfully');
    }



    public function showRoleEditForm(Request $request, $roleid){

        $role = Role::findOrFail($roleid);
        $rolesPermissions = $role->permissions;


        $userPermissions = Permission::where('name', 'like', 'user.%')->get();
        $rolePermissions = Permission::where('name', 'like', 'role.%')->get();
        $permissionPermissions = Permission::where('name', 'like', 'permission.%')->get();
        $dashboardPermissions = Permission::where('name', 'like', 'dashboard.%')->get();
        $settingPermissions = Permission::where('name', 'like', 'settings.%')->get();
        $profilePermissions = Permission::where('name', 'like', 'profile.%')->get();

        return view('role.edit',
        [
            'role' => $role,
            'usersP' => $userPermissions,
            'roleP' => $rolePermissions,
            'permissionP' => $permissionPermissions,
            'dashboardP' => $dashboardPermissions,
            'settingsP' => $settingPermissions,
            'profileP' => $profilePermissions,
            'rolePermissions' => $rolesPermissions,
            'name1' => 'Roles',
            'name2' => 'Roles',
            'name3' => 'View All Roles',
        ]
        );

    }




    public function update(UpdateRoleRequest $request, $roleId)
    {
        DB::beginTransaction();

        try {
            $role = Role::findOrFail($roleId);

            $role->name = $request->validated()['name'];
            $role->guard_name = $request->input('guard_name', 'web');
            $role->save();

            $role->permissions()->sync($request->validated()['permissions'] ?? []);

            DB::commit();

            return redirect()
                ->route('roles.show')
                ->with('success', 'Role updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating role: '.$e->getMessage());
        }
}
}
