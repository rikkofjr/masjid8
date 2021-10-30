@extends('layouts.dashboard')

@section('mainContent')
<section class="section">

<div class="section-header">
    <h1>Users Management</h1>
      <div class="section-header-breadcrumb">
        <a class="btn btn-success" href="{{ route('adminusers.create') }}"> Create New User</a>
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
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
    @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('adminusers.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('adminusers.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['adminusers.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}
</section>
@endsection