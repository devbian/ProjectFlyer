@extends('layout')
@section('css')
  <link href="http://cdn.bootcss.com/dropzone/4.3.0/dropzone.css" rel="stylesheet">
@stop
@section('content')
  <div class="row">
    <div class="col-md-3">
      <h1>{{ $flyer->street }}</h1>
      <h2>{{ $flyer->price }}</h2>
      <hr>

      <p>{!! nl2br($flyer->description) !!}</p>
    </div>

    <div class="col-md-9">
      @foreach($flyer->photos as $photo)
        <img src="{{ $photo->path }}" alt="">
      @endforeach
    </div>
  </div>

  <hr>

  <h2>Add Your Photos</h2>

  {{--<form id="addPhotosForm" action="/{{ $flyer->zip }}/{{ $flyer->street }}/photos" class="dropzone"--}}
  <form id="addPhotosForm"
        action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
        class="dropzone"
  >
    {{ csrf_field() }}
  </form>
@stop

@section('scripts.footer')
  <script src="http://cdn.bootcss.com/dropzone/4.3.0/dropzone.js"></script>
  <script>
    Dropzone.options.addPhotosForm = {
      paramName: 'photo',
      maxFilesize: 3,
      acceptedFiles: '.jpg, .jpeg, .png, .bmp',
    };

  </script>
@stop
