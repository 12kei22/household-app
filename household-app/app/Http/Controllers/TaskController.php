<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\Spending;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index(Request $request, $id)
    {
        $currentProjectId = $id;

        // プロジェクト取得
        $project = Project::with(['tasks', 'spendings'])->find($currentProjectId);

        if (!$project) {
            abort(404, 'Project not found');
        }

        // タスクごとの支出合計を計算
        $tasksWithTotalAmount = $project->tasks->map(function ($task) use ($project) {
            $task->total_amount = $project->spendings
                ->where('project_id', $task->id)
                ->sum('spending_amount');
            return $task;
        });

        return view('tasks.index', compact(
            'currentProjectId',
            'tasksWithTotalAmount'
        ));

    }

    public function create($id)
    {
        $currentProjectId = $id;

        return view('tasks.create', compact('currentProjectId'));
    }

    public function store(StoreTaskRequest $request, $id)
    {
        $currentProjectId = $id;

        DB::beginTransaction();

        try {
            Task::create([
                'project_id' => $currentProjectId,
                'spending_name' => $request->spending_name,
                'due_date' => $request->due_date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('tasks.index', ['id' => $currentProjectId])->withErrors('Task creation failed');
        }

        return redirect()->route('tasks.index', ['id' => $currentProjectId]);
    }

    public function update(UpdateTaskRequest $request, $id, $taskId)
    {
        $currentProjectId = $id;
        $task = Task::findOrFail($taskId);

        DB::beginTransaction();

        try {
            $task->update([
                'spending_name' => $request->spending_name,
                'spending_amount' => $request->spending_amount,
                'due_date' => $request->due_date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('tasks.index', ['id' => $currentProjectId])->withErrors('Task update failed');
        }

        return redirect()->route('tasks.index', ['id' => $currentProjectId]);
    }

    public function destroy($id, $taskId)
    {
        $task = Task::findOrFail($taskId);

        try {
            $task->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('tasks.index', ['id' => $id])->withErrors('Task deletion failed');
        }

        return redirect()->route('tasks.index', ['id' => $id]);
    }
}
