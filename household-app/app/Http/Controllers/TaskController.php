<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\Spending;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    public function index(Request $request , $projectId)
    {


        // プロジェクト取得
        $project = Project::with(['tasks', 'spendings'])->find($projectId);

        if (!$project) {
            abort(404, 'Project not found');
        }


        $tasksWithTotalAmount = $project->tasks->map(function ($task)  {
            $task->total_amount = Spending::where('task_id', $task->id)
                ->sum('spending_amount');
            return $task;
        });



        return view('tasks.index', compact(
            'projectId',

            'tasksWithTotalAmount'
        ));
    }

    public function create($projectId)
    {
        $usedStatuses = Task::where('project_id',$projectId)->pluck('spending_name')->toArray();

        $taskStatusStrings = Task::TASK_STATUS_STRING;

        return view('tasks.create', compact( 'projectId', 'taskStatusStrings', 'usedStatuses'));
    }

    public function store(StoreTaskRequest $request, $projectId)
    {
        try {
            DB::beginTransaction();
            $task = Task::create([
                'project_id' => $projectId,
                'spending_name' => Task::TASK_STATUS_STRING[$request->spending_name],
                'due_date' => $request->due_date,
            ]);
            DB::commit();

            $taskId = $task->id;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('tasks.index', ['projectId' => $projectId])->withErrors('Task creation failed');
        }

        return redirect()->route('tasks.index', ['projectId' => $projectId]);
    }


    public function destroy($projectId, $taskId)
    {
        $task = Task::find($taskId);

        try {
            $task->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('tasks.index', ['projectId' => $projectId])->withErrors('Task deletion failed');
        }

        return redirect()->route('tasks.index', ['projectId' => $projectId]);
    }
}
