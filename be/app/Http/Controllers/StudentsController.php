<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::with(['userinfo', 'userinfo.section:id,section,year_level', 'userinfo.organization:id,organization'])->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        $userinfo = UserInfo::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'type' => $request->type,
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
        return $this->success('Student created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userinfo = UserInfo::find($id);
        $user = User::find($id);

        if(!empty($userinfo)){
            $userinfo->update([
                'first_name' => $request->userinfo['first_name'],
                'middle_name' => $request->userinfo['middle_name'],
                'last_name' => $request->userinfo['last_name'],
                'gender' => $request->userinfo['gender'],
                'contact' => $request->userinfo['contact'],
                'type' => $request->userinfo['type'],
                'year_level' => $request->userinfo['year_level'],
                'section_id' => $request->userinfo['section_id'],
                'organization_id' => $request->userinfo['organization_id'],
            ]);

            $user->update([
                'email' => $request->email,
                'student_id' => $request->student_id,
            ]);

            $updated_user = User::with(['userinfo', 'userinfo.section:id,section,year_level', 'userinfo.organization:id,organization'])->find($id);
            return response()->json([$updated_user, 'msg' => 'Student information updated successfully!']);
        }
        else 
        {
            return $this->error('Student data not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return $this->success('Student record deleted successfully');
    }
}
