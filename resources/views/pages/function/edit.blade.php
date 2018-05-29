@extends('layouts.admin')

@section('breadcrump', 'Create User')

@section('action')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
          {!! Form::open(['action' => ['FunctionController@update', $data['function']->id], 'method' => 'PUT']) !!}
            <div class="form-group">
              <label class="col-md-12">Id</label>
              <div class="col-md-12">
                {{Form::text('id', $data['function']->id, ['class' => 'form-control form-control-line', 'placeholder' => 'Id', 'disabled' => true])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">App</label>
              <div class="col-md-12">
                @php ($roles = [])
                {{Form::select('id_application', $data['applications']->pluck('name', 'id'), $data['function']->id_application, ['class' => 'form-control form-control-line', 'placeholder' => 'App', 'disabled' => true])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Functions Code</label>
              <div class="col-md-12">
                {{Form::text('code', $data['function']->code, ['class' => 'form-control form-control-line', 'placeholder' => 'Functions Code', 'disabled' => true])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Usage</label>
              <div class="col-md-12">
                {{Form::text('name', $data['function']->name, ['class' => 'form-control form-control-line', 'placeholder' => 'Usage'])}}
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
