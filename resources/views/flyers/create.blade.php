@inject('countries','\App\Http\Utilities\Country')

@extends('layout')
@section('content')
  <h1>Selling your home?</h1>

  <div class="row">
    <form action="/flyers" method="POST" enctype="multipart/form-data">
      @include('flyers.form')
      @if(count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

    </form>
  </div>
@stop

