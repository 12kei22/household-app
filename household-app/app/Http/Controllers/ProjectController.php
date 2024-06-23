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
        $projects = Project::where('user_id', Auth::id())->get();

        // Sort projects by MONTH_NAME order
        $projects = $projects->sortBy(function($project) {
            return array_search($project->project_name, Project::MONTH_NAME);
        });

        return view('projects.index',compact('projects'));
    }



    public function create()
    {
        $monthNames = Project::MONTH_NAME;
        $usedMonthNames = Project::where('user_id', Auth::id())->pluck('project_name')->toArray();

        // 使用されていない月をフィルタリング
        $availableMonthNames = array_diff($monthNames, $usedMonthNames);

        return view('projects.create', compact('availableMonthNames'));
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
