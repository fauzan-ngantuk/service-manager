@extends('layouts.admin')

@section('breadcrump', 'Create User')

@section('action')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
          {!! Form::open(['action' => 'FunctionController@store', 'method' => 'POST']) !!}
            <div class="form-group">
              <label class="col-md-12">App</label>
              <div class="col-md-12">
                @php ($roles = [])
                {{Form::select('id_application', $applications->pluck('name', 'id'), null, ['class' => 'form-control form-control-line', 'placeholder' => 'App'])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Functions Code</label>
              <div class="col-md-12">
                {{Form::text('code', '', ['class' => 'form-control form-control-line', 'placeholder' => 'Functions Code'])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Usage</label>
              <div class="col-md-12">
                {{Form::text('name', '', ['class' => 'form-control form-control-line', 'placeholder' => 'Usage'])}}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                {{Form::submit('Create', ['class' => 'btn btn-success'])}}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
