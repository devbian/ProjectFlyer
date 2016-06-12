<!-- resources/views/auth/login.blade.php -->
@extends('layout')
@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">

      <h1>Register</h1>
      <hr>

      <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}" required>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password:</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" required>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>

      @if(count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

    </div>
  </div>
@stop

