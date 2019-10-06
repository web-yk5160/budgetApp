@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
        カテゴリー作成
      </div>
      <div class="panel-body">
      <form action="/categories" method="POST">
        @include('categories.form')
      </form>
      </div>
    </div>
      </div>
    </div>
  </div>

@endsection