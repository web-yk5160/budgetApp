@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
        取引更新
      </div>
      <div class="panel-body">
      <form action="/transactions/{{ $transaction->id }}" method="POST">
      {{ method_field('PUT') }}
        @include('transactions.form', ['buttonText' => '更新'])
      </form>
      </div>
    </div>
      </div>
    </div>
  </div>

@endsection