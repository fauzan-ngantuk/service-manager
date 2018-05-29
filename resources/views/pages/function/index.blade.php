@extends('layouts.admin')

@section('breadcrump', 'Function')

@section('action')
  <a href="/function/create" class="btn pull-right hidden-sm-down btn-success">Create New</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
            <h4 class="card-title">Select App</h4>
          {!! Form::open(['action' => 'FunctionController@index', 'method' => 'GET']) !!}
            <div class="form-group">
              <label class="col-md-12">Select App</label>
              <div class="col-md-12">
                {{Form::select('id_app', $data['applications']->pluck('name', 'id'), null, ['class' => 'form-control form-control-line', 'placeholder' => 'App'])}}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                {{Form::submit('Find', ['class' => 'btn btn-success'])}}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <h4 class="card-title">Data Functions</h4>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>App Name</th>
                    <th>Function Code</th>
                    <th>Function Using</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($data['functions']) > 0)
                    @php ($no = 0)
                    @foreach($data['functions'] as $function)
                      <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $function->application->name }}</td>
                        <td>{{ $function->code }}</td>
                        <td>{{ $function->name }}</td>
                        <td>
                          <a href="function/{{ $function->id }}/edit" class="btn btn-success">Edit</a>
                          {!! Form::open(['action' => ['FunctionController@destroy', $function->id], 'method' => 'DELETE', 'style' => 'display: inline']) !!}
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