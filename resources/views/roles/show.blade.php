@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2> Show Role</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="/roles"> Back</a>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <table class="table">
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{ $role->name }}</td>
        </tr>
        <tr>
            <td><strong>Permissions:</strong></td>
            <td>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <span class="badge badge-success">{{ $v->name }}</span>
                    @endforeach
                @endif
            </td>
        </tr>
    </table>


</div>
</div>
</div>
@endsection
