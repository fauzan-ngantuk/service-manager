@extends('layouts.admin')

@section('breadcrump', 'Token')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <p class="card-title">Token Id: {{ $data['token']->id }}</p>
          <p class="card-title">Author: {{ $data['user']->username }}</p>
          <p class="card-title">Role: {{ $data['user']->role }}</p>
          <p class="card-title">Expired At: {{ $data['token']->expired_at ? $data['token']->expired_at : '-' }}</p>
          <p class="card-title">Limit: {{ $data['token']->limit ? $data['token']->limit : '-' }}</p>
          <p class="card-title">Accesed Time: {{ $data['token']->accessed_time ? $data['token']->accessed_time : '-' }}</p>
          <br>
          @if(count($data['functions']) > 0)
            @php ($no = 0)
            @foreach($data['functions'] as $function)
              <div class="form-group">
                <div class="col-md-12">
                  <label>{{ ++$no }}.</label> <input type="checkbox" id="{{ $function->id }}" onchange="setFunction(this)"> <label>{{ $function->application->name . ' - ' .$function->name }}</label>
                </div>
              </div>
            @endforeach
          @else
            <p>Tidak Ada Data</p>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    var token = {!! json_encode($data['token']) !!}
    var functions = {!! json_encode($data['functions']) !!}
    var function_tokens = {!! json_encode($data['function_tokens']) !!}

    function_tokens.forEach((item) => {
      document.getElementById(item.id_function).checked = true
    })

    function setFunction(el) {
      $.ajax(
        {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST', 
          url: 'http://localhost:8000/functiontoken', 
          data: {id_token: token.id, id_function: el.id , status: el.checked},
          dataType: 'application/json',
          success: function(result){
           console.log(result)
          }
        }
      )
    }
  </script>
@endsection