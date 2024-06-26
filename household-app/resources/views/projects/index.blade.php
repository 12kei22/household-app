@extends('layouts.layout')

@section('title')
    支出一覧
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center">
                        <p class="mb-0 h5">支出月</p>
                        <a href="{{ route('projects.create') }}" class="btn btn-primary">追加</a>
                    </div>
                    <table class="table table-hover mb-0">
                        <tbody class="text-center">
                            @foreach($projects as $project)
                              <tr>
                                <td><a href="{{ route('tasks.index',$project->id) }}">{{ $project->month_name }}</a></td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
