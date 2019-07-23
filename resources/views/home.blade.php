


@extends('layouts.app')

@section('content')
  <div class="container" style="width: 80vw">

    <div class="row">

      <div class="col-md-2 border overflow-auto" style="height: 80vh">
        <h2>Tags</h2>

        <ul>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
        </ul>
      </div>

      <div class="col-md-3 border overflow-auto" style="height: 80vh">
        <h2>Notes</h2>

        <ul>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
        </ul>
      </div>

      <div class="col-md-7 border overflow-auto" style="height: 80vh">
        <h2>Laba diena dienorasteli...</h2>

      </div>

    </div>

  </div>

@endsection










{{-- @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-md-8">
      <div class="card">
        <div class="card-header">Home</div>

        <div class="card-body">
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif

          <p>
              <a href="{{ route('notes.create') }}" class="btn btn-primary">+ Add a note</a>
          </p>

          <h2>Tags</h2>

          <p>
            @foreach ($tags as $tag)

              @include('components.tag', [
                'tag' => $tag,
                'max' => $tags->max('notes_count'),
                'min' => $tags->min('notes_count'),
                ])

            @endforeach
          </p>

          @if (!$notes)

            <p>No notes so far. Create the first one!</p>

          @else

            @foreach ($notes as $note)

              <p>{{ implode(', ', $note->tags->pluck('name')->toArray()) }}: {{ $note->text }}</p>

            @endforeach

          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
 --}}