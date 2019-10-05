@extends('layouts/app')

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-md-2 col-md-offset-10">
          <form method="GET" id="months-form">
            <select name="month" id="month" class="form-control" onchange="document.getElementById('months-form').submit()">
              <option value="Jan" {{ $currentMonth == 'Jan' ? 'selected' : '' }}>1月</option>
              <option value="Feb" {{ $currentMonth == 'Feb' ? 'selected' : '' }}>2月</option>
              <option value="Mar" {{ $currentMonth == 'Mar' ? 'selected' : '' }}>3月</option>
              <option value="Apr" {{ $currentMonth == 'Apr' ? 'selected' : '' }}>4月</option>
              <option value="May" {{ $currentMonth == 'May' ? 'selected' : '' }}>5月</option>
              <option value="Jun" {{ $currentMonth == 'Jun' ? 'selected' : '' }}>6月</option>
              <option value="Jul" {{ $currentMonth == 'Jul' ? 'selected' : '' }}>7月</option>
              <option value="Aug" {{ $currentMonth == 'Aug' ? 'selected' : '' }}>8月</option>
              <option value="Sep" {{ $currentMonth == 'Sep' ? 'selected' : '' }}>9月</option>
              <option value="Oct" {{ $currentMonth == 'Oct' ? 'selected' : '' }}>10月</option>
              <option value="Nov" {{ $currentMonth == 'Nov' ? 'selected' : '' }}>11月</option>
              <option value="Dec" {{ $currentMonth == 'Dec' ? 'selected' : '' }}>12月</option>
            </select>
          </form>
        </div>
      </div>
    </div>
    <div class="panel-body">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <th>日付</th>
        <th>内容</th>
        <th>カテゴリ</th>
        <th>総計</th>
        <th>削除</th>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
          <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
          <td><a href="/transactions/{{ $transaction->id }}">{{$transaction->description}}</a></td>
          <td>{{$transaction->category->name}}</td>
          <td>{{$transaction->amount}}</td>
          <td>
            <form action="/transactions/{{ $transaction->id }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger btn-xs" type="submit">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $transactions->links() }}
  </div>
    </div>
  </div>
</div>
@endsection