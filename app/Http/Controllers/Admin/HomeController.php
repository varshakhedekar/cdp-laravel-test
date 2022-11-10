<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Auth;
use Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        die("InHomeController");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        if(auth()->user())
            return redirect()->route('admin.dashboard');
        else
            return view('admin.login');
    }
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function changePassword()
    {
        $currentPassword = Auth::user()->password;
        return view('admin.change-password', compact('currentPassword'));
    }
    
    public function changePasswordStore(Request $request)
    {
        $id = Auth::user()->id;
        $currentPassword = Auth::user()->password;
        $passwordCompare = Hash::check($request->current_password, $currentPassword);
        if($passwordCompare != 1){
            return redirect()->route('admin.setting.change-password')->with(['currentPasswordError' => 'Password does not match with current password.']);
        }
        else{
            $adminUser = AdminUser::where('id', $id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            if(isset($adminUser)){
                return redirect()->route('admin.setting.change-password')->with(['message' => 'Password updated successfully.']);
            }
            else{
                return redirect()->route('admin.setting.change-password')->with(['error' => 'There seems to be some issue with the data. Please try again.']);
            }
        }
    }
}
