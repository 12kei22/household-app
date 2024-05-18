@extends('layouts.layout')

@section('title')
    支出一覧
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="column col-md-8 offset-md-2 mt-md-0 mt-3">
                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center">
                        <p class="mb-0 h5">支出一覧</p>
                        <a href="{{ route('tasks.create', $currentProjectId) }}" class="btn btn-primary">追加</a>
                    </div>
                    <table class="table table-hover mb-0">
                        <thead class="text-light" style="background-color: rgb(106, 106, 106)">
                            <tr class="text-center">
                                <th scope="col"style="width: 65%">カテゴリー</th>
                                <th scope="col" style="width: 15%">合計金額</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">

                        @foreach ($tasksWithTotalAmount as $task)
                                <tr>
                                    <td><a href="{{ route('spendings.index', $task->id) }}">{{ $task->spending_name }}</a></td>
                                    <td><span>{{ number_format($task->total_amount) }}</span></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
