@extends('layout')
@section('content')
  <h1>{{ $flyer->street }}</h1>
  <hr>
  <h1>{{ $flyer->price }}</h1>

  <p>{{ $flyer->description }}</p>

@stop

