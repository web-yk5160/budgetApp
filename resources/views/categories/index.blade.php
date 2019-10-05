@extends('layouts/app')

@section('content')
<div class="container">
  <div class="panel panel-default">

    <div class="panel-body">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <th>日付</th>
        <th>名前</th>
        <th>スラッグ</th>
        <th>削除</th>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{ $category->created_at->format('m/d/Y') }}</td>
          <td><a href="/categories/{{ $category->id }}">{{$category->name }}</a></td>
          <td>{{$category->slug}}</td>
          <td>
            <form action="/categories/{{ $category->id }}" method="POST">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger btn-xs" type="submit">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $categories->links() }}
  </div>
    </div>
  </div>
</div>
@endsection