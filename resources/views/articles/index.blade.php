@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Articles</h2>
</div>
<div class="pull-right">
@can('article-create')
<a class="btn btn-success" href="/articles_create"> Create New Article</a>
@endcan
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>No</th>

<th>Editor_name</th>
<th>Name</th>
<th>Details</th>
<th width="280px">Action</th>
</tr>
@foreach ($articles as $article)
<tr>
<td>{{ ++$i }}</td>

<td>{{ $article->Users->name }}</td>
<td>{{ $article->name }}</td>
<td>{{ $article->detail }}</td>
<td>
<form action="/articles_destroy/{{$article->id}}" method="POST">
<a class="btn btn-info" href="/articles_show/{{$article->id}}">Show</a>
@can('article-edit')
<a class="btn btn-primary" href="/articles_edit/{{$article->id}}">Edit</a>
@endcan
@csrf
@method('DELETE')
@can('article-delete')
<button type="submit" class="btn btn-danger">Delete</button>
@endcan
</form>
</td>
</tr>
@endforeach
</table>
{!! $articles->links() !!}
@endsection
