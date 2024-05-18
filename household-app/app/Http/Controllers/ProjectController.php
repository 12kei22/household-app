<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects->all();

        return view('projects.index',compact('projects'));
    }



    public function create()
    {
        return view('projects.create');
    }

    public function create2()
    {
        return view('projects.create2');
    }

    public function store(StoreProjectRequest $request)
    {

        DB::beginTransaction();

        try {
            $project = Project::create([
                'project_name' => $request->project_name,
                'user_id' => Auth::id(),
            ]);

            DB::commit();
        }  catch(\Exception $e) {

            DB::rollBack();

            Log::debug($e);

            abort(500);
        }

        return redirect()->route('projects.index');
    }
}
