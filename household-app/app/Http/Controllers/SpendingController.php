<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Spending;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateSpendingRequest;
use App\Http\Requests\StoreSpendingRequest;

class SpendingController extends Controller
{
    public function index(Request $request, $id)
    {
        // URLで送られてきたプロジェクトID
        $currentProjectId = $id;

        // プロジェクト取得
        $project = Project::find($currentProjectId);

        // プロジェクトに紐づく支出を取得
        $spendings = $project->spendings;

        $spending = $spendings->where('project_id', $currentProjectId)->first();
        // プロジェクトごとの支出合計を計算
        $totalAmount = $spendings->sum('spending_amount');

        return view('spendings.index', compact(
            'currentProjectId',
            'spendings',
            'spending',
            'totalAmount',

        ));
    }

    public function create($id, $spendingId)
    {
        $spending = Spending::find($spendingId);

        $currentProjectId = $id;
        $spendingStatusStrings = Spending::SPENDING_STATUS_STRING;

        return view('spendings.create', compact(
            'currentProjectId',
            'spending',
            'spendingStatusStrings',
        ));
    }

    /**
     * タスク作成処理
     */
    public function store(StoreSpendingRequest $request, $id)
    {
        // URLで送られてきたプロジェクトID
        $currentProjectId = $id;

        // トランザクション開始
        DB::beginTransaction();

        try {
            // タスク作成処理
            $spending = Spending::create([
                'project_id' => $currentProjectId,
                'spending_name' => $request->spending_name,
                'due_date' => $request->due_date,
            ]);

            // トランザクションコミット
            DB::commit();
        } catch(\Exception $e) {
            // トランザクションロールバック
            DB::rollBack();

            // ログ出力
            Log::debug($e);

            // エラー画面遷移
            abort(500);
        }

        return redirect()->route('spendings.index', [
            'id' => $currentProjectId,
        ]);
    }



    public function edit($id, $spendingId)
    {


        $spending = Spending::find($spendingId);

        $currentProjectId = $id;
        $spendingStatusStrings = Spending::SPENDING_STATUS_STRING;



        return view(
            'spendings.edit',
            compact(
                'spending',
                'spendingStatusStrings',
                'currentProjectId' ,
            )
        );
    }

    public function update(Request $request, $id, $spendingId)
    {

        $currentProjectId = $id;


        $spending = Spending::find($spendingId);


        DB::beginTransaction();

        try {

            $spending->fill([
                'project_id' => $currentProjectId,
                'spending_name' => $request->spending_name,
                'spending_amount' => $request->spending_amount,
                'due_date' => $request->due_date,
            ]);

            $spending->save();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            Log::debug($e);

            abort(500);
        }

        return redirect()->route('spendings.index', [
            'id' => $currentProjectId,
        ]);


    }

    public function destroy($spendingId)
    {

        $spending = Spending::find($spendingId);



        $spending->delete();


        return redirect()->route('spendings.index');
    }

}
