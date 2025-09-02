<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\EditProfileRequest;



class UserController extends Controller
{
    public function showUsers(Request $request){

        $users = User::all();
       
        return view('user.index', 
            [
                'users'=> $users, 
                'name1'=> "Users", 
                'name2'=> "Users",
                'name3'=> "All Users",
            ]
        );
    }

    public function showDisabledUsers(Request $request){
        $users = User::where('status', 0)->get();
       
        return view('user.disabled', 
            [
                'users'=> $users, 
                'name1'=> "Users", 
                'name2'=> "Users",
                'name3'=> "Disabled Users",
            ]
        );
    }
    public function showAdminUsers(string $roleName = 'Super Admin' ){
        $role = Role::findByName($roleName); // Find the role by its name

        $users = $role->users; // Get users with the given role

        return view('user.admin', 
            [
                'users'=> $users, 
                'name1'=> "Users", 
                'name2'=> "Users",
                'name3'=> "Admin Users",
            ]
        );
    }

    public function showUserEditForm(Request $request, $userid){

        // validate the id to make sure that it hasnt changes or has anything suspicious in it 
        //
        $validator = Validator::make(['id' => $userid], [
            'id' => 'required|integer|exists:users,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($userid);
        $roles = Role::all();
        if($user){
            return view('user.edit',
                [
                    'user'=> $user, 
                    'roles'=> $roles,
                    'name1'=> "Users", 
                    'name2'=> "Users",
                    'name3'=> "Edit User",
                ]
            );
        }else {
            echo "User not found ";
        }
    }

    public function update(UpdateUserRequest $request, $userid)
    {
        $user = User::findOrFail($userid);

        // Grab the validated data
        $data = $request->validated();

        // Update user
        $user->update($data);

        // Sync role
        $user->syncRoles($data['role']);

        // Handle status & 2FA separately if needed
        $user->status = $data['status'];
        $user['2fa_enabled'] = $data['two_factor'];
        $user->save();

        return redirect()->route('users.show')->with('success', 'User updated successfully.');
    }


    public function showUserProfile(){
        $user = auth()->user();
        $userrole = "";
        
        if ($user) {
            // Check if user has roles
            if ($user->roles->isNotEmpty()) {
                foreach ($user->roles as $role) {
                    $userrole .= $role->name . ' ';
                }
            } else {
                $userrole = "User has no roles.";
            }
        } else {
            echo "User not found.";
        }
        if($user){

            $role = $user->role ?: 'No role name';
           
            return view('user.profile',
                [
                    'user'=> $user, 
                    'userrole' => $userrole,
                    'name1'=> "Account", 
                    'name2'=> "Account",
                    'name3'=> "Profile",
                ]
            );
        }else {
            echo "User not found ";
        }
    }

    public function editProfile(EditProfileRequest $request, $userid)
    {
        $user = User::findOrFail($userid);

        // Update user details directly from validated data
        $user->update($request->validated());

        // $user->two_factor = $request->input('two_factor');
        $user->save();

        return redirect()
            ->route('user.profile')
            ->with('success', 'Your profile has been updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user by ID or fail
        $user->delete(); // Delete the user

        return redirect()->route('users.show')->with('success', 'User has been deleted successfully.');
    }

    public function account(){
        $users = User::all();
       
        return view('user.account', 
            [
                'users'=> $users, 
                'name1'=> "Account", 
                'name2'=> "Account",
                'name3'=> "Manage Accounts",
            ]
        );
    }
    
}
