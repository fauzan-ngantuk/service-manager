@extends('layouts.admin')

@section('breadcrump', 'User')

@section('action')
    <a href="/users/create" class="btn pull-right hidden-sm-down btn-success">Create New</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">Data User</h4>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Secret</th>
                    <th>Role</th>
                    <th>Application Grant</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($users) > 0)
                    @php ($no = 0)
                    @foreach($users as $user)
                      <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->secret }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->application_grant }}</td>
                        <td>
                          <a href="users/{{ $user->id }}/edit" class="btn btn-success">Edit</a>
                          {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'DELETE', 'style' => 'display: inline']) !!}
                              {{ Form::submit('Delete', ['class' => 'btn btn-success']) }}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan=3>Tidak Ada Data</td>
                    </tr>
                  @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection