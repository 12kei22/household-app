@extends('layouts.layout')

@section('title')
支出記入
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">支出記入</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store', ['projectId' => $projectId]) }}">
                        @csrf

                        <div class="form-group d-flex flex-column flex-md-row">
                            <label for="spending_name" class="col-md-4 col-form-label text-md-right">カテゴリー：</label>
                            <div class="col-md-6">
                                <select name="spending_name" id="spending_name" class="form-select @error('spending_name') is-invalid @enderror">
                                    @foreach ($taskStatusStrings as $key => $taskStatusString)
                                        @if (!in_array($key, $usedStatuses))
                                            <option @if ($key==old('spending_name', '' )) selected @endif value="{{ $key}}">{{ $taskStatusString }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('spending_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex flex-column flex-md-row mt-3">
                            <label for="due_date" class="col-md-4 col-form-label text-md-right">支出日：</label>
                            <div class="col-md-6">
                                <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" required autocomplete="due_date" autofocus>
                                @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex mt-3 mb-0">
                            <div class="col-md-10 col-12 d-flex justify-content-end">

                                <a href="{{ route('tasks.index', $projectId) }}" style="margin-right: 10px;" class="btn btn-danger">戻る</a>
                                <button type="submit" class="btn btn-primary">作成</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
