@extends('layouts/app')

<div class="container">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <th>date</th>
        <th>Description</th>
        <th>caregory</th>
        <th>Amount</th>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
          <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
          <td>{{$transaction->description}}</td>
          <td>{{$transaction->category->name}}</td>
          <td>{{$transaction->amount}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>