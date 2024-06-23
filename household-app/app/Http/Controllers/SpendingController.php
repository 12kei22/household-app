<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Spending;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateSpendingRequest;
use App\Http\Requests\StoreSpendingRequest;

class SpendingController extends Controller
{
    public function index(Request $request, $projectId, $taskId)
    {



        $project = Project::with(['tasks', 'spendings'])->find($projectId);
        if (!$project) {
            abort(404, 'Project not found');
        }



        $spendings = Spending::where('project_id', $projectId)
                              ->where('task_id', $taskId)
                              ->get();


        $totalAmount = $spendings->sum('spending_amount');

        return view('spendings.index', compact('projectId','taskId', 'spendings', 'totalAmount'));
    }

    public function create($projectId, $taskId)
    {



        $spendingStatusStrings = Spending::SPENDING_STATUS_STRING;

        return view('spendings.create', compact(
            'taskId',
            'projectId',
            'spendingStatusStrings'
        ));
    }

    /**
     * タスク作成処理
     */
    public function store(StoreSpendingRequest $request, $projectId, $taskId)
    {

        try {
            DB::beginTransaction();
            $spending = Spending::create([
                'task_id' => $taskId,
                'project_id' => $projectId,
                'spending_name' => $request->spending_name,
                'due_date' => $request->due_date,
                'spending_amount' => $request->spending_amount,
                'spending_category' => Spending::SPENDING_STATUS_STRING[$request->spending_category],
            ]);
            DB::commit();

            $spendingId = $spending->id;
        } catch(\Exception $e) {
            DB::rollBack();
            Log::debug($e);
            abort(500);
        }

        return redirect()->route('spendings.index',['projectId' => $projectId, 'taskId' => $taskId]);

    }



    public function edit($projectId, $taskId, $spendingId)
    {



        $spending = Spending::find($spendingId);
        $spendingStatusStrings = Spending::SPENDING_STATUS_STRING;



        return view(
            'spendings.edit',
            compact(
                'taskId',
                'spending',
                'spendingStatusStrings',
                'projectId',
                'spendingId'
            )
        );
    }

    public function update(UpdateSpendingRequest  $request, $projectId, $taskId, $spendingId)
    {



        $spending = Spending::find($spendingId);


        DB::beginTransaction();

        try {

            $spending->fill([
                'task_id' => $taskId,
                'project_id' =>  $projectId,
                'spending_name' => $request->spending_name,
                'spending_amount' => $request->spending_amount,
                'due_date' => $request->due_date,
                'spending_category' =>  Spending::SPENDING_STATUS_STRING[$request->spending_category],
            ]);

            $spending->save();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            Log::debug($e);

            abort(500);
        }

        return redirect()->route('spendings.index', ['projectId' => $projectId, 'taskId' => $taskId]);


    }

    public function destroy($projectId, $taskId, $spendingId)
    {

        $spending = Spending::find($spendingId);

        try {
            DB::beginTransaction();
            $spending->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('spendings.index', ['projectId' => $projectId, 'taskId' => $taskId])->withErrors('Spending deletion failed');
        }

        return redirect()->route('spendings.index', ['projectId' => $projectId, 'taskId' => $taskId]);
    }

}
