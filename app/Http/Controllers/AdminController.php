<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class AdminController extends Controller
{

    // Admin Profile View
    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));

    }//end method

    // Admin Profile Edit
    public function edit_profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_edit', compact('adminData'));
    }//end method

    // Store Updated Profile Data
    public function update_profile(Request $request){

        $id = Auth::user()->id;

        $validate_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)]
        ]);

        $user_data = User::find($id);

        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->username = $request->username;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);

            $user_data['profile_image'] =  $filename;
        }
        $user_data->save();

        // Toastr notification
       $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);

    }//end method



    // Admin Change Password
    public function change_password()
    {
        return view('admin.admin_change_password');
    } //end of method

    // Admin Update Password
    public function update_password(Request $request)
    {
        $validate_data = $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => 'required|same:new_password'
        ]);

        $hashed_password = Auth::user()->password;
        if(Hash::check($request->old_password, $hashed_password)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password Changed Successfully');
            session()->flash('alert-type', 'success');
            return redirect()->back();

        }else {
            session()->flash('message', 'Old Password is not match');
            session()->flash('alert-type', 'error');
            return redirect()->back();
        }
    } //end of method


    // Admin logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } //end of method
}
