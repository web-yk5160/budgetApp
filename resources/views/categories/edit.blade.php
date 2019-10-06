@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
        カテゴリー更新
      </div>
      <div class="panel-body">
      <form action="/categories/{{ $category->slug }}" method="POST">
        {{ method_field('PUT') }}
        @include('categories.form', ['buttonText' => '更新'])
      </form>
      </div>
    </div>
      </div>
    </div>
  </div>

@endsection