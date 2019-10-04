@extends('layouts/app')

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <th>日付</th>
        <th>内容</th>
        <th>カテゴリ</th>
        <th>総計</th>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
          <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
          <td><a href="/transactions/{{ $transaction->id }}">{{$transaction->description}}</a></td>
          <td>{{$transaction->category->name}}</td>
          <td>{{$transaction->amount}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
    </div>
  </div>
</div>
@endsection