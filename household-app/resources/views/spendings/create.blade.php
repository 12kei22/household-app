@extends('layouts.layout')

@section('title')
支出追加
@endsection

@section('content')
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-center">支出追加</div>

        <div class="card-body">
          <form method="POST" action="{{ route('spendings.store', [$projectId, $taskId]) }}">
            @csrf

            <div class="form-group d-flex flex-column flex-md-row">
              <label for="spending_name" class="col-md-4 col-form-label text-md-right">支出名：</label>
              <div class="col-md-6">
                <input id="spending_name" type="text" class="form-control @error('spending_name') is-invalid @enderror"
                  name="spending_name" value="{{ old('spending_name', '') }}" required
                  autocomplete="spending_name" autofocus>
                @error('spending_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group d-flex flex-column flex-md-row mt-3">
              <label for="spending_amount" class="col-md-4 col-form-label text-md-right">支出金額：</label>
              <div class="col-md-6">
                <input id="spending_amount" type="number"
                  class="form-control @error('spending_amount') is-invalid @enderror" name="spending_amount"
                  value="{{ old('spending_amount', '') }}" required autocomplete="spending_amount"
                  autofocus>
                @error('spending_amount')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group d-flex flex-column flex-md-row mt-3">
              <label for="spending_category" class="col-md-4 col-form-label text-md-right">カテゴリー：</label>
              <div class="col-md-6">
                <select name="spending_category" id="spending_category"
                  class="form-select @error('spending_category') is-invalid @enderror">
                  @foreach ($spendingStatusStrings as $key => $spendingStatusString)
                  <option @if ($key==old('spending_category', '')) selected @endif value="{{ $key
                    }}">{{ $spendingStatusString }}</option>
                  @endforeach
                </select>
                @error('spending_category')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group d-flex flex-column flex-md-row mt-3">
              <label for="due_date" class="col-md-4 col-form-label text-md-right">支出日：</label>
              <div class="col-md-6">
                <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror"
                  name="due_date" value="{{ old('due_date', '') }}" required autocomplete="due_date"
                  autofocus>
                @error('due_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group d-flex mt-3 mb-0">
              <div class="col-md-10 col-12 d-flex justify-content-end">
                <a href="{{ route('spendings.index',[$projectId, $taskId]) }}" style="margin-right: 10px;" class="btn btn-danger">戻る</a>
                <button style="margin-right: 10px;" type="submit" class="btn btn-primary">追加</button>
              </div>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection
