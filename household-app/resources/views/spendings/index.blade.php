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
            <p class="mb-0 h5 ">支出詳細</p>
            <a href="{{ route('spendings.create', [$currentProjectId ?? 'default', $spending ? $spending->id : 'default']) }}" class="btn btn-primary">追加</a>

        </div>
        <table class="table table-hover mb-0">
          <thead class="text-light" style="background-color: rgb(106, 106, 106)">
            <tr class="text-center">
              <th scope="col" style="width: 25%">支出日</th>
              <th scope="col" style="width: 65%">品目</th>
              <th scope="col" style="width: 15%">金額</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($spendings as $spending)
            <tr>
              <td><span >{{ $spending->due_date }}</span></td>
              <td><a href="{{ route('spendings.edit',[$currentProjectId,$spending->id]) }}">{{ $spending->spending_name }}</a></td>
              <td><span >{{ $spending->spending_amount }}</span></td>
            </tr>

            @endforeach
            <tr>
              <td></td>
              <td><strong>合計</strong></td>
              <td><strong>{{ $totalAmount }}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
