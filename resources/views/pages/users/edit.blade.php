@extends('layouts.admin')

@section('breadcrump', 'Edit User')

@section('action')
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-block">
          {!! Form::open(['action' => ['UsersController@update', $data['user']->id], 'method' => 'PUT']) !!}
            <div class="form-group">
              <label class="col-md-12">Id</label>
              <div class="col-md-12">
                {{Form::text('id', $data['user']->id, ['class' => 'form-control form-control-line', 'placeholder' => 'Jenis Barang', 'disabled' => true])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Username</label>
              <div class="col-md-12">
                {{Form::text('username', $data['user']->username, ['class' => 'form-control form-control-line', 'placeholder' => 'Username'])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Role</label>
              <div class="col-md-12">
                @php ($roles = ['admin' => 'Admin', 'developer' => 'Developer', 'guest' => 'Guest'])
                {{Form::select('role', $roles, $data['user']->role, ['id' => 'role', 'class' => 'form-control form-control-line', 'placeholder' => 'Role', 'onchange' => 'roleChange()'])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Application Grant</label>
              <div class="col-md-12">
                {{Form::select('application', [], $data['user']->application_grant, ['id' => 'application', 'class' => 'form-control form-control-line', 'placeholder' => 'Application Grant', 'onchange' => 'applicationChange()'])}}
              </div>
            </div>
            <div class="form-group" id="function-form">
              <label class="col-md-12">Function Grant</label>
              <div class="col-md-12">
                {{Form::select('function', [], $data['user']->application_grant, ['id' => 'function', 'class' => 'form-control form-control-line', 'placeholder' => 'Function Grant'])}}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Password</label>
              <div class="col-md-12">
                {{Form::password('password' ,['class' => 'form-control form-control-line', 'placeholder' => 'Password'])}}
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

@section('js')
  <script>
    var elRole = document.getElementById('role')
    var elApplication = document.getElementById('application')
    var elFunctionForm = document.getElementById('function-form')

    var user = {!! json_encode($data['user']) !!}
    var functionsList = {!! json_encode($data['functions']) !!}
    var applicationsList = {!! json_encode($data['applications']) !!}

    elFunctionForm.style.display = 'none'
    roleChange()

    function roleChange () {
      switch (elRole.value) {
        case 'admin':
          setOptions([{id: 'all', name: 'All'}], 'application')
          elFunctionForm.style.display = 'none'
          break;
        case 'developer':
          setOptions(applicationsList, 'application')
          elFunctionForm.style.display = 'none'
          break;
        case 'guest':
          setOptions(applicationsList, 'application')
          if (user.role === 'role') {
            id_application = functionsList.filter((item) => item.code === user.application_grant)[0].id_application
            elApplication.value = id_application
          }
          list = functionsList.filter((item) => item.id_application === parseInt(elApplication.value))
          setOptions(list, 'function')
          elFunctionForm.style.display = 'block'
          break;
      }
    }

    function applicationChange () {
      if (elRole.value === 'guest') {
        elFunctionForm.style.display = 'block'
        list = functionsList.filter((item) => item.id_application === parseInt(elApplication.value))
        setOptions(list, 'function')
      }
    }

    function setOptions (arr, elId) {
      var el = document.getElementById(elId)
      el.options.length = 0
      arr.forEach((item, i) => {
        elId === 'function' ? el.options[i] = new Option(item.name, item.code)  : el.options[i] = new Option(item.name, item.id)
      })
    }
  </script>    
@endsection