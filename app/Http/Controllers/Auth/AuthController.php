<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;




class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest  $request)
    {
        $data = $request->validated();
    
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('User');
        Auth::login($user);
        
        event(new Registered($user));

        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
    
            if ($user->status != 1) {
                Auth::logout();
                return redirect()->route('account.disabled');
            }
    
            return redirect()->route('dashboard');
        }
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'The password is incorrect.'
                ]);
        } else {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'User with that email does not exist.'
                ]);
        }
    }
    


    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }


    public function logout(Request $request)
    {
        // Logout the user
        auth()->logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate the session token
        $request->session()->regenerateToken();
        
        // Redirect to the homepage or login page
        return redirect('/');
    }
    public function handleEmailConfirmation(EmailVerificationRequest $request){
        $request->fulfill();
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('status', 'Verification has been completed, please login to continue.');
    }
    public function verifyEmail(){
        return view('auth.verify-email');
    }

    public function accDisabled(Request $request){
        $this->logout($request);
        return redirect()->route('login')->with('error', "Your account has been disabled, please contact any of administrators for more details.");
    }
    public function resendVerificationEmail(Request $request){
        $user = auth()->user();

        // Check if the user has already verified their email
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('status', 'Your email is already verified.');
        }else{
            $user->sendEmailVerificationNotification();
            //$this->logout($request);
            return back()->with('status', 'Verification link has been sent to your email!');
        }
    }

}
