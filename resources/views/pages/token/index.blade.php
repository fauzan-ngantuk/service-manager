@extends('layouts.admin')

@section('breadcrump', 'Tokens')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">Data Token</h4>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Token Id</th>
                    <th>Role</th>
                    <th>Grant</th>
                    <th>Expired At</th>
                    <th>Limit</th>
                    <th>Accessed Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($tokens) > 0)
                    @php ($no = 0)
                    @foreach($tokens as $token)
                      <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $token->user->username }}</td>
                        <td>{{ $token->id }}</td>
                        <td>{{ $token->user->role }}</td>
                        <td>{{ $token->user->application_grant }}</td>
                        <td>{{ $token->expired_at }}</td>
                        <td>{{ $token->limit }}</td>
                        <td>{{ $token->accessed_time }}</td>
                        <td>
                          <a href="token/{{ $token->id }}" class="btn btn-success">Check</a>
                          {!! Form::open(['action' => ['TokenController@destroy', $token->id], 'method' => 'DELETE', 'style' => 'display: inline']) !!}
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