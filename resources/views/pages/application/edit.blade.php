@extends('layouts.admin')

@section('breadcrump', 'Create App')

@section('action')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
          {!! Form::open(['action' => ['ApplicationController@update', $application->id], 'method' => 'PUT']) !!}
            <div class="form-group">
              <label class="col-md-12">Id</label>
              <div class="col-md-12">
                {{Form::text('id', $application->id, ['class' => 'form-control form-control-line', 'placeholder' => 'Id', 'disabled' => true])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">App Name</label>
              <div class="col-md-12">
                {{Form::text('name', $application->name, ['class' => 'form-control form-control-line', 'placeholder' => 'App Name'])}}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                {{Form::submit('Edit', ['class' => 'btn btn-success'])}}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection