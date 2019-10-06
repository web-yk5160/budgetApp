@extends('layouts/app')

@section('content')
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-md-4">
          <h4>月間予算</h4>
        </div>
        <div class="col-md-2 col-md-offset-6">
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
        <th>カテゴリ </th>
        <th>総計</th>
        <th>残高</th>
        <th>削除</th>
      </thead>
      <tbody>
        @foreach($budgets as $budget)
        <tr>
          <td><a href="/budgets/{{ $budget->id }}/edit">{{$budget->category->name}}</a></td>
          <td>{{$budget->amount}}</td>
          <td>{{$budget->balance()}}</td>
          <td>
            <form action="/budgets/{{ $budget->id }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger btn-xs" type="submit">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
    </div>
  </div>
</div>
@endsection