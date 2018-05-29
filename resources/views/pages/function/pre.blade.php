@extends('layouts.admin')

@section('breadcrump', 'Function')

@section('action')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
          {!! Form::open(['action' => 'FunctionController@showByIdApp', 'method' => 'GET']) !!}
            <div class="form-group">
              <label class="col-md-12">Select App</label>
              <div class="col-md-12">
                {{Form::select('id_app', $applications->pluck('name', 'id'), null, ['class' => 'form-control form-control-line', 'placeholder' => 'App'])}}
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
@endsection
