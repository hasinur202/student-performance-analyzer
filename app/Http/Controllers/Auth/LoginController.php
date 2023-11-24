<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function userSignIn (Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6'
        ]);

        $isValid = false;
        if ($this->attempToLogin($request, 1)) {   // type = 1 -> Super Admin
            $isValid = true;
        } else if ($this->attempToLogin($request, 2)) { // Type = 2 -> Institute Admin Login
            $isValid = true;
        } else if ($this->attempToLogin($request, 3)) { // type = 3 -> Teacher Login
            $isValid = true;
        } else if ($this->attempToLogin($request, 4)) { // type = 4 -> Parent Login
            $isValid = true;
        } else if ($this->attempToLogin($request, 5)) { // type = 5 -> Student Login
            $isValid = true;
        } else {
            $isValid = false;
        }

        if ($isValid) {
            $permitted = $this->setCustomSession($request);
            if ($permitted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized User! Please contact with Admin.'
                ], 401);
            }

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username or password is not valid.'
            ], 422);
        }
    }

    
    public function setCustomSession ($request) {
        $userData = auth()->user();
        if ($userData->type == 1) {
            return true;
        } else if ($userData->type == 2) {
            $institue = DB::table('institute_informations')->where('admin_id', $userData->id)->first();
            if ($institue) {
                $request->session()->put('institute_id', $institue->id);
                return true;
            } else {
                $this->logout($request);
            }
        } else {
            return true;
        }
    }


    public function attempToLogin ($request, $type) {
        return Auth::attempt([
            'username'     => $request->username,
            'password'  => $request->password,
            'status' => 1,
            'type' => $type
        ]);   
    }


    public function userSignUp (Request $request) {
        $data = $request->validate([
            'name'  =>  'required',
            'email'  => 'required|email|unique:users,email',
            'mobile_no'  => 'required|unique:users,mobile_no',
            'password'  =>  'required|min:6'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['mobile_no'],
            'mobile_no' => $request['mobile_no'],
            'password' => Hash::make($data['password'])
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong! Please Try Again.'
            ], 500);
        }

    }


    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->flush();

            return redirect()->route('frontend.home');
        }
    }
}
