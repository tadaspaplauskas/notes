@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col">

    <h2>Uploads</h2>

    @foreach ($uploads as $upload)
    <div class="align-top d-inline-block img-thumbnail my-3 w-25">
      <a href="{{ route('uploads.delete', $upload) }}" class="close mx-2" aria-label="Delete" title="Delete file">
        <span aria-hidden="true">&times;</span>
      </a>

      <a href="{{ $upload->url }}">
        @if ($upload->is_image)
          <img src="{{ $upload->url }}" title="{{ $upload->name }}" class="img-fluid">
        @else
          {{ $upload->name }}
        @endif
      </a>

      <a href="{{ route('notes.edit', $upload->note) }}" class="float-right">Go to note</a>
    </div>
    @endforeach

  </div>

</div>

@endsection

