@extends('layouts.admin')

@section('breadcrump', 'Applications')

@section('action')
    <a href="/application/create" class="btn pull-right hidden-sm-down btn-success">Create New</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">Data Application</h4>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($applications) > 0)
                    @php ($no = 0)
                    @foreach($applications as $application)
                      <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $application->name }}</td>
                        <td>
                          <a href="application/{{ $application->id }}/edit" class="btn btn-success">Edit</a>
                          {!! Form::open(['action' => ['ApplicationController@destroy', $application->id], 'method' => 'DELETE', 'style' => 'display: inline']) !!}
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