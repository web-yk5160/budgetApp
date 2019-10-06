@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
        予算作成
      </div>
      <div class="panel-body">
      <form action="/budgets" method="POST">
        @include('budgets.form')
      </form>
      </div>
    </div>
      </div>
    </div>
  </div>

@endsection