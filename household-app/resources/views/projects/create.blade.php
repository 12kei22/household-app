@extends('layouts.layout')

@section('title')
支出記入
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">支出月選択</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="form-group d-flex flex-column flex-md-row mt-3">
                            <label for="project_name" class="col-md-4 col-form-label text-md-right">支出月：</label>
                            <div class="col-md-6">
                                <select name="project_name" id="project_name" class="form-select @error('project_name') is-invalid @enderror">
                                    @foreach ($availableMonthNames as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                @error('project_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex mt-3 mb-0">
                            <div class="col-md-10 col-12 d-flex justify-content-end">
                                <a href="{{ route('projects.index') }}" class="mr-3 btn btn-secondary">戻る</a>
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
