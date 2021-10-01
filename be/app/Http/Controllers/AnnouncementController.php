<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['showall', 'destroy']]);
    }

    public function showall(Request $request){
        return response()->json(Announcement::with(['organization:id,organization'])->orderBy('what', $request->sort)->paginate(8));
    }

    public function index(Request $request){
        return response()->json(Announcement::where('organization_id', auth()->user()->userinfo->organization_id)->orderBy('what', $request->sort)->paginate(8));
    }

    public function store(AnnouncementRequest $request){
        Announcement::create($request->validated() + ['organization_id' => auth()->user()->userinfo->organization_id]);
        return $this->success('Announcement created successfully');

    }

    public function update(AnnouncementRequest $request, $id){
        $announcement = Announcement::find($id);
        if(!empty($announcement)){
            $announcement->update($request->validated());

            return $this->success('Announcement updated successfully!');
        }
        else {
            return $this->error('Something went wrong');
        }

    }

    public function destroy($id){
        Announcement::destroy($id);
        return $this->success('Announcement deleted successfully!');
    }
}
