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
      @foreach($flyer->photos->chunk(4) as $set)
        <div class="row">
          @foreach($set as $photo)
            <div class="col-md-3">
              <form action="/photos/{{ $photo->id }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-sm">Delete</button>
              </form>
              <a href="/{{ $photo->path }}" data-lity>
                <img src="/{{ $photo->thumbnail_path }}" alt="" class="gallery_image">
              </a>
            </div>
          @endforeach
        </div>
      @endforeach

      {{-- deterime if has permisson to upload files --}}
      @if($user && $flyer->ownedBy($user))
        <hr>
        <form id="addPhotosForm"
              action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
              class="dropzone"
        >
          {{ csrf_field() }}
        </form>
      @endif
    </div>
  </div>
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
