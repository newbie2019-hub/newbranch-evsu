<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use App\Http\Requests\StudentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'store']]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'gender' => 'required',
        ]);

        $userinfo = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'type' => $request->type,
            'contact_number' => $request->contact,
        ];

        UserInfo::where('id', $id)->update($userinfo);
        
        $user = [
            'email' => $request->email
        ];

        if($request->password){
            $user['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($user);

        $user = User::with(['info'])->where('id', $id)->first();
        return response()->json(['success' => 'Account updated successfuly!', 'user' => $user], 200);
    }

    public function store(StudentsRequest $request)
    {
        $userinfo = UserInfo::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'type' => $request->type,
            'contact' => $request->contact,
            'year_level' => $request->year_level,
            'section_id' => $request->section_id,
            'organization_id' => $request->organization_id,
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_id' => $request->student_id,
            'user_info_id' => $userinfo->id,
        ]);

        return $this->success('Student registered successfully');
    }
    
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('account_status', 'pending')->first();

        if($user) {
            return response()->json(['msg' => 'Your account is still pending for apporval'], 403);
        }
        else
        {
            if (! $token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'User logged out successfully!']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

    public function me()
    {
        $account = User::with(['userinfo'])->where('id', auth('api')->user()->id)->first();
        return response()->json($account);
    }
}
